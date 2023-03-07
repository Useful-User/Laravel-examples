<?php

declare(strict_types=1);

namespace App\Services\Responses\Full;

use App\Contracts\SourceFactoryContract;
use App\Factories\FavqsFactory;

class FavqsFullQuote extends FullQuote
{

    function createSource(): SourceFactoryContract
    {
        return new FavqsFactory();
    }
}
