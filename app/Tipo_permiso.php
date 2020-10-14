<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_permiso extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tipo_permiso';
    protected $fillable = [
        'id','nombre', 'descripcion','condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function solicitud_permiso()
    {
        return $this->hasMany('App\Solicitud_permiso', 'id_tipopermiso', 'id');
    }
}
