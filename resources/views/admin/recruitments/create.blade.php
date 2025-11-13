@extends('layouts.admin')
@section('title', __('Create Job Posting'))
@section('page-title', __('Create Job Posting'))
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.recruitments.store') }}" method="POST">@csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2"><label class="block text-gray-700 font-medium mb-2">{{ __('Job Title') }}
                            *</label><input type="text" name="title" value="{{ old('title') }}"
                            class="w-full px-4 py-2 border rounded-lg" required></div>
                    <div class="col-span-2"><label>{{ __('Description') }}</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-span-2"><label>{{ __('Requirements') }}</label>
                        <textarea name="requirements" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('requirements') }}</textarea>
                    </div>
                    <div class="col-span-2"><label>{{ __('Benefits') }}</label>
                        <textarea name="benefits" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('benefits') }}</textarea>
                    </div>
                    <div><label>{{ __('Location') }}</label><input type="text" name="location"
                            value="{{ old('location') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Salary Range') }}</label><input type="text" name="salary_range"
                            value="{{ old('salary_range') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div><label>{{ __('Employment Type') }}</label><input type="text" name="employment_type"
                            value="{{ old('employment_type') }}" class="w-full px-4 py-2 border rounded-lg"
                            placeholder="Full-time, Part-time, Contract"></div>
                    <div><label>{{ __('Application Deadline') }}</label><input type="date" name="deadline"
                            value="{{ old('deadline') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label>{{ __('Contact Email') }}</label><input type="email"
                            name="contact_email" value="{{ old('contact_email') }}"
                            class="w-full px-4 py-2 border rounded-lg"></div>
                    <div class="col-span-2"><label class="flex items-center"><input type="checkbox" name="is_active"
                                value="1" checked class="mr-2">{{ __('Active') }}</label></div>
                </div>
                <div class="flex justify-end space-x-3 mt-6"><a href="{{ route('admin.recruitments.index') }}"
                        class="px-4 py-2 border rounded-lg">Cancel</a><button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button></div>
            </form>
        </div>
    </div>
@endsection
