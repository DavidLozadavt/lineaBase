<?php

namespace App\Http\Controllers\gestion_rol;

use App\Http\Controllers\Controller;
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
  public function index()
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
  public function permissionsByRole(Request  $request)
  {

    $rol = $request->input('rol');

    $role = Role::findOrFail($rol);
    $groupsWithRoles = $role->getPermissionNames();


    return response()->json($groupsWithRoles);
  }

  /**
   * Assign functionality
   *
   * @param Request $request
   * @return void
   */
  public function assignFunctionality(Request $request)
  {

    $roles = Role::find($request->idRol);

    DB::table('role_has_permissions')
      ->where('role_id', $request->idRol)
      ->delete();

    $roles->syncPermissions($request->input('funciones', []));
    return $roles;
  }
}
