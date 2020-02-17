<?php

namespace App;

use App\LinkedSocialAccount;
use App\Services\LoginProvider\Facebook;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * undocumented function
     *
     * @return void
     */
    public function linked_social_accounts()
    {
        return $this->hasMany(LinkedSocialAccount::class);
    }
    

    /**
     * undocumented function
     *
     * @return void
     */
    public function validateToken($inputToken)
    {
        switch($this->provider){
            case 'facebook':
                $validateToken = Facebook::validateToken($inputToken, $this->token);
                break;
            case 'tweet':
                break;
            default:
                throw Exception('Invalid login provider');
        }

        return $validateToken;
    }
    
    /**
     * Validate provider id to check if it is legit
     *
     * @return bool
     */
    public function validateProvider($providerId, $providerAppId)
    {
        return ($providerId == $this->provider_id && $providerAppId == env('FACEBOOK_CLIENT_ID', null));
    }
    
}
