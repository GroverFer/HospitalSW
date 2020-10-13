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
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '3', 'id_persona' => '3'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '1', 'id_persona' => '3'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '4', 'id_persona' => '4'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '3', 'id_persona' => '5'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '5', 'id_persona' => '6'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '6', 'id_persona' => '6'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '7', 'id_persona' => '7'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '8', 'id_persona' => '8'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '4', 'id_persona' => '9'));
        DB::table('especialidad_persona')->insert(array('condicion' => '1', 'id_especialidad' => '5', 'id_persona' => '10'));
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
