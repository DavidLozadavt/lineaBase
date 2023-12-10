<?php

namespace Database\Seeders;

use App\Models\ActivationCompanyUser;
use App\Models\Persona;
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
        $vt->name = "ADMIN";
        $vt->idCompany = 1;
        $vt->save();

        $fub = new Role();
        $fub->name = "ADMIN";
        $fub->idCompany = 2;
        $fub->save();

        $vt->syncPermissions([
            PermissionConst::GESTION_ROL_PERMISOS,
            PermissionConst::GESTION_ROLES,
            PermissionConst::GESTION_TIPO_CONTRATO,
            PermissionConst::GESTION_USUARIO,
            PermissionConst::GESTION_PROCESOS,
            PermissionConst::GESTION_TIPO_CONTRATO,
            PermissionConst::GESTION_MEDIO_PAGO,
            PermissionConst::GESTION_TIPO_PAGO,
            PermissionConst::GESTION_TIPO_TRANSACCION,
            PermissionConst::GESTION_TIPO_DOCUMENTOS,
        ]);

        $fub->syncPermissions([
            PermissionConst::GESTION_ROL_PERMISOS,
            PermissionConst::GESTION_ROLES,
            PermissionConst::GESTION_TIPO_CONTRATO,
            PermissionConst::GESTION_USUARIO,
            PermissionConst::GESTION_PROCESOS
        ]);

        $emailAdmin = "admin@gmail.com";
        Persona::factory()
            ->hasUsuario(1, ['email' => $emailAdmin])
            ->create([
                'email' => $emailAdmin
            ]);


        $activation = ActivationCompanyUser::factory()->create([
            'idCompany' => 1,
            'idUser'    => 1,
            'idEstado'  => 1
        ]);

        $activation->assignRole($vt);

        $emailAdmin = "admin@fup.com";
        Persona::factory()
            ->hasUsuario(1, ['email' => $emailAdmin])
            ->create([
                'email' => $emailAdmin
            ]);

        $activation = ActivationCompanyUser::factory()->create([
            'idCompany' => 2,
            'idUser'    => 2,
            'idEstado'  => 1
        ]);

        $activation->assignRole($fub);
    }
}
