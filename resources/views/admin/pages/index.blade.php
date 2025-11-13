@extends('layouts.admin')
@section('title', __('Pages'))
@section('page-title', __('Pages'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between">
            <h2 class="text-lg font-semibold">{{ __('All Pages') }}</h2><a href="{{ route('admin.pages.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg"><i class="fas fa-plus mr-2"></i>{{ __('Add Page') }}</a>
        </div>
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Title') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Slug') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($pages as $page)
                    <tr>
                        <td class="px-6 py-4">{{ $page->title }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $page->slug }}</td>
                        <td class="px-6 py-4">
                            @if ($page->is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Active</span>@else<span
                                    class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.pages.edit', $page) }}"
                                class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                                    class="text-red-600"><i class="fas fa-trash"></i></button></form>
                        </td>
                </tr>@empty<tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No pages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $pages->links() }}</div>
    </div>
@endsection
