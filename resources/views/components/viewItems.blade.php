@extends('masterLayout')

@section('title')
    {{ implode(' > ', $fiterData) }} - Product Details
@endsection

@push('styles')
    <style>
        .product-row {
            display: flex;
            align-items: stretch;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            height: 100%;
        }

        .product-row:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.01);
        }

        .product-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-around;

            padding: 0 10px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .product-category {
            font-size: 1rem;
            color: gray;
        }

        .product-description {
            font-size: 0.9rem;
            color: #555;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: green;
        }

        .btn-warning {
            background-color: #ff9800;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e68900;
        }

        .btn-primary {
            background-color: #2874f0;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1858c5;
        }

        @media (max-width: 768px) {
            .product-row {
                flex-direction: column;
                text-align: center;
            }

            .product-details {
                padding: 10px 0;
            }

            .product-image {
                height: auto;
            }
        }
    </style>
@endpush

@section('contents')
    @include('components.header')

    <div class="container pt-3">
        <div class="row">
            <div class="col-12">
                <nav class="navigation mb-3">
                    @foreach ($fiterData as $index => $filter)
                        <a href="#" class="mr-2">{{ $filter }}</a>
                        @if ($index < count($fiterData) - 1)
                            <i class="fa fa-chevron-right"></i>
                        @endif
                    @endforeach
                </nav>
            </div>
            @forelse ($product as $item)
                <div class="col-12 py-2">
                    <div class="product-row">
                        <div class="col-12 col-md-3">
                            <a href="#" class="d-block">
                                <img src="{{ asset('images/prod_image/' . $item->firstImage->image_name) }}" alt="Product Image"
                                    class="product-image">
                            </a>
                        </div>
                        <div class="col-12 col-md-6 product-details">
                            <h4 class="product-name">{{ $item->prod_name }}</h4>
                            <h5 class="product-category">Category: {{ $item->prod_category }}</h5>
                            <p class="product-description">{{ $item->prod_desc }}</p>
                        </div>
                        <div class="col-12 col-md-3 text-center d-flex flex-column justify-content-center">
                            <p class="product-price">Price: ${{ $item->prod_amount }}</p>
                            <a href="#" class="btn btn-primary mb-2">
                                <i class="fa fa-credit-card"></i> Buy Now
                            </a>
                            <a href="#" class="btn btn-warning">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No products found for the selected filters.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
