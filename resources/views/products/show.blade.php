@extends('layouts.main')

@section('title', $product->name . ' - VgenTech')

@section('content')
<!-- Page Header -->
<div class="page-header-bg text-white py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="animate-fadeIn">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('common.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-white">{{ __('common.products') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-white">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Product Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Product Images -->
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="{{ $product->featured_image ?? 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=1000&q=80' }}" 
                             class="img-fluid rounded mb-3" alt="{{ $product->name }}">
                        
                        @if($product->gallery && is_array($product->gallery))
                            <div class="row g-2">
                                @foreach($product->gallery as $image)
                                    <div class="col-3">
                                        <img src="{{ $image }}" class="img-fluid rounded" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">{{ $product->category->name }}</span>
                        <h1 class="mb-3">{{ $product->name }}</h1>
                        
                        @if($product->price)
                            <h3 class="text-danger mb-3">{{ number_format($product->price) }} VNĐ</h3>
                        @else
                            <h4 class="text-muted mb-3">{{ __('common.contact_for_price') }}</h4>
                        @endif

                        <p class="lead">{{ $product->short_description }}</p>

                        <hr>

                        <div class="product-description">
                            {!! $product->description !!}
                        </div>

                        @if($product->specifications)
                            <hr>
                            <h4><i class="fas fa-list-check"></i> {{ __('common.technical_specs') }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    @foreach($product->specifications as $key => $value)
                                        <tr>
                                            <th width="30%" class="bg-light">{{ $key }}</th>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif

                        <div class="d-flex align-items-center text-muted mt-4">
                            <i class="fas fa-eye me-2"></i>
                            <span>{{ $product->view_count }} {{ __('common.view_count') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                @if($relatedProducts->count() > 0)
                    <div class="card">
                        <div class="card-header card-header-gradient text-white">
                            <h4 class="mb-0"><i class="fas fa-boxes"></i> {{ __('common.related_products') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach($relatedProducts as $related)
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <img src="{{ $related->featured_image ?? 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&q=80' }}" 
                                                 class="card-img-top" alt="{{ $related->name }}"
                                                 style="height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $related->name }}</h6>
                                                @if($related->price)
                                                    <p class="text-danger fw-bold">{{ number_format($related->price) }} VNĐ</p>
                                                @else
                                                    <p class="text-muted">{{ __('common.contact') }}</p>
                                                @endif
                                                <a href="{{ route('products.show', $related->slug) }}" 
                                                   class="btn btn-primary btn-sm w-100">
                                                    {{ __('common.view_details') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <!-- Inquiry Form -->
                <div class="card mb-4">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> {{ __('common.request_quote') }}</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('products.inquiry', $product->slug) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('common.full_name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('common.your_phone') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">{{ __('common.your_message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> {{ __('common.send_message') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card">
                    <div class="card-header card-header-gradient text-white">
                        <h5 class="mb-0"><i class="fas fa-phone"></i> {{ __('common.contact_directly') }}</h5>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-phone text-primary"></i> <strong>{{ __('common.hotline') }}:</strong><br>
                           <a href="tel:0123456789">0123 456 789</a></p>
                        <p><i class="fas fa-envelope text-primary"></i> <strong>{{ __('common.email') }}:</strong><br>
                           <a href="mailto:info@vgentech.vn">info@vgentech.vn</a></p>
                        <p><i class="fas fa-clock text-primary"></i> <strong>{{ __('common.working_hours') }}:</strong><br>
                           {{ __('common.monday_friday') }}: 8:00 - 17:30<br>
                           {{ __('common.saturday') }}: 8:00 - 12:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
