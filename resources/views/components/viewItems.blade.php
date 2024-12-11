@extends('masterLayout')

@section('title')
    @if (!empty($collections))
        {{ $collections }} |
    @endif
    @if (!empty($categories))
        {{ $categories }} |
    @endif
    @if (!empty($name))
        {{ $name }}
    @endif
@endsection

@push('styles')
    <style>
        .product-row {
            display: flex;
            align-items: stretch;
            border: 1px solid gray;
            border-radius: 8px;
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
            justify-content: space-between;
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

        .product-list {
            max-height: 80vh;
            overflow-y: scroll;
            padding-right: 15px;
            scrollbar-width: thin;
            scrollbar-color: transparent transparent;
        }

        .product-list::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        .product-list::-webkit-scrollbar-thumb {
            background: transparent;
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
                    <a href="/" class="mr-2">Home</a>
                    @if (!empty($collections))
                        <i class="fa-solid fa-chevron-right"></i>
                        <a
                            href="{{ route('viewItems', [
                                'prod_collection_slg' => Str::slug(Str::title($product[0]->prod_collection)),
                                'prod_category_slg' => 'all-categories',
                                'prod_name_slg' => 'all-names',
                            ]) }}">{{ $collections }}</a>
                    @endif
                    @if (!empty($categories))
                        <i class="fa-solid fa-chevron-right"></i>
                        <a
                            href="{{ route('viewItems', [
                                'prod_category_slg' => Str::slug(Str::title($categories)),
                                'prod_collection_slg' => 'all-collections',
                                // 'prod_name_slg' => 'all-names',
                            ]) }}">
                            {{ Str::title($categories) }}
                        </a>
                    @endif
                    @if (!empty($names))
                        <i class="fa-solid fa-chevron-right"></i>
                        <a
                            href="{{ route('viewItems', [
                                'prod_name_slg' => Str::slug(Str::title($names)),
                                'prod_category_slg' => 'all-categories',
                                'prod_collection_slg' => 'all-collections',
                            ]) }}">{{ Str::title($names) }}</a>
                    @endif
                </nav>
            </div>
            <div class="col-12 product-list">
                @forelse ($product as $item)
                    <div class="col-12 py-2">
                        <div class="product-row">
                            <div class="col-12 col-md-3">
                                <a href="#" class="d-block">
                                    <img src="{{ asset('images/prod_image/' . $item->firstImage->image_name) }}"
                                        alt="Product Image" class="product-image">
                                </a>
                            </div>
                            <div class="col-12 col-md-6 ">
                                <form method="POST" style="cursor: pointer;height:100%;" class="product-details"
                                    action="{{ route('viewItem', [
                                        'prod_category_slg' => Str::slug($item->prod_category),
                                        'prod_name_slg' => Str::slug($item->prod_name),
                                        'prod_code_slg' => Str::slug($item->prod_code),
                                    ]) }}"
                                    onclick="submit(this);">
                                    @csrf
                                    <input type="hidden" id="secure_prod_id" name="secure_prod_id"
                                        value="{{ $item->secure_prod_id }}" />
                                    <input type="hidden" id="prod_category" name="prod_category"
                                        value="{{ $item->prod_category }}" />
                                    <input type="hidden" id="prod_name" name="prod_name" value="{{ $item->prod_name }}" />
                                    <h4 class="product-name">{{ $item->prod_name }}</h4>
                                    <h5 class="product-category">Category: {{ $item->prod_category }}</h5>
                                    <p class="product-description">{{ $item->prod_desc }}</p>
                                </form>
                            </div>
                            <div class="col-12 col-md-3 text-center d-flex flex-column justify-content-center">
                                <p class="product-price">Price: Rs. {{ $item->prod_amount }}</p>
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
    </div>
@endsection
