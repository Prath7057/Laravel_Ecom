@extends('admin')

@push('styles')
    <style>
        .border-red {
            border: 1px solid red;
        }

        .validation-msg {
            font-size: 0.9rem;
            position: absolute;
            bottom: -50%;
            right: 0%;
        }
    </style>
@endpush

@section('adminContent')
    @php
        $product = $product ?? [];
    @endphp
    {{-- {{print_r(session()->all());}} --}}
    <div class="container">
        @if ($product)
            <a class="btn btn-success mt-5 mb-1" href="{{ route('itemList') }}">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>
            <div class="row justify-content-center">
            @else
                <div class="row justify-content-center mt-5">
        @endif
        @if ($product)
            <form method="POST" action="{{ route('updateItemData') }}" class="bg-light bg-gradient p-3"
                enctype="multipart/form-data">
            @else
                <form method="POST" action="{{ route('addItemData') }}" class="bg-light bg-gradient p-3"
                    enctype="multipart/form-data">
        @endif
        @csrf
        <div class="mb-3 row">
            <input type="hidden" id="secure_prod_id" name="secure_prod_id" value="{{ $product->secure_prod_id ?? '' }}" />
            <div class="col-md-6">
                <label for="prod_code" class="form-label">
                    Item Code<span style="color: red;"> *</span>
                </label>
                <div style="position: relative;">
                    <input type="text" class="form-control {{ $errors->has('prod_code') ? '' : '' }}"
                        value="{{ old('prod_code', $product->prod_code ?? '') }}" id="prod_code" name="prod_code"
                        placeholder="Item Code"
                        onkeydown="if (event.keyCode == 13) {
                                         inputOnfocus('prod_amount');                                        
                                         return false;
                                 } else if (event.keyCode == 8 && this.value == '') {
                                         inputOnfocus(''); 
                                         return false;
                                 }">
                    @if ($errors->has('prod_code'))
                        <span class="error-message text-danger validation-msg">
                            {{ $errors->first('prod_code') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <label for="prod_amount" class="form-label">
                    Item Price<span style="color: red;"> *</span>
                </label>
                <div style="position: relative;">
                    <input type="text" class="form-control {{ $errors->has('prod_amount') ? '' : '' }}"
                        value="{{ old('prod_amount', $product->prod_amount ?? '') }}" id="prod_amount" name="prod_amount"
                        placeholder="Add Item Price"
                        onkeydown="if (event.keyCode == 13) {
                            inputOnfocus('prod_category');                                        
                            return false;
                    } else if (event.keyCode == 8 && this.value == '') {
                            inputOnfocus('prod_code'); 
                            return false;
                    }">
                    @if ($errors->has('prod_amount'))
                        <span class="error-message text-danger validation-msg">{{ $errors->first('prod_amount') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="itemName1" class="form-label">
                    Item Category<span style="color: red;"> *</span>
                </label>
                <div style="position: relative;">
                    <input type="text" class="form-control {{ $errors->has('prod_category') ? '' : '' }}"
                        value="{{ old('prod_category', $product->prod_category ?? '') }}" id="prod_category"
                        name="prod_category" placeholder="Add Item Category Upto 16 Characters"
                        onkeydown="if (event.keyCode == 13) {
                            inputOnfocus('prod_name');                                        
                            return false;
                    } else if (event.keyCode == 8 && this.value == '') {
                            inputOnfocus('prod_amount'); 
                            return false;
                    }">
                    @if ($errors->has('prod_category'))
                        <span class="error-message text-danger validation-msg">{{ $errors->first('prod_category') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <label for="itemName2" class="form-label">
                    Item Name<span style="color: red;"> *</span>
                </label>
                <div style="position: relative;">
                    <input type="text" class="form-control {{ $errors->has('prod_name') ? '' : '' }}" id="prod_name"
                        name="prod_name" value="{{ old('prod_name', $product->prod_name ?? '') }}"
                        placeholder="Add Item name Upto 16 Characters"
                        onkeydown="if (event.keyCode == 13) {
                            inputOnfocus('prod_desc');                                        
                            return false;
                    } else if (event.keyCode == 8 && this.value == '') {
                            inputOnfocus('prod_category'); 
                            return false;
                    }">

                    @if ($errors->has('prod_name'))
                        <span class="error-message text-danger validation-msg">{{ $errors->first('prod_name') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">
                Item Description<span style="color: red;"> *</span>
            </label>
            <textarea class="form-control {{ $errors->has('prod_desc') ? 'border-red' : '' }}" id="prod_desc" name="prod_desc"
                rows="3" placeholder="Add Item Description up to 64 Characters" oninput="updateWordCount()"
                onkeydown="if (event.keyCode == 13) {
                            inputOnfocus('prod_collection1'); 
                            return false;
                    } else if (event.keyCode == 8 && this.value == '') {
                            inputOnfocus('prod_name'); 
                            return false;
                    }">{{ old('prod_desc', $product->prod_desc ?? '') }}</textarea>

            <small id="wordCount" class="form-text text-muted">
                Word count: 0
            </small>
        </div>
        <div>
            <div style="position: relative;">
                <label for="exampleFormControlTextarea1" class="form-label">
                    Item Collection
                    <span style="color: red;">*</span>
                </label>
            </div>
            @if (isset($product->prod_id))
                <div class="d-flex align-items-center">
                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio"
                            name="prod_collection" id="prod_collection4" value="new_arrivals"
                            {{ $product->prod_collection ? ($product->prod_collection == 'new_arrivals' ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="prod_collection4">
                            New Arrivals
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio"
                            name="prod_collection" id="prod_collection1" value="trending"
                            {{ $product->prod_collection ? ($product->prod_collection == 'trending' ? 'checked' : '') : '' }}
                            onkeydown="if (event.keyCode == 13) {
                                inputOnfocus('prod_image1'); 
                                return false;
                        } else if (event.keyCode == 8 && this.value == '') {
                                inputOnfocus('prod_desc'); 
                                return false;
                        }">
                        <label class="form-check-label" for="prod_collection1">
                            Trending
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio"
                            name="prod_collection" id="prod_collection2" value="top_selling"
                            {{ $product->prod_collection == 'top_selling' ? 'checked' : '' }}>
                        <label class="form-check-label" for="prod_collection2">
                            Best Seller
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" style="border: 1.5px solid rgb(26, 26, 26)" type="radio"
                            name="prod_collection" id="prod_collection3" value="recommended"
                            {{ $product->prod_collection == 'recommended' ? 'checked' : '' }}>
                        <label class="form-check-label" for="prod_collection3">
                            Recommanded
                        </label>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center">
                    <div class="form-check me-3">
                        <input class="form-check-input"
                            style="{{ $errors->has('prod_collection') ? 'border: 1.5px solid red' : 'border: 1.5px solid rgb(26, 26, 26)' }}"
                            type="radio" name="prod_collection" id="prod_collection4" value="new_arrivals">
                        <label class="form-check-label" for="prod_collection4">
                            New Arrivals
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input"
                            style="{{ $errors->has('prod_collection') ? 'border: 1.5px solid red' : 'border: 1.5px solid rgb(26, 26, 26)' }}"
                            type="radio" name="prod_collection" id="prod_collection1" value="trending"
                            onkeydown="if (event.keyCode == 13) {
                                inputOnfocus('prod_image1'); 
                                return false;
                        } else if (event.keyCode == 8 && this.value == '') {
                                inputOnfocus('prod_desc'); 
                                return false;
                        }">
                        <label class="form-check-label" for="prod_collection1">
                            Trending
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input"
                            style="{{ $errors->has('prod_collection') ? 'border: 1.5px solid red' : 'border: 1.5px solid rgb(26, 26, 26)' }}"
                            type="radio" name="prod_collection" id="prod_collection2" value="top_selling">
                        <label class="form-check-label" for="prod_collection2">
                            Best Seller
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input"
                            style="{{ $errors->has('prod_collection') ? 'border: 1.5px solid red' : 'border: 1.5px solid rgb(26, 26, 26)' }}"
                            type="radio" name="prod_collection" id="prod_collection3" value="recommended">
                        <label class="form-check-label" for="prod_collection3">
                            Recommanded
                        </label>
                    </div>
                </div>
            @endif
        </div>
        @php $inputTypeFileCount = 1;@endphp
        <div class="mb-3 mt-2">
            <label for="customFile" class="form-label">Upload Image</label>
            <div class="input-group align-items-center mt-1">
                <span id="addMoreButton" title="add more images (upto 4)" class="rounded-pill"
                    style="cursor:pointer;color:white; display: flex; align-items: center; justify-content: center;background:rgb(46, 135, 46);"
                    onclick="addInputTypeFile(document.getElementById('inputTypeFileCount').value);">
                    <i class="fa-solid fa-plus" style="font-size: 1.2rem;"></i>
                </span>
                <input type="file" class="ms-2 form-control" id="prod_image{{ $inputTypeFileCount }}"
                    name="prod_image{{ $inputTypeFileCount }}" aria-label="Upload" accept="image/*">
            </div>
            @if (isset($product->AllImages))
                @php $length = count($product->AllImages);@endphp
                <div class="" style="position: relative;">
                    @foreach ($product->AllImages as $images)
                        {{-- this is comment --}}
                        <input type="hidden" type="text" readonly class="ms-2 form-control"
                            id="image_id{{ $inputTypeFileCount + 1 }}" name="image_id{{ $inputTypeFileCount + 1 }}"
                            value="{{ $images->image_id }}" />
                        <input type="hidden" type="text" readonly class="ms-2 form-control"
                            id="old_image_name{{ $inputTypeFileCount + 1 }}"
                            name="old_image_name{{ $inputTypeFileCount + 1 }}" value="{{ $images->image_name }}" />
                        {{-- this is comment --}}
                        <div id="inputTypeFileDiv{{ $inputTypeFileCount }}" class="input-group align-items-center mt-1">
                            @php $inputTypeFileCount += 1;@endphp
                            <span id="deleteButton{{ $inputTypeFileCount }}" title="Delete Image"
                                class="rounded-pill deleteInputTypeFile"
                                style="cursor:pointer;color:white; display: flex; align-items: center; justify-content: center;background:rgb(255, 0, 0); @if ($length != $inputTypeFileCount - 1) visibility: hidden; @endif"
                                onclick="deleteInputTypeFile('{{ $inputTypeFileCount }}');">
                                <i class="fa-solid fa-minus" style="font-size: 1.2rem;"></i>
                            </span>
                            <img class="ms-2 " src="{{ asset('images/prod_image/' . $images->image_name) }}"
                                alt="image" style="width:75px;height:50px;object-fit: contain;"
                                onclick="previewImage('{{ asset('images/prod_image/' . $images->image_name) }}');" />
                            <input type="text" readonly class="ms-2 form-control"
                                id="prod_image{{ $inputTypeFileCount }}" name="prod_image{{ $inputTypeFileCount }}"
                                value="{{ $images->image_name }}" aria-label="Upload" accept="image/*" />
                        </div>
                    @endforeach
                    <div id="imagePreviewDiv"
                        style="position: absolute; width:200px; height:200px; border:1px solid black; bottom:-45%; left:8%; background:white; display:none;"
                        onclick="previewImage('');">
                        <img id="imagePreview" src="" alt="Preview"
                            style="width:100%; height:100%; object-fit:contain;">
                        <input type="hidden" id="isImageOpen" name="isImageOpen" value="0" />
                    </div>
                </div>
            @endif
            <input type="hidden" id="inputTypeFileCount" name="inputTypeFileCount"
                value="{{ $inputTypeFileCount }}" />
            <div id="inputTypeFileDiv{{ $inputTypeFileCount }}" class="input-group align-items-center mt-1">
            </div>
        </div>
        <div class="mt-2 d-grid gap-2 d-md-flex justify-content-md-start">
            @if ($product)
                <button class="btn btn-info" type="submit">Update</button>
            @else
                <button class="btn btn-primary" type="submit">Add Item</button>
            @endif
        </div>
        </form>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('click', function(event) {
            if (document.getElementById('imagePreviewDiv') != null) {
                const previewDiv = document.getElementById('imagePreviewDiv');
                if (!previewDiv.contains(event.target) && event.target.tagName !== 'IMG') {
                    document.getElementById('isImageOpen').value = '0';
                    previewDiv.style.display = 'none';
                }
            }
        });
    </script>
@endpush()
