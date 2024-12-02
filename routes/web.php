<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
//
Route::get('/admin', function () {
    return view('admin.addItem',['panelName' => 'admin']);
});
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
Route::post("/addInputTypeFile", [AjaxController::class, 'addInputTypeFile'])->name('addInputTypeFile');
Route::post("/admin/addInputTypeFile", [AjaxController::class, 'addInputTypeFile'])->name('addInputTypeFile');