<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a a home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        $url = $request->old('url');
        return view('home', ['url' => $url]);
    }
}
