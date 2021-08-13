<?php

namespace Database\Seeders;

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
        \App\Models\Company::factory()->create([
            'nombre' => "Virtual T"
        ]);

        \App\Models\Company::factory()->create([
            'nombre' => "Rápido Tambo"
        ]);

        \App\Models\Company::factory(10)->create();
    }
}
