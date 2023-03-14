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
     * Quote.
     */
    private $quote = 'No Quote';

    /**
     * Author.
     */
    private $author = 'No Author';

    /**
     * Make request.
     */
    public function request(): void
    {
        // Remove last 'Quote' from class name
        $name = preg_replace('/(Quote(?!.*Quote))/', '', class_basename($this::class));
        $url = QuoteSource::where('resource', $name)->firstOrFail()->url;

        try {
            $response = Http::retry(3, 100)->get($url);
            $response->throw();
        } catch (RequestException $exception) {
            abort(403, "Something went wrong while performing your request, please contact customer support");
        }

        $this->quote = $response['quote']['body'];
        $this->author = $response['quote']['author'];
    }

    /**
     * Get quote.
     */
    public function get(): string
    {
        return $this->quote;
    }

    /**
     * Get author.
     */
    public function author(): string
    {
        return $this->author;
    }
}
