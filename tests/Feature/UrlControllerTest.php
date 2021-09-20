<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UrlControllerTest extends TestCase
{
    private int $id;

    public function setUp(): void
    {
        parent::setUp();
        $this->id = DB::table('urls')->insertGetId(
            [
                'name' =>  'http://google.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }

    /**
     * Test of urls index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    /**
     * Test of url show.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get(route('urls.show', $this->id));
        $response->assertSee('google.com');
        $response->assertOk();
    }

    /**
     * Test of urls store.
     *
     * @return void
     */
    public function testStore()
    {
        $data = ['url' => ['name' => 'http://yandex.ru']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('urls', $data['url']);
    }

    /**
     * Test of exist url store.
     *
     * @return void
     */
    public function testExistUrlStore()
    {
        $data = ['url' => ['name' => 'http://google.com']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertSee('google.com');
        $response->assertRedirect();
    }

    /**
     * Test of empty url store.
     *
     * @return void
     */
    public function testEmptyUrlStore()
    {
        $data = ['url' => ['name' => '']];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasErrors(['name' => 'The name field is required.']);
        $response->assertRedirect();
    }

    /**
     * Test of long url store.
     *
     * @return void
     */
    public function testLongUrlStore()
    {
        $faker = \Faker\Factory::create();
        $longUrlName = $faker->lexify('http://' . str_repeat('?', 250));
        $data = ['url' => ['name' => "{$longUrlName}"]];

        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasErrors(['name' => 'The name must not be greater than 255 characters.']);
        $response->assertRedirect();
    }
}
