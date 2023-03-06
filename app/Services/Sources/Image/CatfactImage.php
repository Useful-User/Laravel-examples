<?php

declare(strict_types=1);

namespace App\Services\Sources\Image;

use App\Contracts\ImageContract;
use App\Models\QuoteSource;

class CatfactImage implements ImageContract
{
    /**
     * All data about Image
     */
    private $data = [];

    /**
     * Url of Image
     */
    private $url = '';

    /**
     * Make request
     */
    public function request(): void
    {
        $name = str_replace('Image', '', class_basename($this::class));
        $this->url = QuoteSource::where('resource', $name)->firstOrFail()->image_url;
        $size = getimagesize($this->url);
        $this->data['size'] = $size;
    }

    /**
     * Get Image url
     * 
     * @return string Image url as a string
     */
    public function get(): string
    {
        return $this->url;
    }

    /**
     * Get Size
     * 
     * @return string Size as a string
     */
    public function size(): string
    {
        return $this->data['size'][3];
    }
}
