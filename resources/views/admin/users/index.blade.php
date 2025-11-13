@extends('layouts.admin')
@section('title', __('Users'))
@section('page-title', __('Users'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">{{ __('All Users') }}</h2>
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg"><i
                    class="fas fa-plus mr-2"></i>{{ __('Add User') }}</a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Email') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Role') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Created') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if ($user->role === 'ADMIN')
                            <span class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded">Admin</span>@else<span
                                    class="px-2 py-1 text-xs bg-gray-100 rounded">Guest</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.users.edit', $user) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                            @if ($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                                        class="text-red-600"><i class="fas fa-trash"></i></button></form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $users->links() }}</div>
    </div>
@endsection
