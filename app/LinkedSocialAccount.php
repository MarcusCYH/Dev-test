<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LinkedSocialAccount extends Model
{
    protected $fillable = [
        'provider',
        'provider_id'
    ];

    /**
     * undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
