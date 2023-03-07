<?php

declare(strict_types=1);

namespace App\Services\Responses\Full;

use App\Contracts\QuoteResponseContract;
use App\Contracts\SourceFactoryContract;

abstract class FullQuote implements QuoteResponseContract
{
    public function get(): array
    {
        $sourceKit = $this->createSource();
        $qoute = $sourceKit->buildQuote();
        $qoute->request();
        $result['quote'] = $qoute->get();
        $result['author'] = $qoute->author();

        $image = $sourceKit->buildImage();
        $image->request();
        $result['image'] = $image->get();
        $result['size'] = $image->size();
        return $result;
    }

    abstract function createSource(): SourceFactoryContract;
}
