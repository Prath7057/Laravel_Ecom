<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index',['panelName' => 'index']);
});
Route::get('/admin', function () {
    return view('admin',['panelName' => 'admin']);
});
Route::prefix('admin')->group(function () {
    Route::get('/addItem', function () {
        return view('admin.addItem',['panelName' => 'admin']);
    })->name('addItem');
    //
    Route::post('/addItemData', [ProductController::class, 'store'])->name('addItemData');
});
Route::post('/addInputTypeFile', [AjaxController::class, 'addInputTypeFile'])->name('addInputTypeFile');