<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idpersona');
            $table->foreign('idpersona')->references('id')->on('people');

            $table->unsignedBigInteger('idempresa');
            $table->foreign('idempresa')->references('id')->on('empresa');

            $table->unsignedBigInteger('idtipoContrato');
            $table->foreign('idtipoContrato')->references('id')->on('tipoContrato');

            $table->date('fechaContratacion');
            $table->date('fechaFinalContrato');

            $table->double('valorTotalContrato');
            $table->double('sueldo');
            $table->string('numeroContrato', 50);
            $table->text('objetoContrato');
            $table->text('observacion');
            $table->text('perfilProfesional');
            $table->char('otrosi', 1);

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
        Schema::dropIfExists('contracts');
    }
}
