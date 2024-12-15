@extends('masterLayout')

@section('title')
    {{ $product->prod_name }}
@endsection

@push('styles')
    <style>
        .boxSizing {
            box-sizing: border-box;
        }

        .thumbnail:hover {
            box-sizing: border-box;
            border: 4px solid #2874f0;
            transform: scale(1.18);
            transition: transform 0.3s ease-in-out; 
            opacity: 1;
        }

        .navigation {
            color: gray;
            font-size: 1.08rem;
        }

        @media screen and (max-width: 768px) {
            .navigation {
                font-size: 0.85rem;
            }
            .productAllImages{
                border-bottom: 2px dashed gray;
            }
        }

        .navigation a {
            color: gray;
        }

        .navigation a:hover {
            color: #2874f0;
            text-decoration: underline !important;
        }

        .navigation i:hover {
            color: #2874f0;
            transform: scale(1.2);
        }

        .product-details {
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .product-name {
            font-weight: bold;
            color: #333;
            font-size: 2rem;
        }

        .product-category {
            font-size: 1.2rem;
        }

        .product-description {
            font-size: 1rem;
            line-height: 1.5;
        }

        .product-price {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-warning {
            background-color: #ff9800;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e68900;
        }

        .btn-primary {
            background-color: #2874f0;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1858c5;
        }

        .img-zoom-container {
            position: relative;
        }

        .img-zoom-lens {
            position: absolute;
            border: 2px solid rgba(40, 116, 240, 0.8);
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.4);
            cursor: none;
        }

        .img-zoom-result {
            border: 1px solid #d4d4d4;
        }
    </style>
@endpush

@section('contents')
    @include('components.header')

    <div class="container" style="height:90vh;">
        <div class="row" style="height: 100%;">
            <div class="col-lg-5 col-12" style="background-color: #f0f0f0;">
                <div class="container-fluid boxSizing" style="">
                    <div class="row">
                        <div class="mt-2 col-lg-12 col-12 p-2 img-zoom-container" 
                            style="height:auto; border:6px solid #ffffff;outline:1px dotted #2874f0;">
                            <img id="mainImageDiv"
                                src="{{ asset('images/prod_image/' . $product->AllImages[0]->image_name) }}"
                                class="img-fluid" style="height:350px; width:100%;"
                                onmouseover="imageZoom('mainImageDiv','imageZoomResultDiv');" />
                            <img id="orgImageDiv"
                                src="{{ asset('images/prod_image/' . $product->AllImages[0]->image_name) }}"
                                style="display:none;" />
                        </div>
                        <div class="col-lg-12 col-12 mt-3 productAllImages" onmouseover="removeImageZoom();">
                            <div class="d-flex justify-content-center">
                                @php
                                    $imageCount = count($product->AllImages);
                                @endphp
                                @for ($i = 1; $i < 4; $i++)
                                    @if (isset($product->AllImages[$i]))
                                        <div style="box-sizing: border-box;border:4px solid white;width:{{100/$imageCount}}%">
                                            <img src="{{ asset('images/prod_image/' . $product->AllImages[$i]->image_name) }}"
                                                class="img-fluid thumbnail" style="height: 120px; width: 100%;"
                                                onmouseover="document.getElementById('mainImageDiv').src = this.src;"
                                                onclick="document.getElementById('mainImageDiv').src = this.src;
                                                this.src = document.getElementById('orgImageDiv').src;
                                                document.getElementById('orgImageDiv').src = document.getElementById('mainImageDiv').src;"
                                                onmouseout="document.getElementById('mainImageDiv').src = document.getElementById('orgImageDiv').src;" />
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="imageZoomResultDiv" class="col-lg-7 col-12 img-zoom-result"
                onmouseover="removeImageZoom();">
                <div class="mt-1 navigation mainResponce" style="">
                    <a href="/">Home</a> <i class="fa-solid fa-chevron-right"></i>
                    <a
                        href="{{ route('viewItems', [
                            'prod_collection_slg' => Str::slug(Str::title($product->prod_collection)),
                        ]) }}">
                        {{ Str::title($product->prod_collection) }}</a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <a
                        href="{{ route('viewItems', [
                            'prod_collection_slg' => Str::slug($product->prod_collection),
                            'prod_category_slg' => Str::slug($product->prod_category),
                        ]) }}">
                        {{ Str::title($product->prod_category) }}</a>
                    <i class="fa-solid fa-chevron-right"></i>

                    <a
                        href="{{ route('viewItems', [
                            'prod_collection_slg' => Str::slug($product->prod_collection),
                            'prod_category_slg' => Str::slug($product->prod_category),
                            'prod_name_slg' => Str::slug($product->prod_name),
                        ]) }}">
                        {{ Str::title($product->prod_name) }}</a>
                    <i class="fa-solid fa-chevron-right"></i>

                    <a
                        href="{{ route('viewItems', [
                            'prod_collection_slg' => Str::slug($product->prod_collection),
                            'prod_category_slg' => Str::slug($product->prod_category),
                            'prod_name_slg' => Str::slug($product->prod_name),
                            'prod_code_slg' => Str::slug($product->prod_code),
                        ]) }}">
                        {{ ($product->prod_code) }} </a>

                </div>
                <div class="container product-details mt-3 mainResponce" style="">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="product-name mb-3">{{ $product->prod_name }}</h2>
                            <h4 class="product-category text-muted mb-3">{{ $product->prod_category }}</h4>
                            <p class="product-description text-secondary mb-4" style="text-align: justify;">{{ $product->prod_desc }}</p>
                            <h4 class="product-price text-success mb-4">Price: {{ $product->prod_amount }}</h4>
                            <div class="d-flex justify-content-between flex-wrap">
                                <a href="#" class="btn btn-primary btn-lg px-4">
                                    <i class="fa fa-credit-card"></i> Buy Now
                                </a>
                                <a href="#" class="btn btn-warning btn-lg px-4">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end view item code --}}
@endsection
