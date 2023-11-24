<?php

namespace App\Util;

use App\Models\ActivationCompanyUser;
use App\Models\User;

class PolicyUtil
{

    /**
     * Verify user is admin
     *
     * @param User $user
     * @return boolean
     */
    public static function isAdmin(User $user, int $idEmpresa)
    {

        if ($idEmpresa != 1) {
            return false;
        }

        return ActivationCompanyUser::with(['roles.permissions'])
            ->byUser($user->id)
            ->where('company_id', $idEmpresa)
            ->active()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'ADMIN');
            })
            ->exists();
    }

    public static function hasPermission(User $user, int $idEmpresa, array $spected_permissions)
    {
        $active_user = ActivationCompanyUser::with(['roles.permissions'])
        ->byUser($user->id)
        ->where('company_id',$idEmpresa)
        ->active()
        ->whereHas('roles',function($rol) use ($spected_permissions){
            $rol->whereHas('permissions',function($permission) use ($spected_permissions){
                $permission->whereIn('name',$spected_permissions);
            });
        })->exists();
        return $active_user;
    }
}
