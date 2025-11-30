<?php

namespace App\Services;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    private const DEFAULT_MODEL = 'gpt-4o-mini';
    private const MESSAGE_LIMIT = 12;

    public function generateReply(ChatSession $session): array
    {
        $apiKey = (string) config('services.openai.key');

        if ($apiKey === '') {
            return [
                'reply' => trans('common.chatbot_offline'),
                'metadata' => [
                    'provider' => 'fallback',
                    'reason' => 'missing_api_key',
                ],
                'used_fallback' => true,
            ];
        }

        $messages = $session->messages()
            ->orderBy('created_at')
            ->take(self::MESSAGE_LIMIT)
            ->get();

        $payload = [
            [
                'role' => 'system',
                'content' => $this->buildSystemPrompt($session),
            ],
        ];

        foreach ($messages as $message) {
            $payload[] = [
                'role' => $message->sender === ChatMessage::SENDER_BOT ? 'assistant' : 'user',
                'content' => $message->message,
            ];
        }

        $response = Http::withToken($apiKey)
            ->timeout(15)
            ->asJson()
            ->post((string) config('services.openai.endpoint', 'https://api.openai.com/v1/chat/completions'), [
                'model' => (string) config('services.openai.model', self::DEFAULT_MODEL),
                'messages' => $payload,
                'temperature' => 0.4,
                'max_tokens' => 400,
            ]);

        if ($response->failed()) {
            Log::error('ChatbotService: request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'reply' => trans('common.chatbot_error'),
                'metadata' => [
                    'provider' => 'openai',
                    'status' => $response->status(),
                ],
                'used_fallback' => true,
            ];
        }

        $reply = trim((string) data_get($response->json(), 'choices.0.message.content', ''));

        if ($reply === '') {
            return [
                'reply' => trans('common.chatbot_empty_reply'),
                'metadata' => [
                    'provider' => 'openai',
                    'status' => 'empty_reply',
                ],
                'used_fallback' => true,
            ];
        }

        return [
            'reply' => $reply,
            'metadata' => [
                'provider' => 'openai',
                'model' => data_get($response->json(), 'model'),
                'usage' => data_get($response->json(), 'usage'),
            ],
            'used_fallback' => false,
        ];
    }

    private function buildSystemPrompt(ChatSession $session): string
    {
        $parts = [
            'Bạn là trợ lý ảo của VgenTech. Hỗ trợ khách hàng về sản phẩm và dịch vụ máy phát điện, giữ giọng điệu chuyên nghiệp, thân thiện. Trả lời ngắn gọn bằng tiếng Việt trừ khi người dùng yêu cầu ngôn ngữ khác.',
            'Nếu câu hỏi nằm ngoài phạm vi, hãy đề nghị khách hàng để lại thông tin để đội ngũ liên hệ.',
        ];

        $profile = [];

        if ($session->name) {
            $profile[] = 'Tên khách hàng: ' . $session->name;
        }

        if ($session->phone) {
            $profile[] = 'Số điện thoại: ' . $session->phone;
        }

        if ($session->email) {
            $profile[] = 'Email: ' . $session->email;
        }

        if ($session->needs) {
            $profile[] = 'Nhu cầu: ' . $session->needs;
        }

        if (!empty($profile)) {
            $parts[] = 'Thông tin phiên hiện tại: ' . implode(' | ', $profile) . '.';
        }

        return implode("\n", $parts);
    }
}
