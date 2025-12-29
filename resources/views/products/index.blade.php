@extends('layouts.main')

@section('title', __('common.products') . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <h1 class="animate-fadeInUp"><i class="fas fa-box"></i> {{ __('common.products') }}</h1>
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ __('common.products') }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3 mb-4">
                <!-- Categories Filter -->
                <div class="card mb-3">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-filter"></i> {{ __('common.categories') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('products.index') }}" 
                               class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                                {{ __('common.all_products') }}
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                                   class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                                    {{ $category->name }}
                                    @if($category->children->count() > 0)
                                        <i class="fas fa-angle-down float-end"></i>
                                    @endif
                                </a>
                                @foreach($category->children as $child)
                                    <a href="{{ route('products.index', ['category' => $child->slug]) }}" 
                                       class="list-group-item list-group-item-action ps-4 {{ request('category') == $child->slug ? 'active' : '' }}">
                                        <i class="fas fa-angle-right"></i> {{ $child->name }}
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Search Box -->
                <div class="card">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-search"></i> {{ __('common.search') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('products.index') }}">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="{{ __('common.search') }}..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Toolbar -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <p class="mb-0">{{ __('common.showing') }} <strong>{{ $products->count() }}</strong> {{ __('common.of') }} <strong>{{ $products->total() }}</strong> {{ __('common.products') }}</p>
                    </div>
                    <div>
                        <form method="GET" action="{{ route('products.index') }}" class="d-inline">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao đến thấp</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="row g-4">
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="card h-100">
                                        <img src="{{ $product->featured_image_url ?? 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&q=80' }}" 
                                         class="card-img-top" alt="{{ $product->name }}" 
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <span class="badge bg-primary mb-2">{{ $product->category->name }}</span>
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small">
                                            {{ Str::limit($product->short_description ?? $product->description, 80) }}
                                        </p>
                                        <p class="text-danger fw-bold"><i class="fas fa-phone-alt text-danger"></i> Giá: Liên hệ</p>
                                        <p class="text-muted small">
                                            <i class="fas fa-eye"></i> {{ $product->view_count }} {{ __('common.view_count') }}
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <a href="{{ route('products.show', $product->slug) }}" 
                                           class="btn btn-primary btn-sm w-100">
                                            <i class="fas fa-eye"></i> {{ __('common.view_details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> {{ __('common.no_products_found') }}.
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
