<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function index()
    {
        $users = User::all();

        // just to store it for reference purpose, JSON_NUMERIC_CHECK allow you make sure number is send as number not string
        return response()->json(['data' => $users], 200, [], JSON_NUMERIC_CHECK);
    }
    
}
