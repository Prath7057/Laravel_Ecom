@extends('admin')

@section('adminContent')
@php
    print_r($errors);
@endphp
    <div class="container">
        <div class="row justify-content-center mt-5">
            <form method="POST" action="{{ route('addItemData') }}" class="bg-light bg-gradient p-3" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">                    
                    <div class="col-md-6">
                        <label for="prod_code" class="form-label">
                            Item Code<span style="color: red;"> *</span>
                        </label>
                        <input type="text" class="form-control" value="{{ old('prod_code', $product->prod_code ?? '') }}" id="prod_code" name="prod_code" placeholder="Item Code">
                    </div>
                    <div class="col-md-6">
                        <label for="prod_amount" class="form-label">
                            Item Price<span style="color: red;"> *</span>
                        </label>
                        <input type="text" class="form-control" value="{{old('prod_amount', $product->prod_amount ?? '')}}" id="prod_amount" name="prod_amount" placeholder="Add Item Price">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="itemName1" class="form-label">
                            Item Category<span style="color: red;"> *</span>
                        </label>
                        <input type="text" class="form-control" id="prod_category" name="prod_category"
                            value="{{ old('prod_category', $product->prod_category ?? '') }}" required
                        placeholder="Add Item Category Upto 16 Characters">
                    </div>
                    <div class="col-md-6">
                        <label for="itemName2" class="form-label">
                            Item Name<span style="color: red;"> *</span>
                        </label>
                        <input type="text" class="form-control" id="prod_name" name="prod_name"
                            value="{{ old('prod_name', $product->prod_name ?? '') }}" required
                        placeholder="Add Item name Upto 16 Characters">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        Item Description<span style="color: red;"> *</span>
                    </label>
                    <textarea class="form-control" id="prod_desc" name="prod_desc" rows="3"
                        placeholder="Add Item Description up to 64 Characters" oninput="updateWordCount()">{{ old('prod_desc', $product->prod_desc ?? '') }}</textarea>
                    <small id="wordCount" class="form-text text-muted">Word count: 0</small>
                </div>
                <label for="exampleFormControlTextarea1" class="form-label">
                    Item Collection
                    <span style="color: red;">*</span>
                </label>
                <div class="d-flex align-items-center">

                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio" name="prod_collection" id="prod_collection1"
                            value="trending" {{ $product->prod_collection == 'trending' ? 'checked' : '' }} >
                        <label class="form-check-label" for="prod_collection1">
                            Trending 
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio" name="prod_collection" id="prod_collection2"
                            value="top_selling" {{ $product->prod_collection == 'top_selling' ? 'checked' : '' }} >
                        <label class="form-check-label" for="prod_collection2">
                            Best Seller
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio" name="prod_collection" id="prod_collection3"
                            value="recommended" {{ $product->prod_collection == 'recommended' ? 'checked' : '' }} >
                        <label class="form-check-label" for="prod_collection3">
                            Recommanded 
                        </label>
                    </div>
                </div>
                @php $inputTypeFileCount = 1;@endphp
                <div class="mb-3 mt-2">
                    <label for="customFile" class="form-label">Upload Image</label>
                    <div class="input-group align-items-center mt-1">
                        <span id="addMoreButton" title="add more images (upto 4)" class="rounded-pill"
                            style="cursor:pointer;color:white; display: flex; align-items: center; justify-content: center;background:rgb(46, 135, 46);"
                            onclick="addInputTypeFile(document.getElementById('inputTypeFileCount').value);"
                            >
                            <i class="fa-solid fa-plus" style="font-size: 1.2rem;"></i>
                        </span>
                        <input type="file" class="ms-2 form-control" id="prod_image{{$inputTypeFileCount}}" name="prod_image{{$inputTypeFileCount}}" aria-label="Upload"
                            accept="image/*">
                            <input type="hidden" id="inputTypeFileCount" name="inputTypeFileCount" value="{{$inputTypeFileCount}}" />
                    </div>
                    <div id="inputTypeFileDiv{{$inputTypeFileCount}}" class="input-group align-items-center mt-1">
                    </div>
                </div>                
                <div class="mt-2 d-grid gap-2 d-md-flex justify-content-md-start">
                    <button class="btn btn-primary" type="submit">Add Item</button>
                </div>
            </form>
        </div>
    </div>
@endsection
