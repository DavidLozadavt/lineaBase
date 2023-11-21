<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->create([
            'razonSocial' => "Virtual T"
        ]);

        Company::factory()->create([
            'razonSocial' => "Rápido Tambo",
            'rutaLogo' => '/default/rapido-tambo-logo.jpg'
        ]);

        Company::factory(10)->create();
    }
}
