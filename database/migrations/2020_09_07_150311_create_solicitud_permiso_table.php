<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSolicitudPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_permiso', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->string('motivo',100)->required();
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->integer('id_tipopermiso')->unsigned();
            $table->foreign('id_tipopermiso')->references('id')->on('tipo_permiso');

        });
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/10/13', 'fecha_fin' => '2020/11/13', 'motivo' => 'Vacaciones','id_persona' => '1','id_tipopermiso' => '2'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/05/13', 'fecha_fin' => '2020/07/13', 'motivo' => 'Vacaciones','id_persona' => '2','id_tipopermiso' => '2'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/07/13', 'fecha_fin' => '2020/09/13', 'motivo' => 'Vacaciones','id_persona' => '3','id_tipopermiso' => '2'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/05/22', 'fecha_fin' => '2020/05/22', 'motivo' => 'Urgencia Personal','id_persona' => '4','id_tipopermiso' => '1'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/05/06', 'fecha_fin' => '2020/05/06', 'motivo' => 'Urgencia Personal','id_persona' => '5','id_tipopermiso' => '1'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/05/10', 'fecha_fin' => '2020/05/10', 'motivo' => 'Urgencia Personal','id_persona' => '6','id_tipopermiso' => '1'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/07/21', 'fecha_fin' => '2020/07/21', 'motivo' => 'Urgencia Personal','id_persona' => '7','id_tipopermiso' => '1'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/01/04', 'fecha_fin' => '2020/01/04', 'motivo' => 'Urgencia Personal','id_persona' => '8','id_tipopermiso' => '1'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/02/11', 'fecha_fin' => '2020/02/11', 'motivo' => 'Urgencia Personal','id_persona' => '9','id_tipopermiso' => '1'));
        DB::table('solicitud_permiso')->insert(array('fecha_inicio' => '2020/03/04', 'fecha_fin' => '2020/03/04', 'motivo' => 'Urgencia Personal','id_persona' => '10','id_tipopermiso' => '1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_permiso');
    }
}
