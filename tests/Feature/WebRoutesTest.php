<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\QuoteSource;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class WebRoutesTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Static data for using between tests
     */
    protected static $data;

    /**
     * Test home page.
     */
    public function test_home_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test quoterequest page.
     */
    public function test_quoterequest_page_ok()
    {
        $external_id = (string)rand(1000, 9999);
        $data = [
            'external_id' => $external_id,
        ];
        $response = $this->post(route('quoterequest.store'), $data);

        static::$data =  [
            'url' => $response->headers->get('Location'),
            'session' => $response->getSession()->all(),
            'hash' => Str::after($response->headers->get('Location'), '#'),
        ];

        $response->assertStatus(302);
        $response->assertRedirectToRoute('frontpage');
        $response->assertRedirectContains('#');
        $response->assertSessionHas('s');
    }

    /**
     * Test quoterequest page without data.
     */
    public function test_quoterequest_page_not_ok()
    {
        $response = $this->post(route('quoterequest.store'));

        $response->assertStatus(403);
        $response->assertSessionMissing('s');
    }

    /**
     * Test main page with current session.
     * 
     * @depends test_quoterequest_page_ok
     */
    public function test_main_page_with_session(): void
    {
        $response = $this->withSession(static::$data['session'])
            ->get(static::$data['url']);

        $response->assertStatus(200);
        $response->assertSessionHas('s');
    }

    /**
     * Test list of sources available to the user.
     * 
     * @depends test_main_page_with_session
     */
    public function test_quotesources_with_session(): void
    {
        $response = $this->withSession(static::$data['session'])
            ->get(route('quotesources.show', ['id' => static::$data['hash']]));
        $response->assertStatus(200);
        $response->assertSessionHas('s');
    }

    /**
     * Test list of sources not available to the user without session.
     * 
     * @depends test_main_page_with_session
     */
    public function test_quotesources_without_session(): void
    {
        $response = $this->get(
            route(
                'quotesources.show',
                ['id' => static::$data['hash']]
            )
        );
        $response->assertStatus(400);
        $response->assertSessionMissing('s');
    }

    /**
     * Test current request data available to the user.
     * 
     * @depends test_main_page_with_session
     */
    public function test_quoterequest_with_session(): void
    {
        $response = $this->withSession(static::$data['session'])
            ->get(route('quoterequest.show', ['id' => static::$data['hash']]));
        $response->assertStatus(200);
        $response->assertSessionHas('s');
    }

    /**
     * Test current request data not available to the user without session.
     * 
     * @depends test_main_page_with_session
     */
    public function test_quoterequest_without_session(): void
    {
        $response = $this->get(
            route(
                'quoterequest.show',
                ['id' => static::$data['hash']]
            )
        );
        $response->assertStatus(400);
        $response->assertSessionMissing('s');
    }

    /**
     * Test saving the quote source by the user.
     * 
     * @depends test_main_page_with_session
     */
    public function test_add_source_to_quoterequest_with_session(): void
    {
        $sources = QuoteSource::all();
        foreach ($sources as $source) {
            $sourceName = 'App\Services\Sources\Quote\\' . $source->resource . 'Quote';

            $this->instance(
                $sourceName,
                $this->partialMock($sourceName, function (MockInterface $mock) {
                    $mock->shouldReceive('request');
                })
            );

            $response = $this->withSession(static::$data['session'])
                ->put(
                    route('quoterequest.show', ['id' => static::$data['hash']]),
                    ['quote_source_id' => $source->id]
                );
            $response->assertStatus(200);
            $response->assertSessionHas('s');
        }
    }

    /**
     * Test saving the quote source by the user without session.
     * 
     * @depends test_main_page_with_session
     */
    public function test_add_source_to_quoterequest_without_session(): void
    {
        $response = $this->put(
            route('quoterequest.show', ['id' => static::$data['hash']]),
            ['quote_source_id' => 1]
        );
        $response->assertStatus(400);
        $response->assertSessionMissing('s');
    }

    /**
     * Test version.
     */
    public function test_version(): void
    {
        $response = $this->get(route('version'));
        $response->assertStatus(200);
        $response->assertSessionMissing('s');
    }
}
