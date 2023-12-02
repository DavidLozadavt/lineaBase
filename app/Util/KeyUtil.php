<?php

namespace App\Util;

use App\Models\ActivationCompanyUser;

class KeyUtil
{


    public static function idCompany()
    {
        $user_active = ActivationCompanyUser::with('company', 'roles.permissions')
            ->where(function ($query) {
                QueryUtil::whereUser($query);
                QueryUtil::whereActive($query);
            }) -> first(['idCompany']);
        
        return $user_active -> idCompany;
    }
}
