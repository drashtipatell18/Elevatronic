<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileupload(){
        // $maintanances = Cliente::all();
        return view('fileupload.view_fileupload');
    }
    
}
