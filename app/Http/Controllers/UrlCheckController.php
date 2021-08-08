<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlCheck;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlCheckController extends Controller
{
    public function checksUrl(Request $request)
    {
//        dd($request);

        $id = $request->input('url_id');
        $url = DB::table('urls')->where('id', $id)->first();
 //       dd($url);
        $urlName = $url->name;
//        dd($url_name);

        $response = Http::get($urlName);
//        $response = Http::get('https://mail.ru');

        $status = $response->status();
//        dd($status);

        DB::table('url_checks')->insert(
            [
                'url_id' =>  $request->input('url_id'),

                'keywords' =>  $request->input('keywords'),

                'status_code' => $status,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
//        $checks = DB::table('url_checks')->get();
//        dd($checks);

        return redirect()->route('url', $id);
    }
}
