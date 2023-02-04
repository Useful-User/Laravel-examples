<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequestRequest;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreQuoteRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuoteRequestRequest $request)
    {

        // creatre Quote Request
        $quoteRequest = QuoteRequest::create([
            'external_id'               => $request->external_id,
            'quote_request_status_id'   => 1,
        ]);

        // redirect to front with token and session
        return redirect('/#' . $quoteRequest->id);
    }

    /**
     * Get Quote Request.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        return QuoteRequest::all();
    }
}
