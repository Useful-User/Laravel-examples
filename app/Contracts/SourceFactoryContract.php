<?php

declare(strict_types=1);

namespace App\Contracts;

interface SourceFactoryContract
{
    /**
     * Build Quote.
     */
    public function buildQuote(): QuoteContract;

    /**
     * Build Image.
     */
    public function buildImage(): ImageContract;
}
