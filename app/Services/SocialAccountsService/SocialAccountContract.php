<?php

namespace App\Services\SocialAccountsService;

use Illuminate\Http\Request;

/**
 * Interface SocialAccountContract
 * @author Larry Mckuydee
 */
interface SocialAccountContract
{
    public function validateToken(Request $request);
}
