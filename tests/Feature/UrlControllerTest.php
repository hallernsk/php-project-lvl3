<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $data = ['name' => 'http://test.test'];
        $this->assertDatabaseMissing('urls', $data);
        $response = $this->post(route('store'), $data);
        $this->assertDatabaseHas('urls', $data);
    }

    public function testUrlLoading()
    {
        $id = DB::table('urls')->insertGetId(['name' => 'http://test.test']);
        $response = $this->get(route('url', $id));
        $response->assertOk();
    }

    public function testStoreCheck()
    {
        $id = DB::table('urls')->insertGetId(['name' => 'https://mail.ru']);
  //      dd($id);
        $body = '<h1>test-h1</h1>
			<meta name="keywords" content="test-keywords">
			<meta name="description" content="test-description">';

        Http::fake([
            '*' => Http::response($body, 200),
        ]);

        $expected = [
                      'url_id' => $id,
                      'h1' => 'test-h1',
                      'keywords' => 'test-keywords',
                      'description' => 'test-description',
                      'status_code' => 200
                   ];

        $response = $this->post(route('urlChecks', $id));

        $this->assertDatabaseHas('url_checks', $expected);
    }
}
