<?php

use App\Http\Controllers\CookieTestController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Root / Splash Page
 * |--------------------------------------------------------------------------
 */
Route::get('/splash', function () {
    return view('splash');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/health', function () {
    return response('OK', 200);
});

/*
 * |--------------------------------------------------------------------------
 * | LAB 01: Cookie Stuffing Lab (/cookie-test)
 * |--------------------------------------------------------------------------
 */

Route::prefix('cookie-test')->group(function () {
    // Lab UI Page
    Route::get('/', function () {
        return view('labs.cookie-test');
    });

    // API endpoints
    Route::get('/api/stuff-http', [CookieTestController::class, 'stuffHttp']);
    Route::get('/api/stuff-js', [CookieTestController::class, 'stuffJs']);
    Route::get('/api/stuff-legit', [CookieTestController::class, 'stuffLegit']);
    Route::get('/api/redirect-hop', [CookieTestController::class, 'redirectHop']);
});
