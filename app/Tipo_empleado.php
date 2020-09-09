<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_empleado extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tipo_empleado';
    protected $fillable = [
        'id', 'cargo', 'descripcion', 'condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function persona()
    {
        return $this->hasMany('App\Persona', 'id_tipoempleado', 'id');
    }
}
