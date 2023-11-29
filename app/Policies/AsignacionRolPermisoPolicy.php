<?php

namespace App\Policies;

use App\Http\Controllers\gestion_rol\AsignacionRolPermiso;
use App\Models\User;
use App\Util\PolicyUtil;
use Illuminate\Auth\Access\HandlesAuthorization;

class AsignacionRolPermisoPolicy
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
    public function view(User $user, AsignacionRolPermiso $tipoTransaccion)
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
        return PolicyUtil::isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AsignacionRolPermiso $tipoTransaccion)
    {
        return PolicyUtil::isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AsignacionRolPermiso $tipoTransaccion)
    {
        return PolicyUtil::isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AsignacionRolPermiso $tipoTransaccion)
    {
        return PolicyUtil::isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AsignacionRolPermiso $tipoTransaccion)
    {
        return PolicyUtil::isAdmin();
    }
}
