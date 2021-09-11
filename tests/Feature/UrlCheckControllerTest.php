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
        $this->id = DB::table('urls')->insertGetId(['name' => 'https://test.com']);
    }

     /**
     * Test of checks store.
     *
     * @return void
     */
    public function testChecksStore()
    {
        $htmlData = file_get_contents(__DIR__ . '/../fixtures/test.html');

        if ($htmlData === false) {
            throw new \Exception("Incorrect fixture(test.html)");
        }

        Http::fake([
            'https://test.com' => Http::response($htmlData, 200),
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
