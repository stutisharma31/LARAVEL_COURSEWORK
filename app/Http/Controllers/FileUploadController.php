<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    // Method to display the file upload form
    public function showForm() {
        return view('upload'); // This assumes you have a 'upload.blade.php' file in 'resources/views/'
    }

    // Method to handle the file upload
    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $file = $request->file('file');
        $filepath = $file->store('uploads');
        return response('Done');
    }
}




