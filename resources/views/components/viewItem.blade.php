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
            transform: scale(1.22);
            opacity: 1;
        }
    </style>
@endpush

@section('contents')
    @include('components.header')

    <div class="container pt-3" style="height:90vh;">
        <div class="row" style="height: 100%;">
            <div class="col-lg-5 col-12" style="background-color: #f0f0f0;">
                <div class="container-fluid boxSizing" style="">
                    <div class="row">
                        <div class="mt-5 col-lg-12 col-12 p-2 mainImageDiv" style="height:auto; border:6px solid #ffffff;">
                            <img id="mainImageDiv"
                                src="{{ asset('images/prod_image/' . $product->AllImages[0]->image_name) }}"
                                class="img-fluid" style="height:350px; width:100%;" />
                                <img id="orgImageDiv" src="{{ asset('images/prod_image/' . $product->AllImages[0]->image_name) }}" style="display:none;" />
                        </div>
                        <div class="col-lg-12 col-12 mt-3">
                            <div class="d-flex justify-content-center">
                                @for ($i = 1; $i < 4; $i++)
                                    @if (isset($product->AllImages[$i]))
                                        <div style="box-sizing: border-box;border:4px solid white;">
                                            <img src="{{ asset('images/prod_image/' . $product->AllImages[$i]->image_name) }}"
                                                class="img-fluid thumbnail" style="height: 120px; width: 100%;"
                                                onmouseover="document.getElementById('mainImageDiv').src = this.src;"
                                                onclick="document.getElementById('mainImageDiv').src = this.src;"
                                                onmouseout="document.getElementById('mainImageDiv').src = document.getElementById('orgImageDiv').src;" />
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12" style="background-color: rgb(228, 228, 228);">
                <div class="mt-1" style="color: gray;font-size:1.1rem">                    
                    <a  href="/"> Home </a> <i class="fa-solid fa-chevron-right"></i>
                    <a  href="/viewItem/{{$product->prod_category}}"> {{$product->prod_category}} </a> <i class="fa-solid fa-chevron-right"></i>
                    <a  href="/viewItem/{{$product->prod_category}}/{{$product->prod_name}}"> {{$product->prod_name}} </a> <i class="fa-solid fa-chevron-right"></i>
                    <a class="" href="/viewItem/{{$product->prod_category}}/{{$product->prod_name}}/{{$product->prod_code}}"> {{$product->prod_code}} </a>
                </div>
            </div>
        </div>
    </div>
    {{-- end view item code --}}
@endsection
