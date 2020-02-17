<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function testRequestToken()
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('https://demo.local/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                //'client_id' => '2', // lookup in oauth_clients table
                //'client_secret' => 'vCD5ZHiPOMBhnbsBwbBt7XAdgyxFTPWL9DlYhkj0', // lookup in oauth_clients table
                'client_id' => '3', // lookup in oauth_clients table
                'client_secret' => 'asw0WsYqe2hcCma5L7ip8vfYfd4kXl0uBpfGmgGP', // lookup in oauth_clients table
                'username' => 'mama.doe@toptal.com',
                'password' => 'toptal123',
                'scope' => '',
            ],
        ]);

        dd((string) $response->getBody());
        return json_decode((string) $response->getBody(), true); 
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function testConvertAuthorizationCodeToAccessToken()
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('https://demo.local/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'client-secret',
                'redirect_uri' => 'asw0WsYqe2hcCma5L7ip8vfYfd4kXl0uBpfGmgGP',
                'code' => $request->code,
            ],
        ]);

        dd((string) $response->getBody());
        return json_decode((string) $response->getBody(), true); 
    }
    

    /**
     * undocumented function
     *
     * @return void
     */
    public function testRedirectForAuthorization()
    {
        //$request->session()->put('state', $state = Str::random(40));
        $state = Str::random(40);

        $query = http_build_query([
            'client_id' => '3',
            'redirect_uri' => 'http://example.com/callback',
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);
        

        // return redirect('http://your-app.com/oauth/authorize?'.$query);

        $response = $this->get('https://demo.local/oauth/authorize?'.$query);

        dd($response);
        //$http = new \GuzzleHttp\Client;

        //$response = $http->get('https://demo.local/oauth/authorize?'.$query);

        //dd((string) $response->getBody());
    }
    
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function testRequestTokenWithSocial()
    {
        $http = new \GuzzleHttp\Client;

        $response = $this->post('https://demo.local/oauth/token', [
            'form_params' => [
                'grant_type' => 'social', // static 'social' value
                'client_id' => '3', // client id
                'client_secret' => 'asw0WsYqe2hcCma5L7ip8vfYfd4kXl0uBpfGmgGP', // client secret
                'provider' => 'facebook', // name of provider (e.g., 'facebook', 'google' etc.)
                'access_token' => 'EAACyI0dnhicBADTZAzlhz9RAxfCXA46gJLMuSgBk5OGEdXBZCDM9ZBKxKTzScNIRYknfDPB5GwYjeo8AP33hKpf55IwJ7kpattWBXWxig7NyNcZCeeE5tbQmQZCZANmEOxscIYLaiZAzD2Xtx89wPKK2nzcf8ZBFVW0jFbL58oAfx7ZCF42gZAKWvJh193lJIbZAhgO98fDfXTxVwZDZD', // access token issued by specified provider
            ],
        ]);
        //$data = json_decode($response->getBody()->getContents(), true);

        dd($response);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function testRegister()
    {
        $email = 'demo@local.com';
        User::where('email', $email)->delete();
        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'     
        ];

        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];
        $cookies = [];

        $payloads = [
            'name' => 'DEMO',
            'email' => $email,
            'password' => 'demolocal123',
            'password_confirmation' => 'demolocal123'
        ];

        // register user 
        $response = $this->call(
            "POST",
            'https://demo.local/api/register',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );
        
        $accessToken = $response->decodeResponseJson()['access_token'];

        $headersWithAuthToken = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken
        ];


        // test access_token work or not
        $apiUserResponse = $this->call(
            'GET',
            'https://demo.local/api/user',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headersWithAuthToken),
        );

        dd($apiUserResponse);
    }
    
    /**
     * Test must run after Register test
     *
     * @return void
     */
    public function testLogin()
    {
        $email = 'demo@local.com';
        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'     
        ];

        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];
        $cookies = [];

        $payloads = [
            'username' => $email,
            'password' => 'demolocal123',
        ];

        // register user 
        $response = $this->call(
            "POST",
            'https://demo.local/api/login',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );
        //dd($response);

        $accessToken = $response->decodeResponseJson()['access_token'];

        // Pull User with access token
        $headersWithAuthToken = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken
        ];


        $apiUserResponse = $this->call(
            'GET',
            'https://demo.local/api/user',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headersWithAuthToken),
        );

        //expect unauthenticated
        dd($apiUserResponse);
    }

    /**
     * Test must run after Register test and Login
     * Oauth refresh token
     *
     * @return void
     */
    public function testRefreshToken()
    {
        $email = 'demo@local.com';
        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'     
        ];

        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];
        $cookies = [];

        $payloads = [
            'username' => $email,
            'password' => 'demolocal123',
        ];

        // register user 
        $response = $this->call(
            "POST",
            'https://demo.local/api/login',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );

        $refreshToken = $response->decodeResponseJson()['refresh_token'];


        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];

        $payloads = [
            'refresh_token' => $refreshToken,
        ];

        // register user 
        $responseRefresh = $this->call(
            "POST",
            'https://demo.local/api/refresh',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );
        dd($responseRefresh);
    }
    
    /**
     * Test must run after Register test and Login
     * Oauth refresh token
     * Case pull user with token before refresh token
     * Expect get unauthorize
     *
     * @return void
     */
    public function testPullUserAfterRefreshToken()
    {
        $email = 'demo@local.com';
        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'     
        ];

        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];
        $cookies = [];

        $payloads = [
            'username' => $email,
            'password' => 'demolocal123',
        ];

        // register user 
        $response = $this->call(
            "POST",
            'https://demo.local/api/login',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );

        $accessToken = $response->decodeResponseJson()['access_token'];
        $refreshToken = $response->decodeResponseJson()['refresh_token'];


        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];

        // refresh token
        $payloads = [
            'refresh_token' => $refreshToken,
        ];

        $responseRefresh = $this->call(
            "POST",
            'https://demo.local/api/refresh',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );

        // Pull User with old access token
        $headersWithAuthToken = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken
        ];


        $apiUserResponse = $this->call(
            'GET',
            'https://demo.local/api/user',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headersWithAuthToken),
        );

        //expect unauthenticated
        dd($apiUserResponse);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function testLogout()
    {
        // Login
        $email = 'demo@local.com';
        $headers = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json'     
        ];

        //$cookies = ['api_token' => Crypt::encrypt($token, EncryptCookies::serialized('api_token'))];
        $cookies = [];

        $payloads = [
            'username' => $email,
            'password' => 'demolocal123',
        ];

        // login user
        $response = $this->call(
            "POST",
            'https://demo.local/api/login',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headers),
            json_encode($payloads)
        );


        $accessToken = $response->decodeResponseJson()['access_token'];

        // Pull User with access token
        $headersWithAuthToken = [
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken
        ];


        $logoutResponse = $this->call(
            'POST',
            'https://demo.local/api/logout',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headersWithAuthToken),
        );

        dd($logoutResponse);

        // when get apiUser should get unauthorized
        $apiUserResponse = $this->call(
            'GET',
            'https://demo.local/api/user',
            [],
            $cookies,
            [],
            $this->transformHeadersToServerVars($headersWithAuthToken),
        );

        //expect unauthenticated
        dd($apiUserResponse);
    }
    
}
