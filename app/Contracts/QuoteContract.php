<?php

declare(strict_types=1);

namespace App\Contracts;

interface QuoteContract
{
    /**
     * Make request.
     */
    public function request(): void;

    /**
     * Get Quote.
     */
    public function get(): string;

    /**
     * Get Author.
     */
    public function author(): string;
}
