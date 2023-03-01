<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuoteRequestStatus;
use App\Models\QuoteSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuoteRequest>
 */
class QuoteRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'external_id'               => $this->faker->unique()->numberBetween(100, 999),
            'quote_request_status_id'   => QuoteRequestStatus::inRandomOrder()->first()->id,
            'quote_source_id'           => QuoteSource::inRandomOrder()->first()->id,
            'token'                     => $this->faker->unique()->regexify('[a-zA-Z0-9]{10}'),
        ];
    }
}
