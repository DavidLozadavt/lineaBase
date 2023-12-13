<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreProceso');
            $table->text('descripcion') -> nullable();

            $table->unsignedInteger('idCompany');
            $table->foreign('idCompany')->references('id')->on('company');
            $table->timestamps();

            $table -> unique(['nombreProceso','idCompany']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceso');
    }
}
