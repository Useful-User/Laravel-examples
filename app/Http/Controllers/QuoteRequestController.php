<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\QuoteSourceFactory;
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

class QuoteRequestController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quoteRequest = QuoteRequest::where('token', $id)->firstOrFail();
        session()->reflash();
        return new ShowQuoteRequestResource($quoteRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuoteRequestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuoteRequestRequest $request, $id)
    {
        // check for availability
        if (!QuoteSource::methodAvailable($request)) abort(400, "Quote Source not allowed");

        $quoteRequest = QuoteRequest::where('token', $id)->firstOrFail();   // get quoteReques
        $quoteRequest->quote_source_id = $request->quote_source_id;         // add quote_source_id for quoteReques
        $quoteRequest->save();                                              // save

        session()->reflash();
        $quote_factory = new QuoteSourceFactory();
        $quote_service = $quote_factory->getServiceById($request->quote_source_id);
        $quote = $quote_service->getQuote($quoteRequest);
        return [
            'data' => [
                'quote' => $quote,
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreQuoteRequestRequest  $request
     * @return \Illuminate\Http\Response
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
     * Get Quote Requests with callbacks by filters.
     *
     * @param  \App\Http\Requests\ListQuoteRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function list(ListQuoteRequestRequest $request)
    {
        $quoteRequests = QuoteRequestService::getFiltered($request);
        return ListQuoteRequestResource::collection($quoteRequests);
    }
}
