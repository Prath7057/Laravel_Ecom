<?php

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
});