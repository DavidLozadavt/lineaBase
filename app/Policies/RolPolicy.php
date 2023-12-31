<?php

namespace App\Policies;

use App\Models\Rol;
use App\Models\User;
use App\Util\PolicyUtil;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user)
  {
    //
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\TipoTransaccion  $tipoTransaccion
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Rol $rol)
  {
    //
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user)
  {
    $permissions = [
      'GESTION_ROLES'
    ];
    return PolicyUtil::isAdmin() || PolicyUtil::hasPermission($permissions);
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\TipoTransaccion  $tipoTransaccion
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Rol $rol)
  {
    $permissions = [
      'GESTION_ROLES'
    ];
    return PolicyUtil::isAdmin() || PolicyUtil::hasPermission($permissions);
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\TipoTransaccion  $tipoTransaccion
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Rol $rol)
  {
    $permissions = [
      'GESTION_ROLES'
    ];
    return PolicyUtil::isAdmin() || PolicyUtil::hasPermission($permissions);
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\TipoTransaccion  $tipoTransaccion
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function restore(User $user, Rol $rol)
  {
    $permissions = [
      'GESTION_ROLES'
    ];
    return PolicyUtil::isAdmin() || PolicyUtil::hasPermission($permissions);
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\TipoTransaccion  $tipoTransaccion
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function forceDelete(User $user, Rol $rol)
  {
    $permissions = [
      'GESTION_ROLES'
    ];
    return PolicyUtil::isAdmin() || PolicyUtil::hasPermission($permissions);
  }
}
