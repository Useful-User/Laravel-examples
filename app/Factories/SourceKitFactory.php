<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\SourceFactoryContract;
use App\Models\QuoteSource;

class SourceKitFactory
{
    /**
     * Get source factory
     * 
     * @param string $id QuoteSource id
     * @return \App\Contracts\SourceFactoryContract
     */
    public function getFactory(string $id): SourceFactoryContract
    {
        $quoteService = QuoteSource::find($id);
        $fullServiceName = '\App\Factories\\' . $quoteService->resource . 'Factory';
        return new $fullServiceName;
    }
}
