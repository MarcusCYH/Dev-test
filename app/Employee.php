<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
            'company_id',
            'name',
            'email',
            'password',
            'api_token',
            'system_id',
            'avatar',
            'google2fa_secret',
            'is_google2fa_enabled',
            'division_id',
            'department_id',
            'section_id',
            'cost_center_id',
            'ranking_id',
            'gender_id',
            'race_id',
            'religion_id',
            'employment_status_id',
            'salary_grade_id',
            'position_id',
            'head_of_division_id',
            'head_of_department_id',
            'performance_manager_id',
            'personal_assistant_id',
            'festival_id',
            'preferred_name',
            'date_of_birth',
            'citizenship',
            'first_emergency_contact_id',
            'second_emergency_contact_id',
            'home_address_id',
            'correspond_address_id',
            
    ];

}
