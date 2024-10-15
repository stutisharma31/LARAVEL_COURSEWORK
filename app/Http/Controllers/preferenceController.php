<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class preferenceController extends Controller
{
    public function setPreferences(){
    $theme=cookie('theme','dark',60*24*7);
    $language=cookie('language','English',60*24*7);
    return response('Preferences have beens set')
    ->cookie($theme)
    ->cookie($language);
    }
    public function getPreferences(Request $request)
    {
        $theme=$request->cookie('theme','default');
        $language=$request->cookie('language','default');
        return response("Your preferences are: Theme -$theme,Language");
    }
    public function updatePreferences()
    {
        $newtheme=cookie('theme','light',60*24*7);
        $newLanguage=cookie('language','Spanish',60*24*7);
        return response('Preferences have been updated')
        ->cookie($newtheme)
        ->cookie($newLanguage);
    }
    public function deletePreferences()
    {
        Cookie::queue(Cookie::forget('theme'));
        Cookie::queue(Cookie::forget('language'));
        return response('Prefernces have been deleted');
    }
}
