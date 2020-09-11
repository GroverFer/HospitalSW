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
            $table->integer('id_especialidad')->unsigned();
            $table->foreign('id_especialidad')->references('id')->on('especialidad');
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        DB::table('especialidad_persona')->insert(array('id_especialidad' => '1', 'id_persona' => '1'));
        DB::table('especialidad_persona')->insert(array('id_especialidad' => '2', 'id_persona' => '1'));
        DB::table('especialidad_persona')->insert(array('id_especialidad' => '2', 'id_persona' => '2'));
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