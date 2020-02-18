<?php

namespace App\Providers;

use App\Services\SocialAccountsService\SocialAccountContract;
use App\Services\SocialAccountsService\Facebook;
use Illuminate\Support\ServiceProvider;

class SocialAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SocialAccountContract::class, function($app) {
            return new Facebook();
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
}
