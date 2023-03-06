<?php

declare(strict_types=1);

namespace App\Contracts;

interface SourceFactoryContract
{
    /**
     * Build Quote
     * 
     * @return App\Contracts\QuoteContract
     */
    public function buildQuote(): QuoteContract;

    /**
     * Build Image
     * 
     * @return App\Contracts\ImageContract
     */
    public function buildImage(): ImageContract;
}
