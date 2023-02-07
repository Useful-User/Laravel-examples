<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListQuoteRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
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
