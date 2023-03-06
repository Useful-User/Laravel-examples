<?php

declare(strict_types=1);

namespace App\Contracts;

interface ImageContract
{
    /**
     * Make request
     * 
     * @return string Response from source
     */
    public function request(): void;

    /**
     * Get Image url
     * 
     * @return string Image url as a string
     */
    public function get(): string;

    /**
     * Get Size
     * 
     * @return string Size as a string
     */
    public function size(): string;
}
