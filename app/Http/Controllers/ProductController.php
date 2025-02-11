<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereIn('prod_collection', ['trending', 'top_selling', 'recommended', 'new_arrivals'])
            ->select('prod_id', 'prod_code', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'AllImages:image_prod_id,image_name',
            ])
            ->get()
            ->groupBy('prod_collection')
            ->map(function ($group) {
                return $group->take(4)->map(function ($product) {
                    $product->secure_prod_id = Crypt::encrypt($product->prod_id);
                    return $product;
                });
            });

        return view('index', [
            'panelName' => 'index',
            'trendingProducts' => $products->get('trending', collect()),
            'topSellingProducts' => $products->get('top_selling', collect()),
            'recommendedProducts' => $products->get('recommended', collect()),
            'newArrivalsProducts' => $products->get('new_arrivals', collect()),
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
            $product->secure_prod_id = Crypt::encrypt($product->prod_id);
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
        $validated['prod_category_slug'] = Str::slug($validated['prod_category']);
        $validated['prod_name_slug'] = Str::slug($validated['prod_name']);
        $validated['prod_collection_slug'] = Str::slug($validated['prod_collection']);
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
                'AllImages:image_prod_id,image_name,image_id',
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
        //
        $validated['prod_category_slug'] = Str::slug($validated['prod_category']);
        $validated['prod_name_slug'] = Str::slug($validated['prod_name']);
        $validated['prod_collection_slug'] = Str::slug($validated['prod_collection']);
        //
        $product->update($validated);

        for ($i = 1; $i <= 5; $i++) {
            if (($request->input('prod_image' . $i) == $request->input('old_image_name' . $i)) && ($request->input('image_id' . $i) != '')) {
                continue;
            } else if (($request->input('prod_image' . $i) != $request->input('old_image_name' . $i)) && ($request->input('image_id' . $i) != '')) {
                $images = image::where('image_id', $request->input('image_id' . $i));
                if ($images) {
                    $imagePath = 'images/prod_image/' . $request->input('old_image_name' . $i);
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                    $images->delete();
                }
            }
            //
            $imageField = 'prod_image' . $i;
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
    public function destroy(Request $request)
    {
        $secureProdId = $request->input('secure_prod_id');
        $decryptedProdId = Crypt::decrypt($secureProdId);
        //
        $product = Product::find($decryptedProdId);
        $product->delete();
        //
        return redirect()->route('itemList')
            ->with('success', 'Product Deleted successfully.');
    }
    //
    public function viewItem(Request $request)
    {
        $secureProdId = $request->input('secure_prod_id');
        $decryptedProdId = Crypt::decrypt($secureProdId);
        //
        $product = Product::where('prod_id', $decryptedProdId)
            ->select('prod_id', 'prod_code', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection')
            ->with([
                'AllImages:image_prod_id,image_name,image_id',
            ])
            ->first();
        //
        // dd($product);
        //
        return view('components.viewItem', [
            'product' => $product,
        ]);
    }
    //
    public function viewItems($prod_collection_slg = null, $prod_category_slg = null, $prod_name_slg = null, $prod_code_slg = null)
    {
        //
        $query = Product::with(['firstImage:image_prod_id,image_name'])
            ->select('prod_id', 'prod_code', 'prod_name', 'prod_category', 'prod_desc', 'prod_amount', 'prod_collection');

        $categories = $names = $collections = '';
        if ($prod_collection_slg && $prod_collection_slg != 'all-collections') {
            $query->where('prod_collection_slug', $prod_collection_slg);
            $collections = ucfirst($prod_collection_slg);
        }

        if ($prod_category_slg && $prod_category_slg != 'all-categories') {
            $query->where('prod_category_slug', $prod_category_slg);
            $categories = ucfirst($prod_category_slg);
        }

        if ($prod_name_slg && $prod_name_slg != 'all-names') {
            $query->where('prod_name_slug', $prod_name_slg);
            $names = ucfirst($prod_name_slg);
        }
        //
        $product = $query->get();
        //
        // $sql = $query->toSql();
        // $bindings = $query->getBindings();
        // $fullSql = Str::replaceArray('?', array_map(fn($value) => "'$value'", $bindings), $sql);
        //
        foreach ($product as $item) {
            $item->secure_prod_id = Crypt::encrypt($item->prod_id);
        }
        //
        return view('components.viewItems', [
            'product' => $product,
            'collections' => $collections,
            'categories' => $categories,
            'names' => $names,
        ]);
    }

}
