@extends('layouts.admin')
@section('title', __('Contact Details'))
@section('page-title', __('Contact Details'))
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('Contact Information') }}</h3>
                <div class="space-y-3">
                    <div><span class="font-medium">{{ __('Name') }}:</span> {{ $contact->name }}</div>
                    <div><span class="font-medium">{{ __('Email') }}:</span> <a href="mailto:{{ $contact->email }}"
                            class="text-blue-600">{{ $contact->email }}</a></div>
                    <div><span class="font-medium">{{ __('Phone') }}:</span> {{ $contact->phone ?? '-' }}</div>
                    <div><span class="font-medium">{{ __('Company') }}:</span> {{ $contact->company ?? '-' }}</div>
                    <div><span class="font-medium">{{ __('Subject') }}:</span> {{ $contact->subject ?? '-' }}</div>
                    <div><span class="font-medium">{{ __('Date') }}:</span>
                        {{ $contact->created_at->format('Y-m-d H:i:s') }}</div>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">{{ __('Message') }}</h3>
                <div class="bg-gray-50 p-4 rounded">{{ $contact->message }}</div>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('admin.contacts.index') }}"
                    class="px-4 py-2 border rounded-lg hover:bg-gray-100">{{ __('Back') }}</a>
                <div class="space-x-2">
                    @if (!$contact->is_read)
                        <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="inline">
                            @csrf<button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ __('Mark as Read') }}</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline"
                        onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg">{{ __('Delete') }}</button></form>
                </div>
            </div>
        </div>
    </div>
@endsection
