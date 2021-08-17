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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idpersona');
            $table->foreign('idpersona')->references('id')->on('people');

            $table->unsignedBigInteger('idcompany');
            $table->foreign('idcompany')->references('id')->on('empresa');

            $table->unsignedBigInteger('idtipoContrato');
            $table->foreign('idtipoContrato')->references('id')->on('contract_types');

            $table->date('fechaContratacion');
            $table->date('fechaFinalContrato');

            $table->double('valorTotalContrato');
            $table->double('sueldo');
            $table->string('numeroContrato', 50);
            $table->text('objetoContrato');
            $table->text('observacion');
            $table->text('perfilProfesional');
            $table->char('otroSi', 1);

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
