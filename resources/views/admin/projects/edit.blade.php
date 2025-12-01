@extends('layouts.admin')
@section('title', __('Edit Project'))
@section('page-title', __('Edit Project'))
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">@csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">{{ __('admin.project_name') }} <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}"
                            class="w-full px-4 py-2 border rounded-lg" required>
                    </div>
                    <div><label class="block text-gray-700 font-medium mb-2">{{ __('Client') }}</label><input
                            type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label class="block text-gray-700 font-medium mb-2">{{ __('Location') }}</label><input
                            type="text" name="location" value="{{ old('location', $project->location) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label class="block text-gray-700 font-medium mb-2">{{ __('Category') }}</label><select
                            name="category_id" class="w-full px-4 py-2 border rounded-lg">
                            <option value="">Select</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}" {{ $project->category_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="block text-gray-700 font-medium mb-2">{{ __('Completion Date') }}</label><input
                            type="date" name="completion_date"
                            value="{{ old('completion_date', $project->completion_date) }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label>{{ __('Description') }}</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $project->description) }}</textarea>
                    </div>
                    <div class="col-span-2"><label>{{ __('Content') }}</label>
                        <textarea name="content" rows="10" class="w-full px-4 py-2 border rounded-lg">{{ old('content', $project->content) }}</textarea>
                    </div>
                    <div>
                        @if ($project->featured_image)
                            <img src="{{ asset('storage/' . $project->featured_image) }}"
                                class="h-24 w-24 object-cover rounded mb-2">
                        @endif
                        <label>{{ __('Featured Image') }}</label><input type="file" name="featured_image"
                            accept="image/*" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div><label>{{ __('Additional Images') }}</label><input type="file" name="images[]" accept="image/*"
                            multiple class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2 flex space-x-6"><label class="flex items-center"><input type="checkbox"
                                name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}
                                class="mr-2">{{ __('Featured') }}</label><label class="flex items-center"><input
                                type="checkbox" name="is_active" value="1" {{ $project->is_active ? 'checked' : '' }}
                                class="mr-2">{{ __('Active') }}</label></div>
                </div>
                <div class="flex justify-end space-x-3 mt-6"><a href="{{ route('admin.projects.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button></div>
            </form>
        </div>
    </div>
@endsection
