<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivationCompanyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activation_company_users', function (Blueprint $table) {
            $table->unsignedInteger('idUser');
            $table->foreign('idUser')->references('id')->on('user');
            $table->unsignedInteger('idEstado');
            $table->foreign('idEstado')->references('id')->on('estado');
            $table->unsignedInteger('idCompany');
            $table->foreign('idCompany')->references('id')->on('company');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->primary(['idUser','idCompany']);
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
        Schema::dropIfExists('activation_company_users');
    }
}
