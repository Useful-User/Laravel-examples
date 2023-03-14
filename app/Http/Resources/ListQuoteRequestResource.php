<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListQuoteRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'external_id' => $this->external_id,
            'status_id' => $this->quote_request_status_id,
            'status' => $this->whenLoaded('status')->name,
            'quote_source' => new QuoteSourceAPIResource($this->whenLoaded('quoteSource')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
