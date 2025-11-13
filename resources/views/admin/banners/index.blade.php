@extends('layouts.admin')
@section('title', __('Banners'))
@section('page-title', __('Banners'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between">
            <h2 class="text-lg font-semibold">{{ __('All Banners') }}</h2><a href="{{ route('admin.banners.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg"><i class="fas fa-plus mr-2"></i>{{ __('Add Banner') }}</a>
        </div>
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Image') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Title') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Order') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($banners as $banner)
                    <tr>
                        <td class="px-6 py-4">
                            @if ($banner->image)
                                <img src="{{ asset('storage/' . $banner->image) }}" class="h-12 w-20 object-cover rounded">
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $banner->title }}</td>
                        <td class="px-6 py-4">{{ $banner->sort_order }}</td>
                        <td class="px-6 py-4">
                            @if ($banner->is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Active</span>@else<span
                                    class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.banners.edit', $banner) }}"
                                class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit"
                                    class="text-red-600"><i class="fas fa-trash"></i></button></form>
                        </td>
                </tr>@empty<tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No banners found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $banners->links() }}</div>
    </div>
@endsection
