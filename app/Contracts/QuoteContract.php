<?php

declare(strict_types=1);

namespace App\Contracts;

interface QuoteContract
{
    /**
     * Make request
     */
    public function request(): void;

    /**
     * Get Quote
     * 
     * @return string Quote as a string
     */
    public function get(): string;

    /**
     * Get Author
     * 
     * @return string Author as a string
     */
    public function author(): string;
}
