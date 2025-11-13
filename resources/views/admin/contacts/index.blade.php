@extends('layouts.admin')
@section('title', __('Contacts'))
@section('page-title', __('Contacts'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">{{ __('Contact Messages') }}</h2>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Email') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Phone') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Date') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($contacts as $contact)
                    <tr class="{{ $contact->is_read ? '' : 'bg-blue-50' }}">
                        <td class="px-6 py-4">{{ $contact->name }}</td>
                        <td class="px-6 py-4">{{ $contact->email }}</td>
                        <td class="px-6 py-4">{{ $contact->phone }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4">
                            @if ($contact->is_read)
                            <span class="px-2 py-1 text-xs bg-gray-100 rounded">Read</span>@else<span
                                    class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">Unread</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.contacts.show', $contact) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                                    class="text-red-600"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No contacts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $contacts->links() }}</div>
    </div>
@endsection
