<?php

use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\QuoteSourceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    session()->reflash();
    return 'Front page should be here!';
})->name('frontpage');

Route::post('/quoterequest', [QuoteRequestController::class, 'store'])->name('quoterequest.store');

Route::prefix('back')->middleware('internal.signature')->group(function () {
    Route::get('/quoterequest/{id}', [QuoteRequestController::class, 'show'])->name('quoterequest.show');
    Route::put('/quoterequest/{id}', [QuoteRequestController::class, 'update'])->name('quoterequest.update');
    Route::get('/quotesources/{id}', [QuoteSourceController::class, 'show'])->name('quotesources.show');

    Route::get("/v", function () {
        return '0.1';
    })->withoutMiddleware('internal.signature')->name('version');
});
