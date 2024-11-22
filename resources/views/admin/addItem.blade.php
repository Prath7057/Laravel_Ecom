@extends('admin')

@section('adminContent')
    <div class="w-75 container">
        <div class="row justify-content-center mt-5">
            <form method="POST" action="" class="bg-light bg-gradient p-3">
                @csrf
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="itemName1" class="form-label">
                            Item Category<span style="color: red;"> *</span>
                        </label>
                        <input type="text" class="form-control" id="itemName1"
                            placeholder="Add Item Category Upto 16 Characters">
                    </div>
                    <div class="col-md-6">
                        <label for="itemName2" class="form-label">
                            Item Name<span style="color: red;"> *</span>
                        </label>
                        <input type="text" class="form-control" id="itemName2"
                            placeholder="Add Item name Upto 16 Characters">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        Item Description<span style="color: red;"> *</span>
                    </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                        placeholder="Add Item Description up to 64 Characters" oninput="updateWordCount()"></textarea>
                    <small id="wordCount" class="form-text text-muted">Word count: 0</small>
                </div>
                <label for="exampleFormControlTextarea1" class="form-label">
                    Item Collection
                    <span style="color: red;">*</span>
                </label>
                <div class="d-flex align-items-center">

                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Trending Product
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Top Selling
                        </label>
                    </div>
                </div>
                <div class="mb-3 mt-2">
                    <label for="customFile" class="form-label">Upload Image</label>
                    <div class="input-group align-items-center">
                        <span title="add more images (upto 4)" class="rounded-pill"
                            style="cursor:pointer;color:white; display: flex; align-items: center; justify-content: center;background:rgb(46, 135, 46);">
                            <i class="fa-solid fa-plus" style="font-size: 1.2rem;"></i>
                        </span>
                        <input type="file" class="ms-2 form-control" id="customFile" aria-label="Upload">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="itemName2" class="form-label">
                        Item Price<span style="color: red;"> *</span>
                    </label>
                    <input type="text" class="form-control" id="itemName2"
                        placeholder="Add Item Price">
                </div>
                <div class="mt-2 d-grid gap-2 d-md-flex justify-content-md-start">
                    <button class="btn btn-primary" type="submit">Button</button>
                </div>
            </form>
        </div>
    </div>
@endsection
