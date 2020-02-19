<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $fillable = [
            'nric',
            'date_of_birth',
            'nric_front_copy',
            'mobile_no',
            'gender',
            'nationality',
            'religion_id',
            'occupation',
            'marital_status',
            
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
