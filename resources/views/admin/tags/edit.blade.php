@extends('layouts.admin')
@section('title', __('Edit Tag'))
@section('page-title', __('Edit Tag'))
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">@csrf @method('PUT')
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Name') }} *</label><input
                        type="text" name="name" value="{{ old('name', $tag->name) }}"
                        class="w-full px-4 py-2 border rounded-lg" required></div>
                <div class="mb-6"><label>{{ __('Slug') }} *</label><input type="text" name="slug"
                        value="{{ old('slug', $tag->slug) }}" class="w-full px-4 py-2 border rounded-lg" required></div>
                <div class="flex justify-end space-x-3"><a href="{{ route('admin.tags.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button></div>
            </form>
        </div>
    </div>
@endsection
