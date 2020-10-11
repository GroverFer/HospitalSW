<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSolicitudPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_permiso', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->string('motivo',100)->required();
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->integer('id_tipopermiso')->unsigned();
            $table->foreign('id_tipopermiso')->references('id')->on('tipo_permiso');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_permiso');
    }
}
