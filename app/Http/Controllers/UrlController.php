<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|url|max:255',
        ]);
        $existsUrl = (bool)DB::table('urls')->where('name', $request->name)->first();
        if (!$existsUrl) {
            DB::table('urls')->insert(
                [
                    'name' =>  $request->input('name'),
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

    public function index()
    {
        $urls = DB::table('urls')->paginate(15);
        $lastCheck = DB::table('url_checks')->orderBy('created_at')
            ->get()
            ->keyBy('url_id');

        return view('urls', ['urls' => $urls, 'lastCheck' => $lastCheck]);
    }

    public function show($id)
    {
        $url = DB::table('urls')->find($id);
        $urlChecks = DB::table('url_checks')->where('url_id', $id)->orderBy('created_at', 'desc')->get();
        return view('url', ['url' => $url, 'checks' => $urlChecks]);
    }
}
