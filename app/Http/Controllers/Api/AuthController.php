<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function register(Request $request)
    {
        // this move to registration controller
        $payloads = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:App\User',
            'password' => 'required|confirmed'
        ]);
        
        $payloads['password'] = bcrypt($payloads['password']);

        $user = User::create($payloads);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function login(Request $request)
    {
        // this move to login controller
        $payloads = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);


        if (!auth()->attempt($payloads)) {
            return response(['message' => 'Invalid login credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
    
    
}
