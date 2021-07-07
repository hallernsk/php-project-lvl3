<?php

namespace Tests\Feature;

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

}
