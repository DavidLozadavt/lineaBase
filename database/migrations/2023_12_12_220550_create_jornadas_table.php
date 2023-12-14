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
        Schema::create('jornada', function (Blueprint $table) {
            $table->id();
            $table->string('nombreJornada');
            $table->text('descripcion')->nullable();
            $table->time('horaInicial');
            $table->time('horaFinal');
            $table->time('numeroHoras');
            $table->unsignedInteger('idCompany');
            $table->foreign('idCompany')->references('id')->on('company');
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
        Schema::dropIfExists('jornadas');
    }
};
