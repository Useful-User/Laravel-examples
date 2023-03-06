<?php

declare(strict_types=1);

namespace App\Services\Sources\Quote;

use App\Contracts\QuoteContract;
use App\Models\QuoteSource;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class FavqsQuote implements QuoteContract
{
    /**
     * All data about quote
     */
    private $data = [];

    /**
     * Make request
     */
    public function request(): void
    {
        $name = str_replace('Quote', '', class_basename($this::class));
        $url = QuoteSource::where('resource', $name)->firstOrFail()->url;

        try {
            $response = Http::retry(3, 100)->get($url);
            $response->throw();
        } catch (RequestException $exception) {
            abort(403, "Something went wrong while performing your request, please contact customer support");
        }

        $this->data = $response;
    }

    /**
     * Get Quote
     * 
     * @return string Quote as a string
     */
    public function get(): string
    {
        return $this->data['quote']['body'];
    }

    /**
     * Get Author
     * 
     * @return string Author as a string
     */
    public function author(): string
    {
        return $this->data['quote']['author'];
    }
}
