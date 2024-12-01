@extends('masterLayout')

@section('title')
Home
@endsection

@section('contents')
@include('components.header')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('images/site_images/slider.webp')}}" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-black">
                <h5>First Slide Title</h5>
                <p>Description for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('images/site_images/slider.webp')}}" class="d-block w-100" alt="Second slide">
            <div class="carousel-caption d-none d-md-block text-black">
                <h5>Second Slide Title</h5>
                <p>Description for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('images/site_images/slider.webp')}}" class="d-block w-100" alt="Third slide">
            <div class="carousel-caption d-none d-md-block text-black">
                <h5>Third Slide Title</h5>
                <p>Description for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

@if (count($trendingProducts) > 0)
<div class="container-fluid" style="background-color: #f7faeb">
  <h2>Trending Items</h2>
  <div class="row" style="">
      @foreach($trendingProducts as $product)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card" style="width: 100%;">
              <div style="height: 200px; overflow: hidden;">
                <img src="{{ $product->firstImage && $product->firstImage->image_name ? asset('images/prod_image/' . $product->firstImage->image_name) : asset('images/site_images/prod_image.webp') }}" 
                alt="" class="card-img-top w-100 h-100" style="object-fit: contain;"
                    >
              </div>
              <div class="card-body">
                  <h5 class="card-title">{{ $product->prod_name }}</h5>
                  <p class="card-text">
                    {{ $product->prod_desc }}
                  </p>
                  <a href="#" class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> {{$product->prod_amount}}
                  </a>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</div>
@endif

@if (count($topSellingProducts) > 0)
<div class="container-fluid" style="background-color: #ebfaeb">
  <h2>Highest Selling Items</h2>
  <div class="row" style="">
      @foreach($topSellingProducts as $product)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card" style="width: 100%;">
              <div style="height: 200px; overflow: hidden;">
                  <img src="{{ $product->firstImage && $product->firstImage->image_name ? asset('images/prod_image/' . $product->firstImage->image_name) : asset('images/site_images/prod_image.webp') }}" 
                  alt="{{ $product->prod_name }}" class="card-img-top w-100 h-100" style="object-fit: contain;"
                      >
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ $product->prod_name }}</h5>
                <p class="card-text">
                  {{ $product->prod_desc }}
                </p>
                <a href="#" class="btn btn-primary">
                  <i class="fa fa-shopping-cart"></i> {{$product->prod_amount}}
                </a>
            </div>
          </div>
      </div>
      @endforeach
  </div>
</div>
@endif

@if(count($recommendedProducts) > 0)
<div class="container-fluid" style="background-color: #ebf9fa">
    <h2>Recommanded Items</h2>
    <div class="row" style="">
        @foreach($recommendedProducts as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card" style="width: 100%;">
                <div style="height: 200px; overflow: hidden;">
                    <img src="{{ $product->firstImage && $product->firstImage->image_name ? asset('images/prod_image/' . $product->firstImage->image_name) : asset('images/site_images/prod_image.webp') }}" 
                    alt="{{ $product->prod_name }}" class="card-img-top w-100 h-100" style="object-fit: contain;"
                        >
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $product->prod_name }}</h5>
                  <p class="card-text">
                    {{ $product->prod_desc }}
                  </p>
                  <a href="#" class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> {{$product->prod_amount}}
                  </a>
              </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
@endif
  @endsection