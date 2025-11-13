@extends('layouts.admin')
@section('title', __('Create Post'))
@section('page-title', __('Create Post'))
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="mb-4"><label class="block text-gray-700 font-medium mb-2">{{ __('Title') }} *</label><input
                        type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded-lg"
                        required></div>
                <div class="mb-4"><label>{{ __('Excerpt') }}</label>
                    <textarea name="excerpt" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('excerpt') }}</textarea>
                </div>
                <div class="mb-4"><label>{{ __('Content') }}</label>
                    <textarea name="content" rows="12" class="w-full px-4 py-2 border rounded-lg">{{ old('content') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div><label>{{ __('Author') }}</label><input type="text" name="author" value="{{ old('author') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Published Date') }}</label><input type="date" name="published_at"
                            value="{{ old('published_at') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                </div>
                <div class="mb-4"><label>{{ __('Featured Image') }}</label><input type="file" name="featured_image"
                        accept="image/*" class="w-full px-4 py-2 border rounded-lg"></div>
                <div class="mb-4"><label>{{ __('Tags') }}</label><select name="tags[]" multiple
                        class="w-full px-4 py-2 border rounded-lg" size="5">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select></div>
                <div class="mb-6 flex space-x-6"><label class="flex items-center"><input type="checkbox" name="is_featured"
                            value="1" class="mr-2">Featured</label><label class="flex items-center"><input
                            type="checkbox" name="is_active" value="1" checked class="mr-2">Active</label></div>
                <div class="flex justify-end space-x-3"><a href="{{ route('admin.posts.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button></div>
            </form>
        </div>
    </div>
@endsection
