<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\QuoteSourceAPIResource;
use App\Http\Resources\QuoteSourceResource;
use App\Models\QuoteRequest;
use App\Models\QuoteSource;
use App\Services\QuoteSourceService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteSourceController extends Controller
{
    /**
     * Get all available quote sources.
     */
    public function index(): JsonResource
    {
        return QuoteSourceAPIResource::collection(
            QuoteSource::all()->sortBy('priority')
        );
    }

    /**
     * Get available Sources for current Quote Request.
     */
    public function show(string $id): JsonResource
    {
        session()->reflash();
        $quoteRequest = QuoteRequest::where('token', $id)->firstOrFail();
        $quoteSources = QuoteSourceService::getQuoteSources($quoteRequest);
        $quoteSources = $quoteSources->sortBy('id')->sortBy('priority');
        return QuoteSourceResource::collection($quoteSources);
    }
}
