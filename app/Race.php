<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(PersonalInfo::class);
    }
}
