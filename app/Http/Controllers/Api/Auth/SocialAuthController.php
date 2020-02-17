<?php

namespace App\Http\Controllers\Api\Auth;

use DB;
use App\User;
use App\LinkedSocialAccount;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Auth\IssueTokenTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Passport\Client;

/**
 * Class SocialAuthController
 * @author Larry Mckuydee
 */
class SocialAuthController extends Controller
{
    use IssueTokenTrait;

    private $client;

    /**
     * undocumented function
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = Client::find(2);
    }
    

    /**
     * undocumented function
     *
     * @return void
     */
    public function socialAuth(Request $request)
    {
        $payloads = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'provider' => 'required|in:facebook,twitter,google',
            'provider_id' => 'required'
        ]);

        $socialAccount = LinkedSocialAccount::where('provider', $payloads['provider'])
                                ->where('provider_id', $payloads['provider_id'])
                                ->first();

        if ($socialAccount) {
            return $this->issueToken($request, 'social');
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $this->addSocialAccountToUser($request, $user);
        } else {
            try {
                $this->createUserAccount($request);
            } catch (Exception $e) {
                return response('An Error occur, please retry later', 422);
            }
        }

        return $this->issueToken($request, 'social');
    }

    /**
     * Associate Social account
     *
     * @return void
     */
    private function addSocialAccountToUser(Request $request, User $user)
    {
        $this->validate($request, [
            'provider' => ['required', Rule::unique('linked_social_accounts')->where(function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })],
            'provider_id' => 'required'
        ]);


        $user->linked_social_accounts()->create([
            'provider' => $request->provider,
            'provider_id' => $request->provider_id
        ]);
    }
    
    
    /**
     * undocumented function
     *
     * @return void
     */
    private function createUserAccount(Request $request)
    {
        DB::transaction(function() use ($request) {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $this->addSocialAccountToUser($request, $user);

        });
    }
    
}
