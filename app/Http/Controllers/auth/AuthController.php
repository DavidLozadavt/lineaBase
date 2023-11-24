<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use stdClass;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized por feo'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getPermissions()
    {
        $permissions = Session::get('permissions');
        return response() -> json($permissions);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function setCompany(Request $request)
    {
        $id = auth()->id();
        $idUserActive = $request -> input('idUserActive');

        $userActivate = ActivationCompanyUser::with('company')
            ->active()
            ->byUser($id)
            ->findOrFail($idUserActive);

        $permissionsName = $this->permissionsToString($userActivate->getAllPermissions());

        $response = new stdClass();
        $response->user = Persona::where('id', auth()->user()->idpersona)->first();
        $response->permission = $permissionsName;
        $response->userActivate = $userActivate;

        Session::put('company_id', $userActivate->company_id);
        Session::put('user_activate_id', $userActivate->id);
        Session::put('permissions', $permissionsName);
        Session::put('user', json_encode($response));
    }

    protected function permissionsToString($permissions)
    {
        $permissions = collect($permissions)->map(function ($permission) {
            return $permission->name;
        });
        return implode(',', $permissions->toArray());
    }
}
