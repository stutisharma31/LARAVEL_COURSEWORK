<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
   
    public function showForm() {
        return view('upload');
    }
  
    public function upload(Request $request) {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email',
            'file' => 'required|file|mimes:jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        $filepath = $file->store('uploads');
        return response('Done');
    }
}




