<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50)->nullable();
            $table->string('descripcion',50)->nullable();
            $table->time('hora_entrada')->required();
            $table->time('hora_salida')->required();
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->string('latitud',50)->required();
            $table->string('longitud',50)->required();
            $table->boolean('condicion')->default(1);   
        });
        DB::table('evento')->insert(array('nombre' => 'Vacunacion contra la Sarampion', 'descripcion' => 'Vacunacion en el octavo anillo', 'hora_entrada' => '08:00:01','hora_salida' => '16:00:01','fecha_inicio' => '2020/10/10','fecha_fin' => '2020/10/12','latitud' => '-17.735443','longitud' => '-63.174154','condicion'=>'0'));
        DB::table('evento')->insert(array('nombre' => 'Campaña sobre el Covid', 'descripcion' => 'Esta campaña se hará en el primer anillo', 'hora_entrada' => '08:00:01','hora_salida' => '16:00:01','fecha_inicio' => '2020/10/13','fecha_fin' => '2020/10/15','latitud' => '-17.774831','longitud' => '-63.182238','condicion'=>'1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
