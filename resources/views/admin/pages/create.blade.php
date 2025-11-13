@extends('layouts.admin')
@section('title', __('Create Page'))
@section('page-title', __('Create Page'))
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Title') }} *</label><input
                        type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded-lg"
                        required></div>
                <div class="mb-4"><label>{{ __('Slug') }}</label><input type="text" name="slug"
                        value="{{ old('slug') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                <div class="mb-4"><label>{{ __('Content') }}</label>
                    <textarea name="content" rows="15" class="w-full px-4 py-2 border rounded-lg">{{ old('content') }}</textarea>
                </div>
                <div class="mb-4"><label>{{ __('Featured Image') }}</label><input type="file" name="featured_image"
                        accept="image/*" class="w-full px-4 py-2 border rounded-lg"></div>
                <div class="mb-6"><label class="flex items-center"><input type="checkbox" name="is_active" value="1"
                            checked class="mr-2">{{ __('Active') }}</label></div>
                <div class="flex justify-end space-x-3"><a href="{{ route('admin.pages.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button></div>
            </form>
        </div>
    </div>
@endsection
