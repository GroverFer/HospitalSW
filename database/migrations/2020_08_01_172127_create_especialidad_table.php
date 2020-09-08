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
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        DB::table('especialidad')->insert(array('nombre' => 'Cardiología', 'descripcion' => 'Estudio, diagnóstico y tratamiento de las enfermedades del corazón y del aparato circulatorio del hospital', 'condicion' => '1'));
        DB::table('especialidad')->insert(array('nombre' => 'Endocrinología', 'descripcion' => 'estudia el sistema endocrino y las enfermedades provocadas por un funcionamiento inadecuado del mismo', 'condicion' => '1'));
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
