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
        $urlChecks = DB::table('url_checks')->where('url_id', $id)->get();
//        dd($urlChecks);
        return view('url', ['url' => $url, 'checks' => $urlChecks]);
    }

    public function readAll()
    {
//        $urls = DB::select('select * from urls');
        $urls = DB::table('urls')->get();

 //       $urlChecks = DB::table('url_checks')->get();
 //       dd($urlChecks);

        $lastCheck = DB::table('url_checks')->orderBy('created_at')
                                            ->get()
                                            ->keyBy('url_id');

//        dd($lastCheck);
        return view('urls', ['urls' => $urls, 'lastCheck' => $lastCheck]);
    }
}
