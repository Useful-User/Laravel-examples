<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\QuoteRequest;

interface QuoteSourceServiceContract
{
    public function getQuote(QuoteRequest $quoteRequest): string;
}
