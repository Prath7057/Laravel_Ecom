<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    public function index()
    {
        $trendingProducts = Product::where('prod_collection', 'trending')
            ->select('prod_id', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'firstImage:image_prod_id,image_name',
            ])
            ->get();

        $topSellingProducts = Product::where('prod_collection', 'top_selling')
            ->select('prod_id', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'firstImage:image_prod_id,image_name',
            ])
            ->get();

        $recommendedProducts = Product::where('prod_collection', 'recommended')
            ->select('prod_id', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'firstImage:image_prod_id,image_name',
            ])
            ->get();

        return view('index', [
            'panelName' => 'index',
            'trendingProducts' => $trendingProducts,
            'topSellingProducts' => $topSellingProducts,
            'recommendedProducts' => $recommendedProducts,
        ]);
    }
    //
    public function create()
    {
        $trendingProducts = Product::select('prod_id', 'prod_code', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'firstImage:image_prod_id,image_name',
            ])
            ->orderBy('prod_id', 'desc')
            ->get();
        //
        $encryptedProducts = $trendingProducts->map(function ($product) {
            $product->encrypted_prod_id = Crypt::encrypt($product->prod_id);
            return $product;
        });
        //
        return view('admin.itemList', [
            'panelName' => 'admin',
            'items' => $encryptedProducts,
        ]);
    }
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prod_category' => 'required|max:32',
            'prod_code' => 'required|max:8',
            'prod_name' => 'required|max:32',
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
                $imageSize = filesize(public_path('images/prod_image') . '/' . $imageName);
                $maxSize = 3 * 1024 * 1024;
                //
                if ($imageSize > $maxSize) {
                    $imageData = null;
                }
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
        $product = Product::where('prod_id', $id)
            ->select('prod_id', 'prod_code', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'AllImages:image_prod_id,image_name',
            ])
            ->first();
        //
        if ($product) {
            $product->secure_prod_id = Crypt::encrypt($product->prod_id);
        }
        //
        return view('admin.addItem', [
            'panelName' => 'admin',
            'product' => $product,
        ]);
    }
    //
    public function update(Request $request)
    {
        $validated = $request->validate([
            'prod_category' => 'required|max:32',
            'prod_code' => 'required|max:8',
            'prod_name' => 'required|max:32',
            'prod_desc' => 'required',
            'prod_collection' => 'required',
            'prod_amount' => 'required|numeric',
        ]);
        $secureProdId = $request->input('secure_prod_id');
        $decryptedProdId = Crypt::decrypt($secureProdId);
        //
        $product = Product::find($decryptedProdId);

        if (!$product) {
            return redirect()->back()->withErrors(['error' => 'Invalid Product ID.']);
        }

        $product->update($validated);

        for ($i = 1; $i <= 4; $i++) {
            if (($request->input('prod_image' . $i) == $request->input('old_image_name' . $i)) && ($request->input('image_prod_id' . $i) != '')) {
                continue;
            } else if(1) {

            }
            //
            $imageField = 'prod_iamge'.$i;
            if ($request->hasFile($imageField)) { 
                $image = $request->file($imageField);
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/prod_image'), $imageName);

                $imageData = base64_encode(file_get_contents(public_path('images/prod_image/' . $imageName)));
                $imageSize = filesize(public_path('images/prod_image/' . $imageName));
                $maxSize = 3 * 1024 * 1024;

                if ($imageSize > $maxSize) {
                    $imageData = null;
                }

                Image::create([
                    'image_name' => $imageName,
                    'image_prod_id' => $decryptedProdId,
                    'image_data' => $imageData,
                ]);
            }
        }
        //
        return redirect()->route('updateItem', ['prod_id' => $product->prod_id])
            ->with('success', 'Product updated successfully.');
    }

    //
    public function destroy(string $id)
    {

    }
}
