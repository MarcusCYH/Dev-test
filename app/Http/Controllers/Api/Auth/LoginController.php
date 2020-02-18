<?php

namespace App\Http\Controllers\Api\Auth;

use Auth;
use DB;
use Socialite;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginProviderRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Auth\IssueTokenTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use IssueTokenTrait;
    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->client = Client::find(2);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        return $this->issueToken($request, 'password');
    }

    /**
     * Refresh token
     *
     * @return void
     */
    public function refresh(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);

        return $this->issueToken($request, 'refresh_token');
        
    }
    
    /**
     * Logout
     *
     * @return void
     */
    public function logout(Request $request)
    {
        $accessToken = Auth::guard('api')->user()->token();

        // may soon change to revoke via event listening
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);

        $accessToken->revoke();

        return response()->json([], 204);
    }
    
    

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        \Illuminate\Support\Facades\Log::info("Facebook called back");
        $userInfo = Socialite::driver('facebook')->user();

        // $userInfo->token;

        // OAuth Two Providers
        $token = $userInfo->token;
        $refreshToken = $userInfo->refreshToken; // not always provided
        $expiresIn = $userInfo->expiresIn;

        // All Providers
        $userInfo->getId();
        $userInfo->getNickname();
        $userInfo->getName();
        $userInfo->getEmail();
        $userInfo->getAvatar();


        $user = User::where('provider_id', $userInfo->id)->first();

        if(!$user)
        {
            $user = User::create([
                'email' => $userInfo->getEmail(),
                'name' => $userInfo->getName(),
                'provider' => 'facebook',
                'provider_id' => $userInfo->id
            ]);
        }

        
        auth()->login($user);

        return redirect()->to('/home');
    }
    
}
