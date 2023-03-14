<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\ImageContract;
use App\Contracts\QuoteContract;
use App\Contracts\SourceFactoryContract;
use App\Services\Sources\Image\FavqsImage;
use App\Services\Sources\Quote\FavqsQuote;

class FavqsFactory implements SourceFactoryContract
{
    /**
     * Build Quote.
     */
    public function buildQuote(): QuoteContract
    {
        return app(FavqsQuote::class);
    }

    /**
     * Build Image.
     */
    public function buildImage(): ImageContract
    {
        return app(FavqsImage::class);
    }
}
