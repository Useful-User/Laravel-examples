<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\QuoteRequest;
use App\Models\QuoteSource;

class QuoteSourceService
{
    /**
     * Get available quoteSources for current Request 
     * 
     * @param App\Models\QuoteRequest
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getQuoteSources(QuoteRequest $quoteRequest)
    {
        $quoteSources = QuoteSource::where('availability', 1)          // available
            // here can be lots of request conditions
            // For example:
            // 
            // ->where(function ($req) use ($country) {                                 // checking county 
            //     return $req->where(function ($req) {                                 // no rules
            //         return $req->whereNull('allowed_countries')
            //             ->whereNull('restricted_countries');
            //     })
            //         ->orWhere(function ($req) use ($country) {                       // or country in the list of allowed countries
            //             return $req->whereNotNull('allowed_countries')
            //                 ->whereJsonContains('allowed_countries', $country);
            //         })
            //         ->orWhere(function ($req) use ($country) {                       // or county not in the list of restricted countries
            //             return $req->whereNotNull('restricted_countries')
            //                 ->whereJsonDoesntContain('restricted_countries', $country);
            //         });
            // })
            ->get();

        return $quoteSources;
    }
}
