@extends('layouts.admin')

@php
    use App\Models\ChatMessage;
@endphp

@section('page-title', __('admin.chatbot'))

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.chat-sessions.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>{{ __('common.back_to_list') }}
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('common.chatbot_session_info') }}</h2>
                <dl class="space-y-3 text-sm text-gray-700">
                    <div>
                        <dt class="font-medium text-gray-500">{{ __('common.full_name') }}</dt>
                        <dd class="text-gray-900">{{ $session->name }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">{{ __('common.contact_info') }}</dt>
                        <dd class="text-gray-900">{{ $session->phone ?: __('common.not_available') }}</dd>
                        <dd class="text-gray-500">{{ $session->email ?: __('common.not_available') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">{{ __('common.chatbot_need') }}</dt>
                        <dd class="text-gray-900 whitespace-pre-wrap">{{ $session->needs ?: __('common.not_available') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">{{ __('common.chatbot_started_at') }}</dt>
                        <dd class="text-gray-900">{{ optional($session->created_at)->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">{{ __('common.chatbot_last_message_at') }}</dt>
                        <dd class="text-gray-900">{{ optional($session->last_message_at ?? $session->created_at)->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">{{ __('common.status') }}</dt>
                        <dd>
                            @if ($session->status === \App\Models\ChatSession::STATUS_OPEN)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ __('common.chatbot_status_open') }}</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ __('common.chatbot_status_closed') }}</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg h-full flex flex-col">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">{{ __('common.chatbot_conversation') }}</h2>
                    <p class="text-sm text-gray-500">{{ __('common.chatbot_conversation_subtitle') }}</p>
                </div>
                <div class="flex-1 overflow-y-auto p-6 space-y-4" style="max-height: 600px;">
                    @forelse ($session->messages as $message)
                        <div class="flex {{ $message->sender === ChatMessage::SENDER_USER ? 'justify-start' : 'justify-end' }}">
                            <div class="max-w-xl">
                                <div class="flex items-center {{ $message->sender === ChatMessage::SENDER_USER ? 'space-x-2' : 'space-x-reverse space-x-2 flex-row-reverse' }}">
                                    <span class="text-xs font-semibold text-gray-500 uppercase">
                                        {{ $message->sender === ChatMessage::SENDER_USER ? __('common.chatbot_role_user') : __('common.chatbot_role_bot') }}
                                    </span>
                                    <span class="text-xs text-gray-400">{{ optional($message->created_at)->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="mt-2 rounded-lg px-4 py-3 text-sm leading-relaxed shadow-sm {{ $message->sender === ChatMessage::SENDER_USER ? 'bg-gray-100 text-gray-800' : 'bg-blue-600 text-white' }}">
                                    {!! nl2br(e($message->message)) !!}
                                </div>
                                @if (!empty($message->metadata['usage']))
                                    <div class="mt-1 text-xs text-gray-400">
                                        {{ __('common.chatbot_tokens_used', ['prompt' => $message->metadata['usage']['prompt_tokens'] ?? 0, 'completion' => $message->metadata['usage']['completion_tokens'] ?? 0]) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-sm text-gray-500 py-12">
                            <i class="fas fa-comments text-2xl text-gray-300 mb-2"></i>
                            <p>{{ __('common.chatbot_no_messages') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
