<?php

namespace App\Http\Middleware;

use App\Services\Signature;
use Closure;
use Illuminate\Http\Request;

class ValidateInternalSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $signature = new Signature(config('app.internal_key'));
        if (session()->get('s') === null) abort(400, "Signature not valid");
        if (!$signature->check(['token' => $request->route('id')], session()->get('s'))) abort(400, "Signature not valid");
        return $next($request);
    }
}
