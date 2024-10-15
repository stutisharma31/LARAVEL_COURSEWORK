<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cookieController extends Controller
{
   public function setCookie()
   {
    $minutes=60;
    $cookie=cookie('user_cookie','John Doe',$minutes);
    return response('Cookie has been set!')->cookie($cookie);
   }
   public function getCookie(Request $request)
   {
    $value=$request->cookie('user_cookie');
    return response("The value of the cookie is:".$value);
   }
   public function deleteCookie()
   {
    Cookie::queue(Cookie::forget('user_cookie'));
    return response('Cookie has been deleted!');
   }
}
