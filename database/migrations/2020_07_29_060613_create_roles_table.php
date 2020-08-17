<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->boolean('condicion')->default(1);
        });
        DB::table('roles')->insert(array('id' => '1', 'nombre' => 'Administrador', 'descripcion' => 'Administradores del hospital'));
        DB::table('roles')->insert(array('id' => '2', 'nombre' => 'Doctor', 'descripcion' => 'Doctor(a) del hospital'));
        DB::table('roles')->insert(array('id' => '3', 'nombre' => 'Enfermero', 'descripcion' => 'Enfermero(a) del hospital'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
