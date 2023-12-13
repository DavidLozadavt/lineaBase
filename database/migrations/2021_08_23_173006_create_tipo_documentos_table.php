<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoDocumento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tituloDocumento');
            $table->text('descripcion')->nullable();

            $table->unsignedInteger('idCompany');
            $table->foreign('idCompany')->references('id')->on('company');
            $table->timestamps();

            $table -> unique(['tituloDocumento','idCompany']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoDocumento');
    }
}
