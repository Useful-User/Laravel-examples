<?php

declare(strict_types=1);

namespace App\Services\Sources\Image;

use App\Contracts\ImageContract;
use App\Models\QuoteSource;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class QuotesRestImage implements ImageContract
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

        try {
            $response = Http::retry(3, 100)->get($this->url);
            $response->throw();
        } catch (RequestException $exception) {
            abort(403, "Something went wrong while performing your request, please contact customer support");
        }

        $this->data = $response;
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
        return $this->data['size'];
    }
}
