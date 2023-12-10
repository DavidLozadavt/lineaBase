<?php

namespace App\Http\Controllers\gestion_rol;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AsignacionRolPermiso extends Controller
{

  /**
   * Get all permissions
   *
   * @return void
   */
  public function index(): JsonResponse
  {
    $permisos = Permission::All();

    return response()->json($permisos);
  }

  /**
   * Assign permission by role
   *
   * @param Request $request
   * @return void
   */
  public function permissionsByRole(Request  $request): JsonResponse
  {
    try {
      $rol = $request->input('rol');
      $role = Role::findOrFail($rol);
      $groupsWithRoles = $role->getPermissionNames();
      return response()->json($groupsWithRoles);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Assign functionality
   *
   * @param Request $request
   * @return void
   */
  public function assignFunctionality(Request $request): JsonResponse
  {
    try {
      $this->authorize('create', AsignacionRolPermiso::class);
      $roles = Role::find($request->idRol);

      DB::table('role_has_permissions')
        ->where('role_id', $request->idRol)
        ->delete();

      $roles->syncPermissions($request->input('funciones', []));
      return response()->json($roles, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Assign roles
   *
   * @param Request $request
   * @return void
   */
  public function asignation(Request $request): JsonResponse
  {
    try {
      $this->authorize('create', AsignacionRolPermiso::class);
      DB::table('model_has_roles')
        ->where('model_id', $request->idActivation)
        ->delete();
      $user = ActivationCompanyUser::find($request->input('idActivation'));
      $user->assignRole($request->input('roles', []));
      return response()->json($user, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
