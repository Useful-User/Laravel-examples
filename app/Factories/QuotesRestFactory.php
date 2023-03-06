<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\ImageContract;
use App\Contracts\QuoteContract;
use App\Contracts\SourceFactoryContract;
use App\Services\Sources\Image\QuotesRestImage;
use App\Services\Sources\Quote\QuotesRestQuote;

class QuotesRestFactory implements SourceFactoryContract
{
    /**
     * Build Quote
     * 
     * @return App\Contracts\QuoteContract
     */
    public function buildQuote(): QuoteContract
    {
        return new QuotesRestQuote();
    }

    /**
     * Build Image
     * 
     * @return App\Contracts\ImageContract
     */
    public function buildImage(): ImageContract
    {
        return new QuotesRestImage();
    }
}
