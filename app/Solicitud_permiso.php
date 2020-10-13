<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud_permiso extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'solicitud_permiso';
    protected $fillable = [
        'id', 'fecha_inicio', 'fecha_fin','motivo','id_persona','id_tipopermiso'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function departamento()
    {
        return $this->belongsTo('App\Tipo_permiso','id_tipopermiso');
    }
    public function persona()
    {
        return $this->belongsTo('App\Persona','id_persona');
    }
}
