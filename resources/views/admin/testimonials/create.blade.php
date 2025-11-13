@extends('layouts.admin')
@section('title', __('Create Testimonial'))
@section('page-title', __('Create Testimonial'))
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2"><label class="block text-gray-700 font-medium mb-2">{{ __('Client Name') }}
                            *</label><input type="text" name="client_name" value="{{ old('client_name') }}"
                            class="w-full px-4 py-2 border rounded-lg" required></div>
                    <div><label>{{ __('Position') }}</label><input type="text" name="client_position"
                            value="{{ old('client_position') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Company') }}</label><input type="text" name="client_company"
                            value="{{ old('client_company') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label>{{ __('Content') }} *</label>
                        <textarea name="content" rows="5" class="w-full px-4 py-2 border rounded-lg" required>{{ old('content') }}</textarea>
                    </div>
                    <div><label>{{ __('Rating') }}</label><select name="rating"
                            class="w-full px-4 py-2 border rounded-lg">
                            <option value="">-</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select></div>
                    <div><label>{{ __('Avatar') }}</label><input type="file" name="avatar" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label>{{ __('Order') }}</label><input type="number" name="sort_order"
                value="{{ old('sort_order', 0) }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2 flex space-x-6"><label class="flex items-center"><input type="checkbox"
                                name="is_featured" value="1" class="mr-2">Featured</label><label
                            class="flex items-center"><input type="checkbox" name="is_active" value="1" checked
                                class="mr-2">Active</label></div>
                </div>
                <div class="flex justify-end space-x-3 mt-6"><a href="{{ route('admin.testimonials.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button></div>
            </form>
        </div>
    </div>
@endsection
