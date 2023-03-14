<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\SourceKitFactory;
use App\Http\Requests\ListQuoteRequestRequest;
use App\Http\Requests\StoreQuoteRequestRequest;
use App\Http\Requests\UpdateQuoteRequestRequest;
use App\Http\Resources\ListQuoteRequestResource;
use App\Http\Resources\ShowQuoteRequestResource;
use App\Models\QuoteRequest;
use App\Models\QuoteSource;
use App\Services\QuoteRequestService;
use App\Services\Signature;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteRequestController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource
    {
        $quoteRequest = QuoteRequest::where('token', $id)->firstOrFail();
        session()->reflash();
        return new ShowQuoteRequestResource($quoteRequest);
    }

    /**
     * Update the specified resource in storage. And return requested data.
     * 
     * @return array<int, string>
     */
    public function update(UpdateQuoteRequestRequest $request, string $id): array
    {
        // check for availability
        if (!QuoteSource::methodAvailable($request)) abort(400, "Quote Source not allowed");

        $quoteRequest = QuoteRequest::where('token', $id)->firstOrFail();   // get quoteReques
        $quoteRequest->quote_source_id = $request->quote_source_id;         // add quote_source_id for quoteReques
        $quoteRequest->save();                                              // save

        $fullQuote = (new SourceKitFactory())->build($request->quote_source_id, 'full');

        session()->reflash();
        return [
            'data' => $fullQuote->get(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuoteRequestRequest $request)
    {
        $token = Signature::uniqueToken('quote_requests');
        // creatre Quote Request
        QuoteRequest::create([
            'external_id'               => $request->external_id,
            'quote_request_status_id'   => 1,
            'token' => $token,
        ]);

        // redirect to front with token and session
        return redirect('/#' . $token)
            ->with('s', Signature::internalSignature($token));
    }

    /**
     * Get Quote Requests with status by filters.
     */
    public function list(ListQuoteRequestRequest $request): JsonResource
    {
        $quoteRequests = QuoteRequestService::getFiltered($request);
        return ListQuoteRequestResource::collection($quoteRequests);
    }
}
