<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatSessionController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));

        $sessions = ChatSession::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'ilike', "%{$search}%")
                        ->orWhere('email', 'ilike', "%{$search}%")
                        ->orWhere('phone', 'ilike', "%{$search}%");
                });
            })
            ->withCount('messages')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.chatbot.index', [
            'sessions' => $sessions,
            'search' => $search,
        ]);
    }

    public function show(ChatSession $chatSession)
    {
        $chatSession->load(['messages' => function ($query) {
            $query->orderBy('created_at');
        }]);

        return view('admin.chatbot.show', [
            'session' => $chatSession,
        ]);
    }
}
