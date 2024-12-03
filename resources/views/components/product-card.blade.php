<form method="POST"
    action="{{ route('viewItem', ['prod_id' => $product->prod_id, 'prod_category' => Str::slug($product->prod_category)]) }}"
    onclick="submit(this);">
    @csrf
    <input type="hidden" id="secure_prod_id" name="secure_prod_id" value="{{ $product->secure_prod_id }}" />
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card" style="width: 100%;">
            <div style="height: 200px; overflow: hidden;">
                <img src="{{ $product->firstImage->image_name ? asset('images/prod_image/' . $product->firstImage->image_name) : asset('images/site_images/prod_image.webp') }}"
                    alt="{{ $product->prod_name }}" class="card-img-top w-100 h-100" style="object-fit: contain;">
            </div>
            <div class="card-body" style="background-color: {{ $backgroundColor }}">
                <h5 class="card-title">{{ $product->prod_name }}</h5>
                <p class="card-text">{{ $product->prod_desc }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn btn-warning" style="background: {{ $addTocartBackground }}">
                        <i class="fa fa-shopping-cart"></i> Add To cart
                    </a>
                    @php
                        $discountPercentage = rand(7, 15);
                        $originalPrice = $product->prod_amount;
                        $mrp = round($originalPrice / (1 - $discountPercentage / 100), 2);
                    @endphp
                    <a class="" style="font-size:1.5rem;" title="Click here to see more details">
                        <sup>₹</sup>{{ $originalPrice }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
