<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEventoPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_persona', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->integer('id_evento')->unsigned();
            $table->foreign('id_evento')->references('id')->on('evento');
            $table->boolean('condicion')->default(1);
        });
        DB::table('evento_persona')->insert(array('id_persona' => '2', 'id_evento' => '1'));
        DB::table('evento_persona')->insert(array('id_persona' => '3', 'id_evento' => '1'));
        DB::table('evento_persona')->insert(array('id_persona' => '4', 'id_evento' => '1'));
        DB::table('evento_persona')->insert(array('id_persona' => '5', 'id_evento' => '1'));
        DB::table('evento_persona')->insert(array('id_persona' => '6', 'id_evento' => '1'));
        DB::table('evento_persona')->insert(array('id_persona' => '4', 'id_evento' => '2'));
        DB::table('evento_persona')->insert(array('id_persona' => '5', 'id_evento' => '2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_persona');
    }
}
