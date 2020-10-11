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
        DB::table('departamento')->insert(array('nombre' => 'Bioquimica', 'descripcion' => 'Estudia la composición química de los seres vivos, especialmente las proteínas...','latitud' => '0000','longitud' => '0000','condicion' => '1'));
        DB::table('departamento')->insert(array('nombre' => 'Fisiologia', 'descripcion' => 'Estudia las funciones de los seres vivos...','latitud' => '0000','longitud' => '0000','condicion' => '1'));
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
