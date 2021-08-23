<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlCheck;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DiDom\Document;

class UrlCheckController extends Controller
{
    public function store($id)
    {
 //     dd($id);
        $url = DB::table('urls')->where('id', $id)->first();
//      dd($url);
        $response = Http::get($url->name);
//        dd($response->body());

        $document = new Document($response->body());
        $h1 = optional($document->first('h1'))->text();
        $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
        $description = optional($document->first('meta[name=description]'))->getAttribute('content');
 //       dd($description);

        $status = $response->status();
//       dd($status);
        DB::table('url_checks')->insert(
            [
                'url_id' =>  $id,
                'h1' => $h1,
                'keywords' => $keywords,
                'description' => $description,
                'status_code' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        flash('Страница успешно проверена');

        return redirect()->route('urls.show', $id);
    }
}
