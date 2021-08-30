<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')->paginate(15);
        $lastChecks = DB::table('url_checks')->orderBy('created_at')
            ->get()
            ->keyBy('url_id');
//        dd($lastChecks);
        return view('urls', ['urls' => $urls, 'lastChecks' => $lastChecks]);
    }

    public function show($id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);
        $checks = DB::table('url_checks')->where('url_id', $id)->latest()->get();
        return view('url', ['url' => $url, 'checks' => $checks]);
    }

    public function store(Request $request)
    {
// деаем валидацию вручную:
        $url = $request->input('url');
        $validator = Validator::make($url, [
            'name' => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')
                ->withErrors($validator)
                ->withInput();
        }

        $existsUrl = (bool)DB::table('urls')->where('name', $request->input('url.name'))->first();
        if (!$existsUrl) {
            DB::table('urls')->insert(
                [
                    'name' =>  $request->input('url.name'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            flash('Адрес добавлен в базу данных.');
        } else {
            flash('Такой адрес уже существует!');
        }
        return redirect()->route('urls.index');
    }
}
