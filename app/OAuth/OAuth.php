<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 7/20/18
 * Time: 6:01 PM
 */

namespace App\OAuth;


use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class OAuth
{
    private $request;
    private $server_url = '';

    public function __construct()
    {
        $this->request = new Client;
        $this->server_url = 'http://127.0.0.1:9900';
    }

    public function getUserCredential($token)
    {
        $response = $this->request->request('GET', $this->server_url.'/api/v1/user', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        $user = json_decode((string) $response->getBody(), true);

        $this->loginOrRegister($user);

        return redirect()->route('admin_panel');
    }

    private function loginOrRegister($user)
    {
        $user = User::updateOrCreate(
            [
                'email' => $user['email'],
                'access' => 1, // access to admin panel
            ],
            [
                'name' => $user['name'],
                'password' => bcrypt(str_random(32)),
            ]
        );

        Auth::loginUsingId($user->id);

        return redirect()->route('admin_panel');
    }


}