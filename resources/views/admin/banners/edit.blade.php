@extends('layouts.admin')
@section('title', __('Edit Banner'))
@section('page-title', __('Edit Banner'))
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">@csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2"><label class="block text-gray-700 font-medium mb-2">{{ __('Title') }}
                            *</label><input type="text" name="title" value="{{ old('title', $banner->title) }}"
                            class="w-full px-4 py-2 border rounded-lg" required></div>
                    <div class="col-span-2"><label>{{ __('Subtitle') }}</label><input type="text" name="subtitle"
                            value="{{ old('subtitle', $banner->subtitle) }}" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="col-span-2"><label>{{ __('Description') }}</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $banner->description) }}</textarea>
                    </div>
                    <div class="col-span-2">
                        @if ($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" class="h-32 mb-2 rounded">
                        @endif
                        <label>{{ __('Image') }}</label><input type="file" name="image" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div><label>{{ __('Link') }}</label><input type="url" name="link"
                            value="{{ old('link', $banner->link) }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Button Text') }}</label><input type="text" name="button_text"
                            value="{{ old('button_text', $banner->button_text) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Order') }}</label><input type="number" name="sort_order"
                            value="{{ old('sort_order', $banner->sort_order) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="flex items-center"><label class="flex items-center"><input type="checkbox" name="is_active"
                                value="1" {{ $banner->is_active ? 'checked' : '' }}
                                class="mr-2">{{ __('Active') }}</label></div>
                </div>
                <div class="flex justify-end space-x-3 mt-6"><a href="{{ route('admin.banners.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button></div>
            </form>
        </div>
    </div>
@endsection
