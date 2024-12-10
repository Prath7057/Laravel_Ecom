<?php
include_once 'connection.php';
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//
$products = DB::table('products')->select('prod_collection', 'prod_name', 'prod_category', 'prod_id')->get();

foreach ($products as $product) {
    $prod_collection_slug = Str::slug($product->prod_collection);
    $prod_name_slug = Str::slug($product->prod_name);
    $prod_category_slug = Str::slug($product->prod_category);

    DB::table('products')
        ->where('prod_id', $product->prod_id)
        ->update([
            'prod_collection_slug' => $prod_collection_slug,
            'prod_name_slug' => $prod_name_slug,
            'prod_category_slug' => $prod_category_slug,
        ]);
}