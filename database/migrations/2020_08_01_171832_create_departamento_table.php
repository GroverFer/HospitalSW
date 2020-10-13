<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->string('latitud',50)->required();
            $table->string('longitud',50)->required();
            $table->boolean('condicion')->default(1);          
        });
        DB::table('departamento')->insert(array('nombre' => 'Medicina', 'descripcion' => 'Es el órgano operativo final, encargado de la atención integral del adulto, en el área de la medicina interna y sus especialidades...','latitud' => '-17.291739','longitud' => '-63.847061','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Cirugia', 'descripcion' => 'Área donde se otorga atención al paciente que requiere de una intervención quirúrgica...','latitud' => '-17.292291','longitud' => '-63.847899','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Enfermeria', 'descripcion' => 'Es la estructura organizativa que tiene la responsabilidad de administrar la enfermería en todos los niveles de atención...','latitud' => '-17.293022','longitud' => '-63.847807','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Urgencias', 'descripcion' => 'Departamento de atención primaria o sección de un hospital que ofrece un tratamiento inicial de pacientes con un amplio espectro de enfermedades y lesiones...','latitud' => '-17.293545','longitud' => ' -63.847746','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Area Programatica', 'descripcion' => 'Es la forma de organización del Subsistema Público de Salud, para desarrollar la estrategia de atención primaria de la salud, pensándola como la puerta de entrada al sistema de salud de la comunidad...','latitud' => '-17.293409','longitud' => '-63.849171','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Diagnostico y Tratamiento', 'descripcion' => 'Es el departamento por el cual se identifica una enfermedad, entidad nosológica, síndrome, o cualquier estado de salud o enfermedad...','latitud' => '-17.292366','longitud' => '-63.849195','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Consultorios Externos', 'descripcion' => 'Este departamento se encarga de las consultorias o ambitos legales','latitud' => '-17.292315','longitud' => '-63.850246','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Tecnico', 'descripcion' => 'En progreso...','latitud' => '-17.290922','longitud' => '-63.851297','condicion' => '1'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamento');
    }
}
