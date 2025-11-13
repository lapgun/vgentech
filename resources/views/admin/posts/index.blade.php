@extends('layouts.admin')
@section('title', __('Blog Posts'))
@section('page-title', __('Blog Posts'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">{{ __('All Posts') }}</h2>
            <a href="{{ route('admin.posts.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg"><i
                    class="fas fa-plus mr-2"></i>{{ __('Add Post') }}</a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Title') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Author') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Published') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($posts as $post)
                    <tr>
                        <td class="px-6 py-4">{{ $post->title }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $post->author }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $post->published_at ? $post->published_at->format('Y-m-d') : '-' }}</td>
                        <td class="px-6 py-4">
                            @if ($post->is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Active</span>@else<span
                                    class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.posts.edit', $post) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                                    class="text-red-600"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $posts->links() }}</div>
    </div>
@endsection
