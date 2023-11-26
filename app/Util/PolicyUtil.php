<?php

namespace App\Util;

use Illuminate\Support\Facades\Session;

class PolicyUtil
{

    /**
     * Verify user is admin
     *
     * @param User $user
     * @return boolean
     */
    public static function isAdmin()
    {
        $idCompany = Session::get('idCompany');

        if ($idCompany != 1) {
            return false;
        }

        return Session::get('roles')
            ->where('idCompany', $idCompany)
            ->where('name','Admin')
            ->contains('name', 'Admin');
    }

    public static function hasPermission(array $expected_permissions)
    {
        $permissions = Session::get('permissions');

        return collect($expected_permissions)
            ->intersect($permissions->pluck('name'))
            ->isNotEmpty();
    }
}
