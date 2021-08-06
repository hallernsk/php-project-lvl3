<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UrlControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testUrlsLoading()
    {
        $response = $this->get(route('urls'));

        $response->assertOk();
    }

    public function testStore()
    {
        $data = ['name' => 'http://test.www'];
        $this->assertDatabaseMissing('urls', $data);
        $response = $this->post(route('store'), $data);
        $this->assertDatabaseHas('urls', $data);
    }

    public function testUrlLoading()
    {
//        $id = DB::table('urls')->select('id')->get();
        $id = DB::table('urls')->insertGetId(['name' => 'http://test.www']);
        $response = $this->get(route('url', $id));
        $response->assertOk();
    }

    public function testStoreCheck()
    {
        $id = DB::table('urls')->insertGetId(['name' => 'http://test-check.www']);
  //      dd($id);
  //      $urls = DB::table('urls')->get();
  //      dd($urls);

        $data = ['keywords' => 'test', 'url_id' => $id];
        $this->assertDatabaseMissing('url_checks', $data);
        $response = $this->post(route('urlChecks', $id), $data);

 //       $url_checks = DB::table('url_checks')->get();
 //       dd($url_checks);
 //       dd($id);

        $this->assertDatabaseHas('url_checks', $data);
    }
}
