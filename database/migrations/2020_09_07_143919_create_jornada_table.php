<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateJornadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornada', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hora_llegada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');

        });
        DB::table('jornada')->insert(array('hora_llegada' => '00:00:00', 'hora_salida' => '08:10:01', 'fecha_llegada' => '2020/10/11','fecha_salida' => '2020/10/11','id_persona' => '1'));
        DB::table('jornada')->insert(array('hora_llegada' => '00:00:00', 'hora_salida' => '08:11:20', 'fecha_llegada' => '2020/10/12','fecha_salida' => '2020/10/12','id_persona' => '1'));
        DB::table('jornada')->insert(array('hora_llegada' => '00:00:00', 'hora_salida' => '08:15:10', 'fecha_llegada' => '2020/10/13','fecha_salida' => '2020/10/13','id_persona' => '1'));
        DB::table('jornada')->insert(array('hora_llegada' => '08:00:00', 'hora_salida' => '16:15:00', 'fecha_llegada' => '2020/10/11','fecha_salida' => '2020/10/11','id_persona' => '2'));
        DB::table('jornada')->insert(array('hora_llegada' => '07:50:54', 'hora_salida' => '16:21:30', 'fecha_llegada' => '2020/10/12','fecha_salida' => '2020/10/12','id_persona' => '2'));
        DB::table('jornada')->insert(array('hora_llegada' => '15:58:00', 'hora_salida' => '00:10:01', 'fecha_llegada' => '2020/10/11','fecha_salida' => '2020/10/12','id_persona' => '3'));
        DB::table('jornada')->insert(array('hora_llegada' => '16:00:00', 'hora_salida' => '00:11:20', 'fecha_llegada' => '2020/10/12','fecha_salida' => '2020/10/13','id_persona' => '3'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jornada');
    }
}
