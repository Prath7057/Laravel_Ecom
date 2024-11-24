4^<span id="deleteButton{{$inputTypeFileCount}}" title="add more images (upto 4)" class="rounded-pill deleteInputTypeFile"
style="cursor:pointer;color:white; display: flex; align-items: center; justify-content: center;background:rgb(255, 0, 0);"
onclick="deleteInputTypeFile('{{ $inputTypeFileCount }}');">
<i class="fa-solid fa-minus" style="font-size: 1.2rem;"></i>
</span>
<input type="file" class="ms-2 form-control" id="image{{ $inputTypeFileCount }}"
    name="imageimage{{ $inputTypeFileCount }}" aria-label="Upload" accept="image/*">
<div id="inputTypeFileDiv{{$inputTypeFileCount}}" class="input-group align-items-center mt-1">
</div>