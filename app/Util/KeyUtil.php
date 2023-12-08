<?php

namespace App\Util;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class KeyUtil
{

    public static function idCompany()
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token)->toArray();
        return $payload['idCompany'];
    }

    public static function roles()
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token)->toArray();
        return $payload['roles'];
    }

    public static function permissions()
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token)->toArray();
        return $payload['permissions'];
    }

    public static function user(){
        return User::with(['persona'])->find(auth()->id());
    }
}
