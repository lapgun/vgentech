@extends('layouts.admin')
@section('title', __('Create Tag'))
@section('page-title', __('Create Tag'))
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.tags.store') }}" method="POST">@csrf
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Name') }} *</label><input
                        type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded-lg"
                        required></div>
                <div class="mb-6"><label>{{ __('Slug') }}</label><input type="text" name="slug"
                        value="{{ old('slug') }}" class="w-full px-4 py-2 border rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">{{ __('Leave empty to auto-generate') }}</p>
                </div>
                <div class="flex justify-end space-x-3"><a href="{{ route('admin.tags.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button></div>
            </form>
        </div>
    </div>
@endsection
