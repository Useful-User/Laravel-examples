<?php

declare(strict_types=1);

namespace App\Services\Responses\Single;

use App\Contracts\QuoteResponseContract;
use App\Contracts\SourceFactoryContract;

abstract class SingleQuote implements QuoteResponseContract
{
    public function get(): array
    {
        $sourceKit = $this->createSource();
        $qoute = $sourceKit->buildQuote();
        $qoute->request();
        $result['quote'] = $qoute->get();
        return $result;
    }

    abstract function createSource(): SourceFactoryContract;
}
