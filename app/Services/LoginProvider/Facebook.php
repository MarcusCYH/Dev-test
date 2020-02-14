<?php

namespace App\Services\LoginProvider;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

/**
 * Class Facebook
 * @author Larry Mckuydee
 */
class Facebook
{
    const PROVIDER = "facebook";
    const DEBUG_TOKEN_URL = "https://graph.facebook.com/debug_token?input_token={input-token}&access_token={valid-access-token}";
    const ACCESS_TOKEN_URL = "https://graph.facebook.com/oauth/access_token?client_id={your-app-id}&client_secret={your-app-secret}&grant_type=client_credentials";
    
    /**
     * undocumented function
     *
     * @return void
     */
    public static function validateToken($inputToken, $accessToken=null)
    {
        $http = new Client();
        $url = self::DEBUG_TOKEN_URL;
        $url = Str::replaceFirst('{input-token}', $inputToken, $url);
        $url = Str::replaceFirst('{valid-access-token}', $accessToken ?? env('FACEBOOK_APP_ACCESS_TOKEN'), $url);
        //$response = Http::get($url)->send();
        $response = $http->request('GET', $url);

        return json_decode($response->getBody()->getContents());
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public static function getAccessToken()
    {
        $http = new Client();
        $url = self::ACCESS_TOKEN_URL;
        $url = Str::replaceFirst('{your-app-id}', env('FACEBOOK_CLIENT_ID'), $url);
        $url = Str::replaceFirst('{your-app-secret}', env('FACEBOOK_CLIENT_SECRET'), $url);
        $response = $http->request('GET', $url);

        return json_decode($response->getBody()->getContents());
    }
    
}
