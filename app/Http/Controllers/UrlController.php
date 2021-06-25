<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function renderUrl(Request $request)
    {
        $url = $request['url'];
//        dd($request);
//        dd($request->input('url'));        
        return $url['name'];
//        dd($request);
    }    
}
