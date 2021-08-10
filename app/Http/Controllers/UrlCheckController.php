<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlCheck;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlCheckController extends Controller
{
    public function checksUrl($id)
    {
 //     dd($id);
        $url = DB::table('urls')->where('id', $id)->first();
//        dd($url);
        $response = Http::get($url->name);
//        dd($response);
        $status = $response->status();
//       dd($status);

        DB::table('url_checks')->insert(
            [
                'url_id' =>  $id,
                // 'h1' =>  ,    // //будем формировать на след. шаге (6)
                // 'keywords' =>  ,
                // 'descriptions' =>  ,
                'status_code' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        return redirect()->route('url', $id);
    }
}
