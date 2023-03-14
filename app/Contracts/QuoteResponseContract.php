<?php

declare(strict_types=1);

namespace App\Contracts;

interface QuoteResponseContract
{
    /**
     * Get data.
     * 
     * @return array<int, string>
     */
    public function get(): array; // @todo return a more specific object

    /**
     * Return specific source factory.
     */
    public function createSource(): SourceFactoryContract;
}
