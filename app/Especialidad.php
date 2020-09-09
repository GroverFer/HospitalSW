<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'especialidad';
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function especialidad_persona()
    {
        return $this->hasMany('App\Especialidad_persona', 'id_especialidad', 'id');
    }
}
