<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFallaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('falla', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha_hora')->required();
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
        });
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/05 08:10:00.59', 'id_persona' => '2'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/08 08:15:00.59', 'id_persona' => '2'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/10 08:30:00.59', 'id_persona' => '2'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/11 16:15:00.59', 'id_persona' => '3'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/05 08:07:08.59', 'id_persona' => '4'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/06 08:10:08.59', 'id_persona' => '5'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/10 08:04:08.59', 'id_persona' => '5'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/11 08:01:08.59', 'id_persona' => '5'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/12 08:00:15.59', 'id_persona' => '5'));
        DB::table('falla')->insert(array('fecha_hora' => '2020/10/01 08:11:08.59', 'id_persona' => '6'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('falla');
    }
}
