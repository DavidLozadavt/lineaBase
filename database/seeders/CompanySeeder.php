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
            'razonSocial' => "Virtual tecnology",
            'rutaLogo'    => '/default/vTLogo.png'
        ]);

        Company::factory()->create([
            'razonSocial' => "Fundacion universitaria de popayán",
            'rutaLogo'    => '/default/favicon_fup.png'
        ]);

    }
}
