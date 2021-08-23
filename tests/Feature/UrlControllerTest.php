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
        $response = $this->get(route('urls.index'));

        $response->assertOk();
    }

    public function testUrlsStore()
    {
        $data = ['name' => 'http://hexlet.io'];
        $response = $this->post(route('urls.store'), $data);
        $this->assertDatabaseHas('urls', $data);
    }

    public function testUrlsShow()
    {
        $id = DB::table('urls')->insertGetId(['name' => 'http://hexlet.io']);
        $response = $this->get(route('urls.show', $id));
        $response->assertOk();
    }
}
