<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion')->unique();
            $table->string('nombre1');
            $table->string('nombre2');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->date('fechaNac');
            $table->string('direccion');
            $table->string('email');
            $table->string('telefonoFijo');
            $table->string('celular');
            $table->text('perfil');
            $table->char('sexo', 1);
            $table->char('rh', 5);
            $table->string('rutaFoto');

            $table->unsignedBigInteger('idTipoIdentificacion');
            $table->foreign('idTipoIdentificacion')->references('id')->on('tipoIdentificacion');

            $table->unsignedBigInteger('idCiudad');
            $table->foreign('idCiudad')->references('id')->on('ciudad');

            $table->unsignedBigInteger('idCiudadNac');
            $table->foreign('idCiudadNac')->references('id')->on('ciudad');

            $table->unsignedBigInteger('idCiudadUbicacion');
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
