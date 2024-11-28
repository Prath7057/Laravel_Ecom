<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function addInputTypeFile (Request $request) {
        $inputTypeFileCount = $request->input('inputTypeFileCount');
        return view('admin.addInputTypeFile', ['inputTypeFileCount' => $inputTypeFileCount])->render();
    }
    //
    function deleteImage() {
        
    }
}
