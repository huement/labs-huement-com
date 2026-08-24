<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieTestController extends Controller
{
    public function stuffHttp()
    {
        $cookieName = 'ref';
        $cookieValue = 'unsolicited_http_stuff_456';
        $cookie = cookie($cookieName, $cookieValue, 60);
        return response()->json(['cookie' => "{$cookieName}={$cookieValue}"])->withCookie($cookie);
    }

    public function stuffJs()
    {
        $cookieName = 'aff_id';
        $cookieValue = 'unsolicited_js_stuff_123';
        $cookie = cookie($cookieName, $cookieValue, 60);
        return response()->json(['cookie' => "{$cookieName}={$cookieValue}"])->withCookie($cookie);
    }

    public function stuffLegit()
    {
        $cookieName = 'aff_id';
        $cookieValue = 'legitimate_user_click_456';
        $cookie = cookie($cookieName, $cookieValue, 60);
        return response()->json(['cookie' => "{$cookieName}={$cookieValue}"])->withCookie($cookie);
    }

    public function redirectHop()
    {
        return redirect('/cookie-test?redirect_executed=true')->cookie('partner_tag', 'unsolicited_redirect_chain_777', 60);
    }

    /**
     * Test 05: Immediate On-Load Pixel Drop (Tests Early Timing < 500ms)
     */
    public function stuffOnLoad()
    {
        $cookie = cookie('aff_id', 'early_timing_stuff_999', 60);
        return response()->json(['cookie' => 'aff_id=early_timing_stuff_999'])->withCookie($cookie);
    }

    /**
     * Test 06: Ad-Tech Display Tracker Simulation (Tests Ad-Tech Suppression)
     */
    public function adtechSync()
    {
        // Name matches generic tracker pattern, but should be suppressed if requested via Ad-Tech context
        $cookie = cookie('adsrvr_id', 'display_ad_sync_123', 60);
        return response()->json(['cookie' => 'adsrvr_id=display_ad_sync_123'])->withCookie($cookie);
    }
}
