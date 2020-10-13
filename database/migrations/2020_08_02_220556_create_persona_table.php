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
        ,'email' => 'jose.mishael.chile@gmail.com','foto' => 'billgates.jpg', 'condicion' => '1','id_tipoempleado' => '1', 'id_usuario' => '1'));
        DB::table('persona')->insert(array('nombre' => 'Maria Guadalupe','apellido' => 'Flores Flores', 'ci' => '54261129'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'F','telefono' => '68488527', 'año_experiencia' => '1','tipo_sangre' => 'O+'
        ,'email' => 'maria.guadalupe.flores2@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '2', 'id_usuario' => '2'));

        DB::table('persona')->insert(array('nombre' => 'LUIS JHEFERSON','apellido' => 'ACOSTA DAVALOS', 'ci' => '13999254'
        ,'fecha_nac' => '1987-05-05', 'genero' => 'M','telefono' => '644879435', 'año_experiencia' => '5','tipo_sangre' => 'O+'
        ,'email' => 'luis.jhef@gmail.com','foto' => '111111.jpg', 'condicion' => '1','id_tipoempleado' => '1', 'id_usuario' => '3'));
        DB::table('persona')->insert(array('nombre' => 'MARCELO MARCOS','apellido' => 'ACURANA HUANCA', 'ci' => '6495054'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'M','telefono' => '77987132', 'año_experiencia' => '1','tipo_sangre' => 'O-'
        ,'email' => 'marcelin.marcos.acu@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '1', 'id_usuario' => '4'));
        DB::table('persona')->insert(array('nombre' => 'EDGAR','apellido' => 'AGUILERA PAZ', 'ci' => '5869170'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'M','telefono' => '67446589', 'año_experiencia' => '1','tipo_sangre' => 'AB-'
        ,'email' => 'edgar.aguilera@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '1', 'id_usuario' => '5'));
        DB::table('persona')->insert(array('nombre' => 'YORDY','apellido' => 'ALDERETE VALLEJOS', 'ci' => '9048383'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'M','telefono' => '74136698', 'año_experiencia' => '1','tipo_sangre' => 'O+'
        ,'email' => 'yorrdy.alderete@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '1', 'id_usuario' => '6'));
        DB::table('persona')->insert(array('nombre' => 'CRISTINA','apellido' => 'HUMACAYA ARIAS', 'ci' => '3901614'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'F','telefono' => '69946532', 'año_experiencia' => '1','tipo_sangre' => 'O+'
        ,'email' => 'christina.arias@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '2', 'id_usuario' => '7'));
        DB::table('persona')->insert(array('nombre' => 'MAX MARTIN','apellido' => 'MOREIRA BALDIVIEZO', 'ci' => '8150645'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'M','telefono' => '79657258', 'año_experiencia' => '1','tipo_sangre' => 'AB+'
        ,'email' => 'max.martin@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '2', 'id_usuario' => '8'));
        DB::table('persona')->insert(array('nombre' => 'ALVARO CRISTIAN','apellido' => 'MOREJON LUNA', 'ci' => '12823639'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'M','telefono' => '66689722', 'año_experiencia' => '1','tipo_sangre' => 'AB+'
        ,'email' => 'christian.morejon@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '2', 'id_usuario' => '9'));
        DB::table('persona')->insert(array('nombre' => 'FREDDY ENRIQUE','apellido' => 'ROCA BEJARANO', 'ci' => '4684937'
        ,'fecha_nac' => '1990-05-05', 'genero' => 'M','telefono' => '74628546', 'año_experiencia' => '1','tipo_sangre' => 'O+'
        ,'email' => 'freddy.roca@gmail.com','foto' => 'cristina-kirchner.jpg', 'condicion' => '1','id_tipoempleado' => '2', 'id_usuario' => '10'));
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
