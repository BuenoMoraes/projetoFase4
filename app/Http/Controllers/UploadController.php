<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index(Request $request) {
    
        return view('upload.index');
    }

    public function upload(Request $request) {

        $request->file('arquivo')->store('teste');
        
    }
}
