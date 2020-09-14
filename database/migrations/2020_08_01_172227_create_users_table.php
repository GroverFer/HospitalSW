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
            $table->string('registro', 50)->unique();
            $table->string('password', 200)->required();
            $table->boolean('condicion')->default(1);
            $table->integer('id_rol')->unsigned();
            $table->foreign('id_rol')->references('id')->on('rol');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        DB::table('users')->insert(array('registro' => '9783371', 'password' => '$2y$10$cpK6TwP2GwtMxs1qW7ojq.T4U6P2VN5CsVTniPwA3f/.FfT3F8WU.', 'condicion' => '1', 'id_rol' => '1'));
        DB::table('users')->insert(array('registro' => '216011966', 'password' => 'asd1234', 'condicion' => '1', 'id_rol' => '2'));
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
