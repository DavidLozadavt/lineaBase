<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaTransaccion');
            $table->time('hora');
            $table->double('numFacturaInicial');
            $table->double('valor');
            $table->unsignedInteger('idEstado');
            $table->foreign('idEstado')->references('id')->on('estado');
            $table->unsignedInteger('idTipoTransaccion');
            $table->foreign('idTipoTransaccion')->references('id')->on('tipoTransaccion');
            $table->unsignedInteger('idTipoPago');
            $table->foreign('idTipoPago')->references('id')->on('tipoPago');
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
        Schema::dropIfExists('transaccion');
    }
}
