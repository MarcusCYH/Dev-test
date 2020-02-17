<?php

namespace App\Http\Controllers\Api\Auth;

use Auth;
use DB;
use Socialite;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginProviderRequest;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\LoginProvider\Facebook;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
// use GuzzleHttp\Client as HttpClient;

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

    //use IssueTokenTrait;
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

        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => request('username'),
            'password' => request('password'),
            'scope' => '*'
        ];

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
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

        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => request('username'),
            'password' => request('password'),
        ];

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
        
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

    /**
     * validate token
     *
     * @return void
     */
    public function validateToken(LoginProviderRequest $request)
    {
        $user = User::where('email', $request->email)
                    ->orWhere('mobile_no', $request->mobile_no)
                    ->first();

        if ($user)
        {
            $user->validateToken($request->token);
        } 

        return new UserResource($user);
        
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function providerLogin(LoginProviderRequest $request)
    {
        $user = User::where('email', $request->email)
                    ->orWhere('mobile_no', $request->mobile_no)
                    ->where('provider', $request->provider)
                    ->where('provider_id', $request->provider_id)
                    ->get();

        if ($user->count() > 2) throw Exception('duplicate record');

        $validatedToken = Facebook::validateToken($request->provider_token);
        return response()->json($validatedToken);
        if (collect($validatedToken->data)->has('error')) return response()->json($validatedToken, 422);

        // check if user exist if not create user
        if($user)
        {
            $validProvider = $user->validateProvider($validatedToken->data->user_id, $validatedToken->data->app_id);
            
            if ($validProvider) {
                // generate internal token
                // send token back to client

            } else {
               return response()->json(['data' => ['errors' => ['message' => 'This is not a valid user.']]]);
            }
            
        } else {
            // validate fb token


            $payloads = $request->only([
                'name',
                'email',
                'mobile_no',
                'provider_id'
            ]);

            $payloads = Arr::add($payloads, 'provider', $request->provider);

            $user = User::create($payloads);
        }
        
        return new UserResource($user);
    }
    
}
