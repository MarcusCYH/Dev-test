<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Class IssueTokenTrait
 * @author Larry Mckuydee
 */
trait IssueTokenTrait
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function issueToken(Request $request, $grantType, $scope='*')
    {
        $params = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => '*'
        ];

        if ($grantType != 'social') {
            $params['username'] = $request->username ?: $request->email;
        }

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }
    
}
