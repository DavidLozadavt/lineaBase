<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacionDiaJornada', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idJornada')->references('id')->on('jornada')->onDelete('cascade');
            $table->foreignId('idDia')->references('id')->on('dia')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_dia_jornadas');
    }
};
