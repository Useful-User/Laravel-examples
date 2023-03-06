<?php

declare(strict_types=1);

use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\QuoteRequestStatusController;
use App\Http\Controllers\QuoteSourceController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get("/", function () {
            return new UserResource(Auth::user());
        })->name('user');
    });

    Route::prefix('quoterequest')->group(function () {
        Route::post('/list', [QuoteRequestController::class, 'list'])
            ->name('quoterequest.list');
        Route::get('/statuses', [QuoteRequestStatusController::class, 'index'])
            ->name('quoterequest.statuses.index');
    });

    Route::prefix('quotesources')->group(function () {
        Route::get('/', [QuoteSourceController::class, 'index'])
            ->name('quotesource.index');
    });
});
