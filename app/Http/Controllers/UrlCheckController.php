<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlCheck;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlCheckController extends Controller
{
    public function checksUrl(Request $request)
    {
//        dd($request);
        DB::table('url_checks')->insert(
            [
                'url_id' =>  $request->input('url_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
//        $checks = DB::table('url_checks')->get();
//        dd($checks);
        $id = $request->input('url_id');
        return redirect()->route('url', $id);
    }
}
