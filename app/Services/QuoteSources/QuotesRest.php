<?php

declare(strict_types=1);

namespace App\Services\QuoteSources;

use App\Contracts\QuoteSourceServiceContract;
use App\Models\QuoteRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class QuotesRest implements QuoteSourceServiceContract
{
    public function getQuote(QuoteRequest $quoteRequest): string
    {
        $url = $quoteRequest->quoteSource->url;

        try {
            $response = Http::retry(3, 100)->accept('application/json')->get($url);
            $response->throw();
        } catch (RequestException $exception) {
            abort(403, "Something went wrong while performing your request, please contact customer support");
        }

        return $response['contents']['quotes'][0]['quote'];
    }
}
