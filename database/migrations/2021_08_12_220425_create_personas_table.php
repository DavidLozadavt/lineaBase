<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificacion');
            $table->string('nombre1');
            $table->string('nombre2')->nullable();
            $table->string('apellido1');
            $table->string('apellido2')->nullable();
            $table->date('fechaNac');
            $table->string('direccion');
            $table->string('email')->unique();
            $table->string('telefonoFijo');
            $table->string('celular');
            $table->text('perfil');
            $table->char('sexo', 1);
            $table->char('rh', 5);
            $table->string('rutaFoto');

            $table->unsignedInteger('idTipoIdentificacion');
            $table->foreign('idTipoIdentificacion')->references('id')->on('tipoIdentificacion');

            $table->unsignedInteger('idCiudadNac');
            $table->foreign('idCiudadNac')->references('id')->on('ciudad');

            $table->unsignedInteger('idCiudadUbicacion');
            $table->foreign('idCiudadUbicacion')->references('id')->on('ciudad');

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
        Schema::dropIfExists('people');
    }
}
