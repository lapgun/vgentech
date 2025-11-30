@extends('layouts.admin')
@section('title', __('Testimonials'))
@section('page-title', __('Testimonials'))
@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between">
            <h2 class="text-lg font-semibold">{{ __('All Testimonials') }}</h2>
            <a href="{{ route('admin.testimonials.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg"><i
                    class="fas fa-plus mr-2"></i>{{ __('Add Testimonial') }}</a>
        </div>
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Client') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Position') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Company') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Rating') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="px-6 py-4">{{ $testimonial->customer_name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $testimonial->customer_position ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $testimonial->customer_company ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if ($testimonial->rating)
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($testimonial->is_active)
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Active</span>@else<span
                                    class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                <button type="submit" class="text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No testimonials found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $testimonials->links() }}</div>
    </div>
@endsection
