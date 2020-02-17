<?php

namespace App\Providers;

use App\Grants\SocialGrant;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\UserRepository;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Passport;

class SocialAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->afterResolving(AuthorizationServer::class, function(AuthorizationServer $server) {
            $grant = $this->makeGrant();
            $server->enableGrantType($grant, Passport::tokensExpireIn());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function makeGrant()
    {
        $grant = new SocialGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());
        return $grant;
    }
}
