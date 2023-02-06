<?php

namespace App\Contracts;

use App\Models\QuoteRequest;

interface QuoteSourceServiceContract
{
    public function getQuote(QuoteRequest $quoteRequest): string;
}
