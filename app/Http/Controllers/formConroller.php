<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formConroller extends Controller
{
    public function showForm()
    {
        return view('user-form');
    }
    public function submitForm(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email',
        ]);
        return redirect()->back()->with('success','Form submitted successfully');
        
    }
}
