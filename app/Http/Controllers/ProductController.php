<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

    }
    //
    public function create()
    {
        //
    }
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prod_category' => 'required|max:16',
            'prod_name' => 'required|max:16',
            'prod_desc' => 'required',
            'prod_collection' => 'required',
            'prod_amount' => 'required|numeric',
        ]);
        //
        $product = product::create($validated);
        $prod_id = $product->prod_id;
        //
        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'prod_image' . $i;
            if ($request->hasFile($imageField)) {
                $image = $request->file($imageField);
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/prod_image'), $imageName);
                $imageData = base64_encode(file_get_contents(public_path('images/prod_image') . '/' . $imageName));
                //
                image::create([
                    'image_name' => $imageName,  
                    'image_prod_id' => $prod_id, 
                    'image_data' => $imageData,
                ]);
            }
        }
        //
        return redirect()->route('addItem')->with('success', 'Product added successfully.');
    }
    //
    public function show(string $id)
    {
        //
    }
    //
    public function edit(string $id)
    {
        //
    }
    //
    public function update(Request $request, string $id)
    {
        //
    }
    //
    public function destroy(string $id)
    {
        //
    }
}
