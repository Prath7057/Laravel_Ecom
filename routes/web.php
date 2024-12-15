<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
//
Route::get('/admin', function () {
    return view('admin.addItem',['panelName' => 'admin']);
});
//
Route::get('/signin', function () {
    return view('signin');
})->name('signin');
//
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
//
Route::prefix('admin')->group(function () {
    Route::get('/addItem', function () {
        return view('admin.addItem',['panelName' => 'admin']);
    })->name('addItem');
    //
    Route::get('/updateItem/{prod_id}', [ProductController::class, 'edit'])->name('updateItem');
    //
    Route::get('/itemList', [ProductController::class, 'create'])->name('itemList');
    //
    Route::post('/addItemData', [ProductController::class, 'store'])->name('addItemData');
    //
    Route::post('/updateItemData', [ProductController::class, 'update'])->name('updateItemData');
    //
    Route::post('/deleteItem', [ProductController::class, 'destroy'])->name('deleteItem');
});
//
//
Route::post("/addInputTypeFile", [AjaxController::class, 'addInputTypeFile'])->name('addInputTypeFile');
Route::post("/admin/addInputTypeFile", [AjaxController::class, 'addInputTypeFile'])->name('addInputTypeFile');
Route::post("/viewItem/{prod_category_slg}/{prod_name_slg}/{prod_code_slg}", [ProductController::class, 'viewItem'])->name('viewItem');
Route::get('/viewItems/{prod_collection_slg?}/{prod_category_slg?}/{prod_name_slg?}/{prod_code_slg?}', [ProductController::class, 'viewItems'])->name('viewItems');
Route::post('/signupdata',[UserController::class,'signupdata'])->name('signupdata');
Route::post('/signindata',[UserController::class,'signindata'])->name('signindata');
