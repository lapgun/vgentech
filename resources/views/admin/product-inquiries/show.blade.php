@extends('layouts.admin')

@section('title', __('Inquiry Details'))
@section('page-title', __('Product Inquiry Details'))

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ __('Inquiry') }} #{{ $inquiry->id }}
                    </h3>
                    @if ($inquiry->is_processed)
                        <span class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i>{{ __('Processed') }}
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">
                            <i class="fas fa-clock mr-1"></i>{{ __('New') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <!-- Customer Information -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">{{ __('Customer Information') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('Name') }}</label>
                            <p class="mt-1 text-gray-900">{{ $inquiry->customer_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('Email') }}</label>
                            <p class="mt-1">
                                @if ($inquiry->customer_email)
                                    <a href="mailto:{{ $inquiry->customer_email }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        {{ $inquiry->customer_email }}
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('Phone') }}</label>
                            <p class="mt-1 text-gray-900">{{ $inquiry->customer_phone ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('Company') }}</label>
                            <p class="mt-1 text-gray-900">{{ $inquiry->customer_company ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">{{ __('Product Information') }}</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if ($inquiry->product)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $inquiry->product->name }}</p>
                                    <p class="text-sm text-gray-500">SKU: {{ $inquiry->product->sku ?? '-' }}</p>
                                </div>
                                <a href="{{ route('admin.products.edit', $inquiry->product) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm">
                                    {{ __('View Product') }} <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('Product not available') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">{{ __('Message') }}</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $inquiry->message ?? __('No message provided') }}
                        </p>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">{{ __('Additional Information') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('Received Date') }}</label>
                            <p class="mt-1 text-gray-900">{{ $inquiry->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('IP Address') }}</label>
                            <p class="mt-1 text-gray-900">{{ $inquiry->ip_address ?? '-' }}</p>
                        </div>
                        @if ($inquiry->is_processed && $inquiry->processed_at)
                            <div>
                                <label class="text-sm font-medium text-gray-500">{{ __('Processed Date') }}</label>
                                <p class="mt-1 text-gray-900">{{ $inquiry->processed_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <a href="{{ route('admin.product-inquiries.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i>{{ __('Back to List') }}
                </a>

                <div class="flex items-center space-x-3">
                    @if (!$inquiry->is_processed)
                        <form action="{{ route('admin.product-inquiries.mark-read', $inquiry) }}" method="POST"
                            class="inline">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700">
                                <i class="fas fa-check mr-2"></i>{{ __('Mark as Processed') }}
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.product-inquiries.mark-unread', $inquiry) }}" method="POST"
                            class="inline">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-gray-700">
                                <i class="fas fa-undo mr-2"></i>{{ __('Mark as Unprocessed') }}
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.product-inquiries.destroy', $inquiry) }}" method="POST" class="inline"
                        onsubmit="return confirm('{{ __('Are you sure you want to delete this inquiry?') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i>{{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
