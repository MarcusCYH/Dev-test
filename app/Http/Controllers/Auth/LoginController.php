<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function showAdminLoginForm()
    {
        return view('admin.auth.login', ['url' => 'admin/login']);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (
            Auth::guard('admin')->attempt(
                ['email' => $request->email, 
                'password' => $request->password],
                $request->get('remember')
            )
        ) {
            return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    // public function redirectToProvider()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    // public function handleProviderCallback()
    // {
    //     \Illuminate\Support\Facades\Log::info("Facebook called back");
    //     $userInfo = Socialite::driver('facebook')->user();

    //     // $userInfo->token;

    //     // OAuth Two Providers
    //     $token = $userInfo->token;
    //     $refreshToken = $userInfo->refreshToken; // not always provided
    //     $expiresIn = $userInfo->expiresIn;

    //     // All Providers
    //     $userInfo->getId();
    //     $userInfo->getNickname();
    //     $userInfo->getName();
    //     $userInfo->getEmail();
    //     $userInfo->getAvatar();

    //     $user = User::where('provider_id', $userInfo->id)->first();

    //     if(!$user)
    //     {
    //         $user = User::create([
    //             'email' => $userInfo->getEmail(),
    //             'name' => $userInfo->getName(),
    //             'provider' => 'facebook',
    //             'provider_id' => $userInfo->id
    //         ]);
    //     }

    //
    //     auth()->login($user);

    //     return redirect()->to('/home');
    // }
}
