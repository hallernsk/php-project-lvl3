<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
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

    public function testUrlLoading()
    {
        $response = $this->get('urls/1');

        $response->assertOk();
    }
}
