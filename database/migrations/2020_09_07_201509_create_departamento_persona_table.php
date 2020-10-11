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
        DB::table('departamento_persona')->insert(array('id_persona' => '1', 'id_departamento' => '2'));
        DB::table('departamento_persona')->insert(array('id_persona' => '2', 'id_departamento' => '2'));
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
