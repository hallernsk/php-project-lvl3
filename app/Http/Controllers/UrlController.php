<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    public function renderUrl(Request $request)
    {
        $url = $request['url'];
        return $url['name'];
    }

    public function insertUrl(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|url|max:255',
        ]);
        $existsUrl = DB::table('urls')->where('name', $request->name)->first() ? true : false;
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
        return view('url', ['url' => $url]);
    }

    public function readAll()
    {
//        $urls = DB::select('select * from urls');
        $urls = DB::table('urls')->get();
        return view('urls', ['urls' => $urls]);
    }
}
