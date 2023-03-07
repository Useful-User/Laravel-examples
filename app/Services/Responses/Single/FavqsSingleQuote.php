<?php

declare(strict_types=1);

namespace App\Services\Responses\Single;

use App\Contracts\SourceFactoryContract;
use App\Factories\FavqsFactory;

class FavqsSingleQuote extends SingleQuote
{

    function createSource(): SourceFactoryContract
    {
        return new FavqsFactory();
    }
}
