<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeders/sql/departamentos.sql';
        DB::unprepared(file_get_contents($path));
        $path = 'database/seeders/sql/ciudades.sql';
        DB::unprepared(file_get_contents($path));
        $path = 'database/seeders/sql/estados.sql';
        DB::unprepared(file_get_contents($path));
        $path = 'database/seeders/sql/tipoIdentificacion.sql';
        DB::unprepared(file_get_contents($path));

        $path = 'database/seeders/sql/tipo_pago.sql';
        DB::unprepared(file_get_contents($path));

        $path = 'database/seeders/sql/tipo_transaccion.sql';
        DB::unprepared(file_get_contents($path));

        $path = 'database/seeders/sql/medio_pago.sql';
        DB::unprepared(file_get_contents($path));

        $path = 'database/seeders/sql/transaccion.sql';
        DB::unprepared(file_get_contents($path));

        $path = 'database/seeders/sql/pagos.sql';
        DB::unprepared(file_get_contents($path));

        $this->call(CompanySeeder::class);

        $path = 'database/seeders/sql/tipo_documento.sql';
        DB::unprepared(file_get_contents($path));

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        // $this->call(PersonSeeder::class);
    }
}
