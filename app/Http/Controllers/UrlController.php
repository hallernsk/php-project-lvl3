<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $urls = DB::table('urls')->paginate(15);
        $lastChecks = DB::table('url_checks')
            ->orderBy('url_id')
            ->latest()
            ->distinct('url_id')
            ->get()
            ->keyBy('url_id');

        return view('urls.index', ['urls' => $urls, 'lastChecks' => $lastChecks]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);
        $checks = DB::table('url_checks')->where('url_id', $id)->latest()->get()->all();
        return view('urls.show', ['url' => $url, 'checks' => $checks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $inputUrl = $request->input('url');
        $validator = Validator::make($inputUrl, [
            'name' => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')
                ->withErrors($validator)
                ->withInput();
        }

        $parsedUrl = parse_url($inputUrl['name']);
        $normalizedUrl = strtolower("{$parsedUrl['scheme']}://{$parsedUrl['host']}");
        $url = DB::table('urls')->where('name', $normalizedUrl)->first();
        if (is_null($url)) {
            $id = DB::table('urls')->insertGetId(
                [
                    'name' =>  $normalizedUrl,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            flash(__('flash.page_added'));
        } else {
            $id = $url->id;
            flash(__('flash.page_exists'));
        }
        return redirect()->route('urls.show', $id);
    }
}
