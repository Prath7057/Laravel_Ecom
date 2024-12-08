<form method="POST" style="cursor: pointer;" class="product-details"
action="{{ route('viewItem', [
    'prod_category_slg' => Str::slug($item->prod_category),
    'prod_name_slg' => Str::slug($item->prod_name),
    'prod_code_slg' => Str::slug($item->prod_code),
]) }}"
onclick="submit(this);">
@csrf
<input type="hidden" id="secure_prod_id" name="secure_prod_id"
    value="{{ $item->secure_prod_id }}" />
<input type="hidden" id="prod_category" name="prod_category"
    value="{{ $item->prod_category }}" />
<input type="hidden" id="prod_name" name="prod_name"
    value="{{ $item->prod_name }}" />