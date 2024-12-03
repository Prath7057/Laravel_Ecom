@extends('masterLayout')

@section('title', 'Home')

@push('styles')
  <style>
    body {
      font-family: 'Times New Roman', Times, serif !important;
    }
      @media (max-width: 768px) {
          .carousel-inner img {
              height: 40vh;
          }
          .carousel-caption {
              position: absolute;
              bottom:2%;
              left: 50%;
              transform: translateX(-50%);
              color: white;
              padding: 10px;
              width: 80%;
              text-align: center;
              border-radius: 5px;
          }
      }
      
  </style>
@endpush

@section('contents')
    @include('components.header')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach (['First', 'Second', 'Third'] as $key => $title)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('images/site_images/slider.webp') }}" class="d-block w-100" alt="{{ $title }} slide">
                    <div class="carousel-caption text-black d-flex flex-column justify-content-center align-items-center">
                      <h5>{{ $title }} Slide Title</h5>
                      <p>Description for the {{ strtolower($title) }} slide.</p>
                  </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    @php
        $divBackgroundColors = ['#f4fff0', '#faf3e3', '#f9fae6'];
        $headingBackgroundColors = ['#e8fae1', '#faeed2', '#f9fadc'];
        $addToCartBackgroundColors = ['#d4f7b1', '#f9e7d0', '#f1f9d9'];
    @endphp
    @foreach (['Trending Items' => $trendingProducts, 'Highest Selling Items' => $topSellingProducts, 'Recommended Items' => $recommendedProducts] as $title => $products)
        @if ($products->isNotEmpty())
            <div class="container-fluid" style="background-color: {{ $divBackgroundColors[$loop->index]  }}">
                <div class="d-flex justify-content-between align-items-center" style="background-color: {{ $headingBackgroundColors[$loop->index] }}">
                    <h3 class="mt-2">{{ $title }}</h3>
                    <a href="" class="btn btn-link text-decoration-underline me-2" style="font-size: 1.2rem;">View All</a>
                </div>
                <div class="row">
                  @php 
                  $backgroundColor = $headingBackgroundColors[$loop->index];
                  $addTocartBackground = $addToCartBackgroundColors[$loop->index];
                  @endphp
                  @foreach ($products as $index => $product)
                      @include('components.product-card', [
                          'product' => $product,
                          'backgroundColor' => $backgroundColor,
                          'addTocartBackground' => $addTocartBackground
                      ])
                  @endforeach
              </div>              
            </div>
        @endif
    @endforeach
@endsection
