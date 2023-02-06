<?php

namespace App\Factories;

use App\Contracts\QuoteSourceServiceContract;
use App\Models\QuoteSource;

class QuoteSourceFactory
{
    public function getServiceById(string $service_id): QuoteSourceServiceContract
    {
        $quote_service = QuoteSource::find($service_id);
        $full_service_name = 'App\Services\QuoteSources\\' . $quote_service->resource;
        return new $full_service_name;
    }
}
