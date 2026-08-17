<?php

use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Root / Splash Page
 * |--------------------------------------------------------------------------
 */
Route::get('/', function () {
    return view('splash');
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

    // Test Endpoint 1: HTTP Set-Cookie Header
    Route::get('/api/stuff-http', function () {
        $cookie = cookie(
            name: 'aff_id',
            value: 'unsolicited_laravel_http_999',
            minutes: 60,
            path: '/',
            domain: null,
            secure: false,
            httpOnly: false,
            raw: false,
            sameSite: 'lax'
        );

        return response()->json([
            'status' => 'STUFFED',
            'vector' => 'Laravel Set-Cookie Response Header',
            'cookie' => 'aff_id=unsolicited_laravel_http_999',
        ])->withCookie($cookie);
    });

    // Test Endpoint 2: 302 Redirect Hop Cookie Drop
    Route::get('/api/redirect-hop', function () {
        $cookie = cookie(
            name: 'partner_tag',
            value: 'unsolicited_redirect_chain_777',
            minutes: 60,
            path: '/',
            domain: null,
            secure: false,
            httpOnly: false,
            raw: false,
            sameSite: 'lax'
        );

        return redirect('/cookie-test?redirect_executed=true')->withCookie($cookie);
    });
});
