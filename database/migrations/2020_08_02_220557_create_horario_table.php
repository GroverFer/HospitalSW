<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hora_entrada')->required();
            $table->time('hora_salida')->required();
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->boolean('condicion')->default(1);
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
        });
        DB::table('horario')->insert(array('hora_entrada' => '00:00:01', 'hora_salida' => '08:00:01', 'fecha_inicio' => '2010/01/01','fecha_fin' => '2030/01/01','id_persona' => '1'));
        DB::table('horario')->insert(array('hora_entrada' => '08:00:01', 'hora_salida' => '18:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '2'));
        DB::table('horario')->insert(array('hora_entrada' => '16:00:01', 'hora_salida' => '23:59:59', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '3'));
        DB::table('horario')->insert(array('hora_entrada' => '08:00:01', 'hora_salida' => '16:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '4'));
        DB::table('horario')->insert(array('hora_entrada' => '08:00:01', 'hora_salida' => '16:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '5'));
        DB::table('horario')->insert(array('hora_entrada' => '08:00:01', 'hora_salida' => '16:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '6'));
        DB::table('horario')->insert(array('hora_entrada' => '08:00:01', 'hora_salida' => '16:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '7'));
        DB::table('horario')->insert(array('hora_entrada' => '16:00:01', 'hora_salida' => '23:59:59', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '8'));
        DB::table('horario')->insert(array('hora_entrada' => '08:00:01', 'hora_salida' => '16:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '9'));
        DB::table('horario')->insert(array('hora_entrada' => '00:00:01', 'hora_salida' => '08:00:01', 'fecha_inicio' => '2019/01/01','fecha_fin' => '2021/01/01','id_persona' => '10'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario');
    }
}
