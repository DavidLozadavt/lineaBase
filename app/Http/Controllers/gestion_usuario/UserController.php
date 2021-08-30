<?php

namespace App\Http\Controllers\gestion_usuario;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class UserController extends Controller
{
    public function getUsers()
    {
        $id = FacadesSession::get("company_id");
        $user = ActivationCompanyUser::with('company', 'user', 'user.persona', 'roles', 'estado')
            ->where('company_id', $id)
            ->get();

        return response()->json($user);
    }
}
