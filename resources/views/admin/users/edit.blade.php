@extends('layouts.admin')
@section('title', __('Edit User'))
@section('page-title', __('Edit User'))
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">@csrf @method('PUT')
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Name') }} *</label><input
                        type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 border rounded-lg" required></div>
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Email') }} *</label><input
                        type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 border rounded-lg" required></div>
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Password') }}</label><input
                        type="password" name="password" class="w-full px-4 py-2 border rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">{{ __('Leave blank to keep current password') }}</p>
                </div>
                <div class="mb-4"><label
                        class="block text-gray-700 font-medium mb-2">{{ __('Confirm Password') }}</label><input
                        type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg"></div>
                <div class="mb-6"><label class="block text-gray-700 font-medium mb-2">{{ __('Role') }} *</label><select
                        name="role" class="w-full px-4 py-2 border rounded-lg" required>
                        <option value="GUEST" {{ old('role', $user->role) == 'GUEST' ? 'selected' : '' }}>Guest</option>
                        <option value="ADMIN" {{ old('role', $user->role) == 'ADMIN' ? 'selected' : '' }}>Admin</option>
                    </select></div>
                <div class="flex justify-end space-x-3"><a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">{{ __('Cancel') }}</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
