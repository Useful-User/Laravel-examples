<?php

declare(strict_types=1);

namespace App\Contracts;

interface QuoteResponseContract
{
    /**
     * Get data
     * 
     * @return array
     */
    public function get(): array; // @todo return a more specific object

    /**
     * Return specific source factory
     * 
     * @return \App\Contracts\SourceFactoryContract
     */
    public function createSource(): SourceFactoryContract;
}
