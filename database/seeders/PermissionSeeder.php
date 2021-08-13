<?php

namespace Database\Seeders;

use App\Permission\PermissionConst;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->savePermission(PermissionConst::GESTION_ROLES, "Gestión de roles");
        $this->savePermission(PermissionConst::GESTION_ROL_PERMISOS, "Gestión permisos del rol");
        $this->savePermission(PermissionConst::GESTION_USUARIO, "Gestión de usuarios");
        $this->savePermission(PermissionConst::GESTION_TIPO_CONTRATO, "Gestión de tipos de contrato");
    }

    private function savePermission($name, $description) {
        $permission = new Permission();
        $permission->name = $name;
        $permission->description = $description;
        $permission->save();
    }
}
