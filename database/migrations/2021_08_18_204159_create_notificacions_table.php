<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->char('asunto', 50);
            $table->text('mensaje');
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('idUsuarioReceptor')->references('id')->on('usuario');
            $table->unsignedBigInteger('idUsuarioReceptor');
            $table->foreign('idUsuarioRemitente')->references('id')->on('usuario');
            $table->unsignedBigInteger('idUsuarioRemitente');
            $table->foreign('idTipoNotificacion')->references('id')->on('tipoNotificacion');
            $table->unsignedBigInteger('idTipoNotificacion');


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
        Schema::dropIfExists('notificacions');
    }
}
