<?php

namespace App\Services\SocialAccountsService;

use App\User;
use App\LinkedSocialAccount;
use Laravel\Socialite\Two\User as ProviderUser;

/**
 * Class SocialAccountsService
 * @author Larry Mckuydee
 */
class SocialAccountsService
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($linkedSocialAccount) {
            return $linkedSocialAccount->user;
        } else {
            $user = null;

            if ($email = $providerUser->getEmail()) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = User::create([
                    'first_name' => $providerUser->getName(),
                    'last_name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                ]);
            }

            $user->linkedSocialAccounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;
    }
    
}
