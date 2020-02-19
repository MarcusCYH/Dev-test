<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('name')->nullable();
            $table->string('nric')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('nric_front_copy')->nullable();
            $table->string('mobile_no')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->string('occupation')->nullable();
            $table->tinyInteger('marital_status')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
}
