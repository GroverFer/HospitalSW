<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTipoEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cargo', 30)->unique();;
            $table->string('descripcion', 100)->nullable();
            $table->boolean('condicion')->default(1);

        });
        DB::table('tipo_empleado')->insert(array('cargo' => 'Medico', 'descripcion' => 'Doctores', 'condicion' => '1'));
        DB::table('tipo_empleado')->insert(array('cargo' => 'Enfermera', 'descripcion' => 'Asistentes de los Doctores', 'condicion' => '1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_empleado');
    }
}
