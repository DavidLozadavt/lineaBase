<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use App\Permission\PermissionConst;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vt = new Role();
        $vt->name = "Admin";
        $vt->idCompany = 1;
        $vt->save();

        $rol1 = new Role();
        $rol1->name = "Admin";
        $rol1->idCompany = 2;
        $rol1->save();

        $vt->syncPermissions([
            PermissionConst::GESTION_ROL_PERMISOS,
            PermissionConst::GESTION_ROLES,
            PermissionConst::GESTION_TIPO_CONTRATO,
            PermissionConst::GESTION_USUARIO,
        ]);

        $rol1->syncPermissions([
            PermissionConst::GESTION_TIPO_CONTRATO,
            PermissionConst::GESTION_USUARIO,
        ]);

        $emailAdmin = "admin@gmail.com";
        Person::factory()
        ->hasUsuario(1, ['email' => $emailAdmin])
        ->create([
            'email' => $emailAdmin
        ]);

        $usuario = User::where('email', $emailAdmin)->first();
        $usuario->assignRole($vt);
    }
}
