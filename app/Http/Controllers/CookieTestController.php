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
}
