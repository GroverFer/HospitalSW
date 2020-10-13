<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDepartamentoPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento_persona', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->integer('id_departamento')->unsigned();
            $table->foreign('id_departamento')->references('id')->on('departamento');
            $table->boolean('condicion')->default(1);  

        });
        DB::table('departamento_persona')->insert(array('id_persona' => '1', 'id_departamento' => '1'));
        DB::table('departamento_persona')->insert(array('id_persona' => '2', 'id_departamento' => '2'));
        DB::table('departamento_persona')->insert(array('id_persona' => '3', 'id_departamento' => '2'));
        DB::table('departamento_persona')->insert(array('id_persona' => '4', 'id_departamento' => '3'));
        DB::table('departamento_persona')->insert(array('id_persona' => '5', 'id_departamento' => '3'));
        DB::table('departamento_persona')->insert(array('id_persona' => '6', 'id_departamento' => '4'));
        DB::table('departamento_persona')->insert(array('id_persona' => '7', 'id_departamento' => '5'));
        DB::table('departamento_persona')->insert(array('id_persona' => '8', 'id_departamento' => '6'));
        DB::table('departamento_persona')->insert(array('id_persona' => '9', 'id_departamento' => '7'));
        DB::table('departamento_persona')->insert(array('id_persona' => '10', 'id_departamento' => '8'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamento_persona');
    }
}
