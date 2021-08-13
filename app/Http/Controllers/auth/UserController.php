<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Person;

class UserController extends Controller
{
    public function logged() {
        $response = new \stdClass();
        $response->user = Person::where('id', auth()->user()->idPersona)->first();
        $response->permissions = auth()->user()->permissions;
        return response()->json($response);
    }
}
