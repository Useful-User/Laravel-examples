<?php

declare(strict_types=1);

namespace App\Contracts;

interface SourceKitFactoryContract
{
    /**
     * Get quote for response.
     */
    public function build(string $id, string $type): QuoteResponseContract;
}
