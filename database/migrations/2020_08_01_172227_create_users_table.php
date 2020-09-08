<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registro',50)->unique();
            $table->string('password',50)->required();
            $table->boolean('condicion')->default(1);
            $table->integer('id_rol')->unsigned();
            $table->foreign('id_rol')->references('id')->on('rol');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        DB::table('users')->insert(array('registro' => '216011965', 'password' => 'asd123','condicion' => '1', 'id_rol' => '1'));
        DB::table('users')->insert(array('registro' => '216011966', 'password' => 'asd1234','condicion' => '1', 'id_rol' => '2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
