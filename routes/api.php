<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function() {
    Route::post('/validate_token', 'Auth\LoginController@validateToken')->name('api.validate_token');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/refresh', 'Auth\LoginController@refresh');
    Route::post('/social_auth', 'Auth\SocialAuthController@socialAuth');
    //Route::post('/login', 'AuthController@login');
    //Route::post('/register', 'AuthController@register');
    Route::post('/login/{provider}/provider_login', 'Auth\LoginController@providerLogin')->name('api.login.provider.provider_login');
});

Route::group(['namespace' => 'Api', 'middleware' => ['auth:api']], function() {
    Route::post('logout', 'Auth\LoginController@logout');
    //Route::apiResource('personal_infos', 'PersonalInfoController')->only(['store', 'update', 'show']);
    Route::get('personal_info', 'PersonalInfoController@show')->name('personal_info.show');
    Route::post('personal_info', 'PersonalInfoController@store')->name('personal_info.store');
    Route::match(['put', 'patch'], 'personal_info', 'PersonalInfoController@update')->name('personal_info.update');
});

Route::get('/test', function (){
    $users = \App\User::all();
    return \App\Http\Resources\UserResource::collection($users);
});

Route::get('/log-test', function (){
    \Illuminate\Support\Facades\Log::info("TEst");

    return '';
});
