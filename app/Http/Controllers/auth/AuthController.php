<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Util\KeyUtil;
use App\Util\QueryUtil;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        
        JWTAuth::setToken($token);
        $user = auth() -> user();

        $user_active = ActivationCompanyUser::with('company', 'roles.permissions')
            ->where(function ($query) {
                QueryUtil::whereUser($query);
                QueryUtil::whereActive($query);
            });

        if (!$user_active->exists()) {
            auth()->logout();
            return response()->json(['error' => 'usted no tiene un usuario activo', 401]);
        }
        $user_active = $user_active->first();
        $roles = $user_active->roles;
        $permissions = $roles->pluck('permissions')->flatten()->unique('id')->pluck('name');
        $token = JWTAuth::claims([
            'idCompany' => $user_active -> idCompany,
            'roles' => $roles->pluck('name'),
            'permissions' => $permissions
        ])->fromUser($user);
        $user = KeyUtil::user();
        $payload = JWTAuth::getPayload($token);

        return response()->json(['access_token' => $token, 'payload' => $payload,'user' => $user]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        $user = KeyUtil::user();
        return response()->json($user);
    }

    public function getActiveUsers()
    {
        return ActivationCompanyUser::with(['company'])
            ->where(function ($query) {
                QueryUtil::whereUser($query);
            })->get();
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getPermissions()
    {
        return KeyUtil::permissions();
    }

    public function getRoles()
    {
        $roles = KeyUtil::roles();
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

    public function setCompany()
    {

        $user = auth() -> user();
        $token = JWTAuth::getToken();
        if (!JWTAuth::check()) {
            return response()->json(['error' => 'Token no válido'], 401);
        }

        $user_active = ActivationCompanyUser::with('company', 'roles.permissions')
            ->where(function ($query) {
                QueryUtil::whereUser($query);
                QueryUtil::whereActive($query);
            });

        if (!$user_active->exists()) {
            auth()->logout();
            return response()->json(['error' => 'usted no tiene un usuario activo', 401]);
        }
        $user_active = $user_active->first();
        $roles = $user_active->roles;
        $permissions = $roles->pluck('permissions')->flatten()->unique('id')->pluck('name');
        $token = JWTAuth::claims([
            'idCompany' => $user_active -> idCompany,
            'roles' => $roles->pluck('name'),
            'permissions' => $permissions
        ])->fromUser($user);
        $user = KeyUtil::user();
        $payload = JWTAuth::getPayload($token);

        return response()->json(['new_token' => $token, 'payload' => $payload,'user' => $user]);
    }
}
