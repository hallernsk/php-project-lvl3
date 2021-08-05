<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    public function insertUrl(Request $request)
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
        return redirect()->route('urls');
    }

    public function readUrl($id)
    {
        $url = DB::table('urls')->find($id);
//        $url_checks = DB::select('select * from url_checks where url_id = $id');
        $url_checks = DB::table('url_checks')->where('url_id', $id)->get();

        return view('url', ['url' => $url, 'checks' => $url_checks]);
    }

    public function readAll()
    {
//        $urls = DB::select('select * from urls');
        $urls = DB::table('urls')->get();

 //       $url_checks = DB::table('url_checks')->get();
 //       dd($url_checks);

        $lastCheck = DB::table('url_checks')->orderBy('created_at')
                                            ->get()
                                            ->keyBy('url_id');

//        dd($lastCheck);
        return view('urls', ['urls' => $urls, 'lastCheck' => $lastCheck]);
    }
}
