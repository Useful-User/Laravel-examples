<?php

declare(strict_types=1);

namespace App\Contracts;

interface SourceKitFactoryContract
{
    /**
     * Get quote for response
     * 
     * @param string $id QuoteSource id
     * @param string $type Type of quote
     * @return \App\Contracts\QuoteResponseContract
     */
    public function build(string $id, string $type): QuoteResponseContract;
}
