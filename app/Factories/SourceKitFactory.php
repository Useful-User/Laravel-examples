<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\QuoteResponseContract;
use App\Contracts\SourceKitFactoryContract;
use App\Models\QuoteSource;

class SourceKitFactory implements SourceKitFactoryContract
{
    /**
     * Get full quote.
     */
    public function build(string|int $id, string $type): QuoteResponseContract
    {
        $quoteService = QuoteSource::find($id);
        $serviceName = $quoteService->resource;
        switch ($type) {
            case 'full':
                $name = '\App\Services\Responses\Full\\' . $serviceName . 'FullQuote';
                break;

            case 'single':
                $name = '\App\Services\Responses\Single\\' . $serviceName . 'SingleQuote';
                break;

            default:
                throw new \Exception('Unsupported type: ' . $type);
        }
        return app($name);
    }
}
