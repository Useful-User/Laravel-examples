<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\QuoteRequest;

interface QuoteSourceServiceContract
{
    /**
     * Get quote
     * 
     * @param \App\Models\QuoteRequest $quoteRequest
     * @return string Quote as a string
     */
    public function getQuote(QuoteRequest $quoteRequest): string;
}
