<?php

namespace App\Http\Controllers\Auth;

use App\OAuth\OAuth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OauthController extends Controller
{
    /**
     * prepare necessary data for sending to auth server
     * after authentication in auth server, server with response token in callback url
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login()
    {
        // send request to oauth server
        $query = http_build_query([
            'client_id' => 'client-id',
            'redirect_uri' => route('oauth-callback'),
        ]);

        return redirect('http://127.0.0.1:9900/oauth/authorize?'.$query);
    }

    /**
     * after successful authentication in oauth server
     * user will redirected to callback uri
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        $token = $request->get('token');

        // send new request with token
        // get user credentials
        // redirect user to admin area
        $oauth = new OAuth();
        return $oauth->getUserCredential($token);
    }
}
