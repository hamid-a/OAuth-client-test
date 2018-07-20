<?php

namespace App\Http\Controllers\Auth;

use App\OAuth\OAuth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OauthController extends Controller
{
    public function login()
    {
        // send request to oauth server
        $query = http_build_query([
            'client_id' => 'client-id',
            'redirect_uri' => route('oauth-callback'),
        ]);

        return redirect('http://127.0.0.1:9900/oauth/authorize?'.$query);
    }

    public function callback(Request $request)
    {
        $token = $request->get('token');

        $oauth = new OAuth();
        return $oauth->getUserCredential($token);
    }
}
