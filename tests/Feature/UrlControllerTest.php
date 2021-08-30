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
     * Test of urls index.
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

    /**
     * Test of url show.
     *
     * @return void
     */
    public function testUrlsShow()
    {
        $id = DB::table('urls')->insertGetId(['name' => 'http://hexlet.io']);
        $response = $this->get(route('urls.show', $id));
//        dd($response->headers);
        $response->assertSee('hexlet.io');
        $response->assertOk();
    }

    /**
     * Test of urls store.
     *
     * @return void
     */
    public function testUrlsStore()
    {
        $data = ['url' => ['name' => 'http://yandex.ru']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('urls', $data['url']);
    }
}
