<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hora_entrada')->required();
            $table->time('hora_salida')->required();
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->boolean('condicion')->default(1);
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario');
    }
}
