<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionProcesoTipoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacionProcesoTipoDocumento', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('idProceso');
            $table ->foreign('idProceso')->references('id')->on('proceso');
            $table->unsignedInteger('idTipoDocumento');
            $table->foreign('idTipoDocumento')->references('id')->on('tipoDocumento');
            $table->unique(['idProceso','idTipoDocumento']);
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
        Schema::dropIfExists('asignacion_proceso_tipo_documentos');
    }
}
