<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteSourceAPIResource;
use App\Models\QuoteSource;
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
        return QuoteSourceAPIResource::collection(QuoteSource::all()->sortBy('priority'));
    }
}
