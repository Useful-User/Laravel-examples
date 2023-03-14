<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\QuoteRequest;
use App\Models\QuoteRequestStatus;
use App\Models\QuoteSource;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class ApiRoutesTest extends TestCase
{
    /**
     * Test user endpoint.
     */
    public function test_user_endpoint(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('user'));

        $response->assertStatus(200);
    }

    /**
     * Test quoterequest list endpoint.
     */
    public function test_quoterequest_list_endpoint(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post(route('quoterequest.list'));

        $response->assertStatus(200);
    }

    /**
     * Test quoterequest list endpoint with full dataset.
     */
    public function test_quoterequest_list_endpoint_with_full_dataset(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->post(
                route('quoterequest.list'),
                [
                    'from' => Carbon::now(),
                    'to' => Carbon::now()->subDays(1),
                    'id' => QuoteRequest::find(1)->id,
                    'quote_sources' => QuoteSource::all()
                        ->pluck('id')->toArray(),
                    'external_id' => QuoteRequest::find(1)->external_id,
                    'statuses' => QuoteRequestStatus::all()
                        ->pluck('name')->toArray(),
                    'per_page' => 1,
                    'sort' => [
                        'by' => 'id',
                        'direction' => 'desc',
                    ],
                ]
            );

        $response->assertStatus(200);
    }

    /**
     * Test quoterequest statuses list endpoint.
     */
    public function test_statuses_endpoint(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->get(route('quoterequest.statuses.index'));

        $response->assertStatus(200);
    }

    /**
     * Test quotesource endpoint.
     */
    public function test_quotesource_endpoint(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get(route('quotesource.index'));

        $response->assertStatus(200);
    }
}
