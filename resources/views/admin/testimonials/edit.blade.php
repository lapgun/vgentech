@extends('layouts.admin')
@section('title', __('Edit Testimonial'))
@section('page-title', __('Edit Testimonial'))
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2"><label class="block text-gray-700 font-medium mb-2">{{ __('Client Name') }}
                            *</label><input type="text" name="customer_name"
                            value="{{ old('customer_name', $testimonial->customer_name) }}"
                            class="w-full px-4 py-2 border rounded-lg" required></div>
                    <div><label>{{ __('Position') }}</label><input type="text" name="customer_position"
                            value="{{ old('customer_position', $testimonial->customer_position) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Company') }}</label><input type="text" name="customer_company"
                            value="{{ old('customer_company', $testimonial->customer_company) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label>{{ __('Content') }} *</label>
                        <textarea name="content" rows="5" class="w-full px-4 py-2 border rounded-lg" required>{{ old('content', $testimonial->content) }}</textarea>
                    </div>
                    <div><label>{{ __('Rating') }}</label><select name="rating"
                            class="w-full px-4 py-2 border rounded-lg">
                            <option value="">-</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        @if ($testimonial->avatar)
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" class="h-16 w-16 rounded-full mb-2">
                        @endif
                        <label>{{ __('Avatar') }}</label><input type="file" name="avatar" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div><label>{{ __('Order') }}</label><input type="number" name="sort_order"
                            value="{{ old('sort_order', $testimonial->sort_order) }}"
                            class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="col-span-2 flex space-x-6"><label class="flex items-center"><input type="checkbox"
                                name="is_featured" value="1" {{ $testimonial->is_featured ? 'checked' : '' }}
                                class="mr-2">Featured</label><label class="flex items-center"><input type="checkbox"
                                name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}
                                class="mr-2">Active</label></div>
                </div>
                <div class="flex justify-end space-x-3 mt-6"><a href="{{ route('admin.testimonials.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button></div>
            </form>
        </div>
    </div>
@endsection
