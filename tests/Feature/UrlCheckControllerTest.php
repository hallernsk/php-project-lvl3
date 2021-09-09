<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;

class UrlCheckControllerTest extends TestCase
{
    private int $id;

    public function setUp(): void
    {
        parent::setUp();
        $this->id = DB::table('urls')->insertGetId(['name' => 'https://hexlet.io']);
    }

     /**
     * Test of checks store.
     *
     * @return void
     */
    public function testChecksStore()
    {
         $body = '<h1>test-h1</h1>
			<meta name="keywords" content="test-keywords">
			<meta name="description" content="test-description">';

        Http::fake([
            '*' => Http::response($body, 200),
        ]);

        $expected = [
            'url_id' => $this->id,
            'h1' => 'test-h1',
            'keywords' => 'test-keywords',
            'description' => 'test-description',
            'status_code' => 200
        ];

        $response = $this->post(route('urls.checks.store', $this->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expected);
    }
}
