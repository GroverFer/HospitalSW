<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->required();
            $table->string('apellido', 100)->required();
            $table->string('ci', 30)->required();
            $table->date('fecha_nac')->required();
            $table->string('genero', 20)->required();
            $table->string('telefono', 20)->required();
            $table->integer('año_experiencia')->required();
            $table->string('tipo_sangre', 20)->required();
            $table->string('email', 50)->required();
            $table->string('foto', 100)->required();
            $table->boolean('condicion')->default(1);
            $table->integer('id_tipoempleado')->unsigned();
            $table->foreign('id_tipoempleado')->references('id')->on('tipo_empleado');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');

        });
        DB::table('persona')->insert(array('nombre' => 'Jose Mishael','apellido' => 'Chile Laime', 'ci' => '11374590'
        ,'fecha_nac' => '1998-09-07', 'genero' => 'M','telefono' => '71366663', 'año_experiencia' => '3','tipo_sangre' => 'O+'
        ,'email' => 'jose.mishael.chile@gmail.com','foto' => 'here', 'condicion' => '1','id_tipoempleado' => '1', 'id_usuario' => '1'));
        DB::table('persona')->insert(array('nombre' => 'Maria Guadalupe','apellido' => 'Flores Flores', 'ci' => '54261129'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'F','telefono' => '68488527', 'año_experiencia' => '1','tipo_sangre' => 'O+'
        ,'email' => 'maria.guadalupe.flores2@gmail.com','foto' => 'here', 'condicion' => '1','id_tipoempleado' => '2', 'id_usuario' => '2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
