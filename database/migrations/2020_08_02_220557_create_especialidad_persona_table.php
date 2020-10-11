<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEspecialidadPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidad_persona', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('condicion')->default(1);
            $table->integer('id_especialidad')->unsigned();
            $table->foreign('id_especialidad')->references('id')->on('especialidad');
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');

        });
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '1', 'id_persona' => '1'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '2', 'id_persona' => '1'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '2', 'id_persona' => '2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidad_persona');
    }
}
