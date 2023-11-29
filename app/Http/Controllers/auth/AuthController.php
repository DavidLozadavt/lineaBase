<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Models\Persona;
use App\Util\QueryUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use stdClass;
use Exception;

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
            return response()->json(['error' => 'Unauthorized'], 401);
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

    public function getActiveUsers()
    {
        return ActivationCompanyUser::query()
        ->where(function($query){
            QueryUtil::whereUser($query);
        })->get();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getRoles()
    {
        $roles = Session::get('roles');
        return response()->json($roles);
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
        $data = $request -> all();

        $user_active = ActivationCompanyUser::with('company', 'roles.permissions')
            ->where('id', $data['idUserActive'])
            ->where(function ($query) {
                QueryUtil::whereUser($query);
                QueryUtil::whereActive($query);
            });
        
        if ($user_active -> exists()) {
            $user_active = $user_active -> first();
            Session::put('idCompany',$user_active -> idCompany);
            $roles = $user_active -> roles;
            Session::put('roles',$roles);
            $permissions = $roles -> pluck('permissions') -> flatten() -> unique('id')-> pluck('name');
            Session::put('permissions',$permissions);
            
            return response() -> json($permissions,200);
        }
        session()->invalidate();
        return response() -> json(['Usted no tiene un usuario activo para esta empresa'],404);
    }

}
