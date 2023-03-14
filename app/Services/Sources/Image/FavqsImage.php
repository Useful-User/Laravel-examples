<?php

declare(strict_types=1);

namespace App\Services\Sources\Image;

use App\Contracts\ImageContract;
use App\Models\QuoteSource;

class FavqsImage implements ImageContract
{
    /**
     * All data about image.
     */
    private $data = [];

    /**
     * Image url.
     */
    private $url = '';

    /**
     * Make request.
     */
    public function request(): void
    {
        // Remove last 'Quote' from class name
        $name = preg_replace('/(Image(?!.*Image))/', '', class_basename($this::class));
        $this->url = QuoteSource::where('resource', $name)->firstOrFail()->image_url;
        $size = getimagesize($this->url);
        $this->data['size'] = $size;
    }

    /**
     * Get image url.
     */
    public function get(): string
    {
        return $this->url;
    }

    /**
     * Get image size.
     */
    public function size(): string
    {
        return $this->data['size'][3];
    }
}
