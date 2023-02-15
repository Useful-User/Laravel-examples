<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\QuoteSourceAPIResource;
use App\Http\Resources\QuoteSourceResource;
use App\Models\QuoteRequest;
use App\Models\QuoteSource;
use App\Services\QuoteSourceService;
use Illuminate\Http\Request;

class QuoteSourceController extends Controller
{
    /**
     * Get all available quote sources
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return QuoteSourceAPIResource::collection(
            QuoteSource::all()->sortBy('priority')
        );
    }

    /**
     * Get available Sources for current Quote Request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        session()->reflash();
        $quoteRequest = QuoteRequest::where('token', $id)->firstOrFail();
        $quoteSources = QuoteSourceService::getQuoteSources($quoteRequest);
        $quoteSources = $quoteSources->sortBy('id')->sortBy('priority');
        return QuoteSourceResource::collection($quoteSources);
    }
}
