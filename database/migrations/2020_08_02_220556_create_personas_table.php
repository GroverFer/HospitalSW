<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iddepar')->unsigned();
            $table->foreign('iddepar')->references('id')->on('departamentos')->onDelete('cascade');
            $table->string('nombre', 100)->required();
            $table->string('apellido', 100)->required();
            $table->date('fecha_nac')->required();
            $table->string('genero', 20)->required();
            $table->string('tipo_sangre', 20)->required();
            $table->string('telefono', 20)->required();
            $table->string('tipo_documento', 20)->required();
            $table->string('num_documento', 20)->required();
            $table->string('email', 50)->required();
            $table->integer('anio_experiencia')->required();
            $table->integer('registro')->required();
            $table->string('foto', 100)->required();
            $table->boolean('condicion')->default(1);
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
        Schema::dropIfExists('personas');
    }
}
