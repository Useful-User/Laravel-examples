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
        $quote_service = QuoteSource::find($id);
        $full_service_name = 'App\Services\QuoteSources\\' . $quote_service->resource;
        return new $full_service_name;
    }
}
