<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razonSocial');
            $table->string('nit');
            $table->string('rutaLogo');
            $table->string('representanteLegal');
            $table->unsignedSmallInteger('digitoVerificacion');

            $table->unsignedInteger('idPrincipal')->nullable();
            $table->foreign('idPrincipal')->references('id')->on('company');

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
        Schema::dropIfExists('empresa');
    }
}
