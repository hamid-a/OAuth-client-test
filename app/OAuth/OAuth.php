<?php
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

    /**
     * send new request to oauth server and get logged in user credentials
     *
     * if user registered authenticate him and
     * otherwise create new user with credentials and authenticate him
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUserCredential($token)
    {
        $response = $this->request->request('GET', $this->server_url.'/api/v1/user', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        $user = json_decode((string) $response->getBody(), true);

        // user credentials response in json format and contain:
        // user_id, name, email, created_at, updated_at
        // now login or register user
        $this->loginOrRegister($user);

        return redirect()->route('admin_panel');
    }

    /**
     * login or register user based on user`s data
     * if user not exists in database make new user with admin access
     * otherwise authenticate user
     *
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginOrRegister($user)
    {
        // we use update or create model method
        // it will create user if there is no user with this email
        // user logged in with oauth api and we dont need store his password
        // so generate random password that he will could not login from our normal authentication platform
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

        // authenticate user
        Auth::loginUsingId($user->id);

        // he is admin, so redirect him to admin panel
        return redirect()->route('admin_panel');
    }


}