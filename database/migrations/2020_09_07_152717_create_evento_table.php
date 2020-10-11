<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50)->nullable();
            $table->string('descripcion',50)->nullable();
            $table->time('hora_entrada')->required();
            $table->time('hora_salida')->required();
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->string('latitud',50)->required();
            $table->string('longitud',50)->required();
            $table->boolean('condicion')->default(1);   

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
