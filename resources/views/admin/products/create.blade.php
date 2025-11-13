@extends('layouts.admin')

@section('title', __('Create Product'))
@section('page-title', __('Create Product'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">{{ __('admin.product_name') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Category') }}</label>
                        <select name="category_id" class="w-full px-4 py-2 border rounded-lg">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Description') }}</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Content') }}</label>
                        <textarea name="content" id="content" rows="10" class="w-full px-4 py-2 border rounded-lg">{{ old('content') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Price') }}</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Featured Image') }}</label>
                        <input type="file" name="featured_image" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Additional Images') }}</label>
                        <input type="file" name="images[]" accept="image/*" multiple
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Meta Title') }}</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">{{ __('Meta Description') }}</label>
                        <input type="text" name="meta_description" value="{{ old('meta_description') }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div class="col-span-2 flex space-x-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">{{ __('Featured') }}</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">{{ __('Active') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">{{ __('Cancel') }}</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">{{ __('Create') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
