<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $dia1 = new Dia();
    $dia1->dia = 'LUNES';
    $dia1->save();

    $dia2 = new Dia();
    $dia2->dia = 'MARTES';
    $dia2->save();

    $dia3 = new Dia();
    $dia3->dia = 'MIERCOLES';
    $dia3->save();

    $dia4 = new Dia();
    $dia4->dia = 'JUEVES';
    $dia4->save();

    $dia5 = new Dia();
    $dia5->dia = 'VIERNES';
    $dia5->save();

    $dia6 = new Dia();
    $dia6->dia = 'SABADO';
    $dia6->save();

    $dia7 = new Dia();
    $dia7->dia = 'DOMINGO';
    $dia7->save();
  }
}
