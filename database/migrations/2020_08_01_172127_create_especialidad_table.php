<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEspecialidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50)->unique();
            $table->string('descripcion')->nullable();
            $table->boolean('condicion')->default(1);

        });
        DB::table('especialidad')->insert(array('nombre' => 'Cardiología', 'descripcion' => 'Estudio, diagnóstico y tratamiento de las enfermedades del corazón y del aparato circulatorio del hospital', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Endocrinología', 'descripcion' => 'Estudia el sistema endocrino y las enfermedades provocadas por un funcionamiento inadecuado del mismo', 'condicion' => '1'));

        DB::table('especialidad')->insert(array('nombre' => 'Alergología', 'descripcion' => 'Especialización clínica que comprende el conocimiento, diagnóstico y tratamiento de la patología alergica producida por mecanismos inflamatorios e inmunológicos, especialmente de hipersensibilidad, con las técnicas que le son propias', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Epidemiología', 'descripcion' => 'Disciplina científica en el área de la medicina que estudia la distribución, frecuencia y factores determinantes de las enfermedades existentes en poblaciones humanas definidas', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Infectología', 'descripcion' => 'Especialidad médica que se encarga del estudio, la prevención, el diagnóstico y el tratamiento de las enfermedades producidas por agentes infecciosos', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Medicina forense', 'descripcion' => 'Rama de la medicina que aplica todos los conocimientos médicos y biológicos necesarios para la resolución de los problemas que plantea el Derecho', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Neumología', 'descripcion' => 'Especialidad médica encargada del estudio de las enfermedades del aparato respiratorio y centra su campo de actuación en el diagnóstico, tratamiento y prevención de las enfermedades del pulmón, la pleura y el mediastino.', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Psiquiatría', 'descripcion' => 'Especialidad médica dedicada al estudio de los trastornos mentales...', 'condicion' => '1'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidad');
    }
}
