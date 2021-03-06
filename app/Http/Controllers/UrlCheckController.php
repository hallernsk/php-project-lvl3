<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DiDom\Document;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);
        try {
            $response = Http::get($url->name);

            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');
            $status = $response->status();

            DB::table('url_checks')->insert(
                [
                    'url_id' => $id,
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'status_code' => $status,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            flash(__('flash.page_verified'));
        } catch (RequestException | ConnectionException $e) {
            flash($e->getMessage())->error();
        }
        return redirect()->route('urls.show', $id);
    }
}
