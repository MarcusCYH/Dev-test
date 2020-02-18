<?php

namespace App\Services\SocialAccountsService;

use App\Services\SocialAccountsService\SocialAccountContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class Facebook
 * @author Larry Mckuydee
 */
class Facebook implements SocialAccountContract
{
    const PROVIDER = "facebook";
    const DEBUG_TOKEN_URL = "https://graph.facebook.com/debug_token?input_token={input-token}&access_token={valid-access-token}";
    const ACCESS_TOKEN_URL = "https://graph.facebook.com/oauth/access_token?client_id={your-app-id}&client_secret={your-app-secret}&grant_type=client_credentials";

    
    /**
     * undocumented function
     *
     * @return void
     */
    public function validateToken(Request $request)
    {
        $http = new Client();
        $url = self::DEBUG_TOKEN_URL;
        $url = Str::replaceFirst('{input-token}', $request->provider_user_access_token, $url);
        $url = Str::replaceFirst('{valid-access-token}', env('FACEBOOK_APP_ACCESS_TOKEN'), $url);
        //$response = Http::get($url)->send();

        try {
            $response = $http->request('GET', $url);
        } catch (ClientException $e) {
            Log::error($e);
            return collect(["error" => ["message" => $e->getMessage()]]);
        }

        $data = $this->removeDataWrapIfHasError(json_decode($response->getBody()->getContents(), true));

        return collect($data);
        // return (string) $response->getBody();
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function getAccessToken()
    {
        $http = new Client();
        $url = self::ACCESS_TOKEN_URL;
        $url = Str::replaceFirst('{your-app-id}', env('FACEBOOK_CLIENT_ID'), $url);
        $url = Str::replaceFirst('{your-app-secret}', env('FACEBOOK_CLIENT_SECRET'), $url);
        $response = $http->request('GET', $url);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * undocumented function
     *
     * @return void
     */
    private function removeDataWrapIfHasError(array $data)
    {
        if (collect($data['data'])->has('error')) {
            return $data['data'];
        }
        return $data;
    }
    
    
}
