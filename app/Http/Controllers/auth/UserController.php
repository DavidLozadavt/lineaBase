<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Models\Person;
use App\Models\Status;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function logged()
    {
        $response = Session::get('usuario');
        return response($response);
    }

    public function setCompany($idCompany)
    {
        $id = auth()->user()->id;

        $userActivate = ActivationCompanyUser::with('company')
            ->where('user_id', $id)
            ->where('company_id', $idCompany)
            ->where('state_id', Status::ID_ACTIVE)
            ->first();

        $permissionsName = $this->permissionsToString($userActivate->getAllPermissions());

        $response = new \stdClass();
        $response->user = Person::where('id', auth()->user()->idPersona)->first();
        $response->permission = $permissionsName;
        $response->userActivate = $userActivate;

        Session::put('idEmpresa', $userActivate->company_id);
        Session::put('permissions', $permissionsName);
        Session::put('usuario', json_encode($response));
    }

    private function permissionsToString($permissions)
    {
        $permissions = collect($permissions)->map(function ($permission) {
            return $permission->name;
        });
        return implode(',', $permissions->toArray());
    }
}
