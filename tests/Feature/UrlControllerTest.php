<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function testUrlsIndex()
    {
        DB::table('urls')->insert(
            [
                'name' =>  'http://google.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testUrlsShow()
    {
        $id = DB::table('urls')->insertGetId(['name' => 'http://hexlet.io']);
        $response = $this->get(route('urls.show', $id));
//        dd($response->headers);
        $response->assertSee('hexlet.io');
        $response->assertOk();
    }

    public function testUrlsStore()
    {
        $data = ['url' => ['name' => 'http://yandex.ru']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('urls', $data['url']);
    }
}
