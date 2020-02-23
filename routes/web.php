<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/envtest', function (){
    return env('AWS_BUCKET');
});

Route::get('/upload-page', function() {
    return view('upload_page');
});

// comment off currently because using adminarchitect
// Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
// Route::post('/admin/login', 'Auth\LoginController@adminLogin');
// Route::group(['middleware' => ['auth:admin']], function() {
//     Route::view('/admin', 'admin');
// });

