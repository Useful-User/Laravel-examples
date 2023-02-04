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
    return 'Front page should be here!';
})->name('frontpage');

Route::post('/quoterequest', [QuoteRequestController::class, 'store'])->name('quoterequest.store');
