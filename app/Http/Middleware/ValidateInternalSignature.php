<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\Signature;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateInternalSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $signature = new Signature(config('app.internal_key'));
        if (session()->get('s') === null) abort(400, "Signature not valid");
        if (!$signature->check(['token' => $request->route('id')], session()->get('s'))) {
            abort(400, "Signature not valid");
        }
        return $next($request);
    }
}
