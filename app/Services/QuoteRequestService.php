<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\ListQuoteRequestRequest;
use App\Models\QuoteRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class QuoteRequestService
{
    /**
     * Get Quote Request by filters.
     */
    public static function getFiltered(ListQuoteRequestRequest $request): Collection|LengthAwarePaginator
    {
        $quoteRequests =  DB::table('quote_requests')->select('id');                                                        // get id's of all quote requests
        if ($request->from) $quoteRequests = $quoteRequests->where('created_at', '>=', $request->from);                     // 'created_at' after 'from' date
        if ($request->to) $quoteRequests = $quoteRequests->where('created_at', '<=', $request->to);                         // 'created_at' before 'to' date
        if ($request->quote_sources) $quoteRequests = $quoteRequests->whereIn('quote_source_id', $request->quote_sources);  // filter by 'quote_sources'
        if ($request->id) $quoteRequests = $quoteRequests->where('id', $request->id);                                       // filter by 'id'
        if ($request->external_id) $quoteRequests = $quoteRequests->where('external_id', $request->external_id);            // filter by 'external_id'

        if ($request->status) $quoteRequests = $quoteRequests->where(function ($query) {                                    // filter by 'statuses'
            $query->select('name')
                ->from('quote_request_statuses')
                ->whereColumn('quote_request_statuses.id', 'quote_requests.quote_request_status_id')
                ->limit(1);
        }, $request->status);

        $ids = $quoteRequests->get()->pluck('id');
        $result = QuoteRequest::with('status', 'quoteSource')->whereIn('id', $ids);
        if ($request->sort) {                                                                                               // sorting
            $direction = $request->sort['direction'] ?? 'asc';
            $result = $result->orderBy($request->sort['by'], $direction);
        }
        return $request->per_page ? $result->paginate($request->per_page) : $result->get();
    }
}
