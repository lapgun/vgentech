<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Services\ChatbotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    private $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function start(Request $request): JsonResponse
    {
        $data = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'string', 'email:rfc,dns', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'needs' => ['nullable', 'string', 'max:600'],
        ])->validate();

        $token = (string) Str::uuid();

        $session = ChatSession::create([
            'id' => (string) Str::uuid(),
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'needs' => $data['needs'] ?? null,
            'locale' => app()->getLocale(),
            'status' => ChatSession::STATUS_OPEN,
            'metadata' => [
                'client_token' => $token,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
        ]);

        if (!empty($data['needs'])) {
            $needsMessage = ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender' => ChatMessage::SENDER_USER,
                'message' => 'Thông tin nhu cầu: ' . $data['needs'],
            ]);

            $session->last_message_at = $needsMessage->created_at;
            $session->save();
        }

        return response()->json([
            'session_id' => $session->id,
            'token' => $token,
            'session' => $this->formatSession($session),
            'messages' => $this->formatMessages($session),
        ]);
    }

    public function show(ChatSession $chatSession, Request $request): JsonResponse
    {
        $this->assertToken($chatSession, $request->query('token'));

        return response()->json([
            'session' => $this->formatSession($chatSession),
            'messages' => $this->formatMessages($chatSession),
        ]);
    }

    public function message(ChatSession $chatSession, Request $request): JsonResponse
    {
        $token = $request->input('token');
        $this->assertToken($chatSession, $token);

        $payload = Validator::make($request->all(), [
            'message' => ['required', 'string', 'min:1', 'max:1000'],
        ])->validate();

        $userMessage = ChatMessage::create([
            'chat_session_id' => $chatSession->id,
            'sender' => ChatMessage::SENDER_USER,
            'message' => $payload['message'],
        ]);

        $chatSession->last_message_at = now();
        $chatSession->save();

        $reply = $this->chatbotService->generateReply($chatSession);

        $botMessage = ChatMessage::create([
            'chat_session_id' => $chatSession->id,
            'sender' => ChatMessage::SENDER_BOT,
            'message' => $reply['reply'],
            'metadata' => $reply['metadata'],
        ]);

        $chatSession->last_message_at = $botMessage->created_at;
        $chatSession->save();

        return response()->json([
            'session_id' => $chatSession->id,
            'messages' => [
                $this->formatMessage($userMessage),
                $this->formatMessage($botMessage),
            ],
            'reply' => $reply['reply'],
            'used_fallback' => $reply['used_fallback'],
        ]);
    }

    private function assertToken(ChatSession $session, ?string $token): void
    {
        $expected = (string) data_get($session->metadata, 'client_token');

        abort_if($expected === '' || $token !== $expected, 403, 'Invalid session token');
    }

    private function formatSession(ChatSession $session): array
    {
        return [
            'id' => $session->id,
            'name' => $session->name,
            'email' => $session->email,
            'phone' => $session->phone,
            'needs' => $session->needs,
            'status' => $session->status,
            'locale' => $session->locale,
            'started_at' => optional($session->created_at)->toIso8601String(),
            'last_message_at' => optional($session->last_message_at)->toIso8601String(),
        ];
    }

    private function formatMessages(ChatSession $session)
    {
        return $session->messages()
            ->orderBy('created_at')
            ->get()
            ->map(fn (ChatMessage $message) => $this->formatMessage($message))
            ->all();
    }

    private function formatMessage(ChatMessage $message): array
    {
        return [
            'id' => $message->id,
            'sender' => $message->sender,
            'message' => $message->message,
            'metadata' => $message->metadata,
            'created_at' => optional($message->created_at)->toIso8601String(),
        ];
    }
}
