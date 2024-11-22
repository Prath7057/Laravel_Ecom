@extends('masterLayout')

@section('title')
Home
@endsection

@section('contents')
@include('components.header')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/1200x300" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-black">
                <h5>First Slide Title</h5>
                <p>Description for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x300" class="d-block w-100" alt="Second slide">
            <div class="carousel-caption d-none d-md-block text-black">
                <h5>Second Slide Title</h5>
                <p>Description for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x300" class="d-block w-100" alt="Third slide">
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

<div class="container-fluid">
  <h2>Trending Items</h2>
  <div class="row" style="">
      @for ($i = 1; $i <= 4; $i++) 
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card" style="width: 100%;">
              <div style="height: 200px; overflow: hidden;">
                  <img src="https://via.placeholder.com/300x200" class="card-img-top w-100 h-100" style="object-fit: cover;"
                      alt="Card image">
              </div>
              <div class="card-body">
                  <h5 class="card-title">Item Name {{ $i }}</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                  <a href="#" class="btn btn-primary">More Details</a>
              </div>
          </div>
      </div>
      @endfor
  </div>
</div>

<div class="container-fluid">
  <h2>Highest Selling Items</h2>
  <div class="row" style="">
      @for ($i = 1; $i <= 4; $i++)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card" style="width: 100%;">
              <div style="height: 200px; overflow: hidden;">
                  <img src="https://via.placeholder.com/300x200" class="card-img-top w-100 h-100" style="object-fit: cover;"
                      alt="Card image">
              </div>
              <div class="card-body">
                  <h5 class="card-title">Item Name {{ $i }}</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                  <a href="#" class="btn btn-primary">More Details</a>
              </div>
          </div>
      </div>
       @endfor
  </div>
</div>

@endsection