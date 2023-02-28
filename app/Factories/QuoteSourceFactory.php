<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\QuoteSourceServiceContract;
use App\Models\QuoteSource;

class QuoteSourceFactory
{
    /**
     * Get service of QuoteSource
     * 
     * @param string $id QuoteSource id
     * @return \App\Contracts\QuoteSourceServiceContract
     */
    public function getServiceById(string $id): QuoteSourceServiceContract
    {
        $quoteService = QuoteSource::find($id);
        $fullServiceName = 'App\Services\QuoteSources\\' . $quoteService->resource;
        return new $fullServiceName;
    }
}
