<?php

declare(strict_types=1);

namespace App\Contracts;

interface ImageContract
{
    /**
     * Make request
     */
    public function request(): void;

    /**
     * Get Image url
     */
    public function get(): string;

    /**
     * Get Size
     */
    public function size(): string;
}
