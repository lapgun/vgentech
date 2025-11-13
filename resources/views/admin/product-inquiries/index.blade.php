@extends('layouts.admin')

@section('title', __('Product Inquiries'))
@section('page-title', __('Product Inquiries'))

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">{{ __('Product Inquiry Messages') }}</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Customer') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Product') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Contact') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Date') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inquiries as $inquiry)
                        <tr class="{{ $inquiry->is_processed ? '' : 'bg-blue-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $inquiry->customer_name }}</div>
                                @if ($inquiry->customer_company)
                                    <div class="text-sm text-gray-500">{{ $inquiry->customer_company }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $inquiry->product->name ?? __('N/A') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($inquiry->customer_email)
                                    <div class="text-sm text-gray-900">{{ $inquiry->customer_email }}</div>
                                @endif
                                @if ($inquiry->customer_phone)
                                    <div class="text-sm text-gray-500">{{ $inquiry->customer_phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $inquiry->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($inquiry->is_processed)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i>{{ __('Processed') }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                        <i class="fas fa-clock mr-1"></i>{{ __('New') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <a href="{{ route('admin.product-inquiries.show', $inquiry) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3" title="{{ __('View') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.product-inquiries.destroy', $inquiry) }}" method="POST"
                                    class="inline" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        title="{{ __('Delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                {{ __('No inquiries found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
@endsection
