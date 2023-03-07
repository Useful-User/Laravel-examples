<?php

declare(strict_types=1);

namespace App\Services\Responses\Single;

use App\Contracts\SourceFactoryContract;
use App\Factories\CatfactFactory;

class CatfactSingleQuote extends SingleQuote
{

    function createSource(): SourceFactoryContract
    {
        return new CatfactFactory();
    }
}
