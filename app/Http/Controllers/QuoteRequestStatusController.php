<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestStatusController extends Controller
{
    /**
     * Get list of Invoice statuses.
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteRequestStatuses()
    {
        $data = QuoteRequest::select('quote_request_status_id')
            ->distinct()
            ->get(['quote_request_status_id'])      // get all invoices statuses
            ->map(function ($item) {                // map function helps separete values from keys
                return $item->status;
            });

        return [                            // return as array with key 'data'
            'data' => $data,
        ];
    }
}
