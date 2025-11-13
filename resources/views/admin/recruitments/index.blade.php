@extends('layouts.admin')
@section('title', __('Recruitments'))
@section('page-title', __('Recruitments'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between">
            <h2 class="text-lg font-semibold">{{ __('All Job Postings') }}</h2><a
                href="{{ route('admin.recruitments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg"><i
                    class="fas fa-plus mr-2"></i>{{ __('Add Job') }}</a>
        </div>
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Title') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Location') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Employment Type') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Deadline') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($recruitments as $recruitment)
                    <tr>
                        <td class="px-6 py-4">{{ $recruitment->title }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $recruitment->location ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $recruitment->employment_type ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $recruitment->deadline ? $recruitment->deadline->format('Y-m-d') : '-' }}</td>
                        <td class="px-6 py-4">
                            @if ($recruitment->is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Active</span>@else<span
                                    class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.recruitments.edit', $recruitment) }}"
                                class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.recruitments.destroy', $recruitment) }}" method="POST"
                                class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                    type="submit" class="text-red-600"><i class="fas fa-trash"></i></button></form>
                        </td>
                </tr>@empty<tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No job postings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $recruitments->links() }}</div>
    </div>
@endsection
