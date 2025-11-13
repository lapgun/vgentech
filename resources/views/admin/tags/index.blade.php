@extends('layouts.admin')
@section('title', __('Tags'))
@section('page-title', __('Tags'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between">
            <h2 class="text-lg font-semibold">{{ __('All Tags') }}</h2><a href="{{ route('admin.tags.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg"><i class="fas fa-plus mr-2"></i>{{ __('Add Tag') }}</a>
        </div>
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Slug') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Posts Count') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($tags as $tag)
                    <tr>
                        <td class="px-6 py-4">{{ $tag->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $tag->slug }}</td>
                        <td class="px-6 py-4">{{ $tag->posts_count }}</td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.tags.edit', $tag) }}"
                                class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                                    class="text-red-600"><i class="fas fa-trash"></i></button></form>
                        </td>
                </tr>@empty<tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No tags found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $tags->links() }}</div>
    </div>
@endsection
