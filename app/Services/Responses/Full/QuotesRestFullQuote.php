<?php

declare(strict_types=1);

namespace App\Services\Responses\Full;

use App\Contracts\SourceFactoryContract;
use App\Factories\QuotesRestFactory;

class QuotesRestFullQuote extends FullQuote
{

    function createSource(): SourceFactoryContract
    {
        return new QuotesRestFactory();
    }
}
