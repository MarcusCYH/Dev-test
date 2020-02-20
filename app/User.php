<?php

namespace App;

use App\LinkedSocialAccount;
use App\PersonalInfo;
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
    public function personal_info()
    {
        return $this->hasOne(PersonalInfo::class);
    }
    
    
}
