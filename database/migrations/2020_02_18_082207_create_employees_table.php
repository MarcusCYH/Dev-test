<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token')->nullable();
            $table->string('system_id');
            $table->string('avatar')->nullable();
            $table->string('google2fa_secret')->default(0);
            $table->tinyInteger('is_google2fa_enabled')->default(0);
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('cost_center_id')->nullable();
            $table->unsignedBigInteger('ranking_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->unsignedBigInteger('race_id')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('employment_status_id')->nullable();
            $table->unsignedBigInteger('salary_grade_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('head_of_division_id')->nullable();
            $table->unsignedBigInteger('head_of_department_id')->nullable();
            $table->unsignedBigInteger('performance_manager_id')->nullable();
            $table->unsignedBigInteger('personal_assistant_id')->nullable();
            $table->unsignedBigInteger('festival_id')->nullable();
            $table->string('preferred_name')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('citizenship')->nullable();
            $table->unsignedBigInteger('first_emergency_contact_id')->nullable();
            $table->unsignedBigInteger('second_emergency_contact_id')->nullable();
            $table->unsignedBigInteger('home_address_id')->nullable();
            $table->unsignedBigInteger('correspond_address_id')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
