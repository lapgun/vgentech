@extends('layouts.admin')

@php
    use Illuminate\Support\Str;
@endphp

@section('page-title', __('admin.chatbot'))

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">{{ __('common.chatbot_history') }}</h2>
                <p class="text-sm text-gray-500">{{ __('common.chatbot_history_subtitle') }}</p>
            </div>
            <form method="GET" action="{{ route('admin.chat-sessions.index') }}" class="flex items-center gap-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="{{ __('common.chatbot_search_placeholder') }}"
                        class="w-64 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm" />
                    @if ($search !== '')
                        <a href="{{ route('admin.chat-sessions.index') }}"
                            class="absolute inset-y-0 right-2 flex items-center text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    @endif
                </div>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-search mr-2"></i>{{ __('common.search') }}
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.full_name') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.contact_info') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.chatbot_need') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.chatbot_started_at') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.chatbot_last_message_at') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.chatbot_messages') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.status') }}
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.view_details') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($sessions as $session)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $session->name }}</div>
                                <div class="text-xs text-gray-500">{{ $session->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <div>{{ $session->phone ?: __('common.not_available') }}</div>
                                <div class="text-gray-500">{{ $session->email ?: __('common.not_available') }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                {{ $session->needs ? Str::limit($session->needs, 80) : __('common.not_available') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ optional($session->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ optional($session->last_message_at ?? $session->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $session->messages_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($session->status === \App\Models\ChatSession::STATUS_OPEN)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ __('common.chatbot_status_open') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ __('common.chatbot_status_closed') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.chat-sessions.show', $session) }}"
                                    class="text-blue-600 hover:text-blue-900">
                                    {{ __('common.view_details') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-sm text-gray-500">
                                <i class="fas fa-comments mb-2 text-2xl text-gray-300"></i>
                                <p>{{ __('common.chatbot_no_messages') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $sessions->links() }}
        </div>
    </div>
@endsection
