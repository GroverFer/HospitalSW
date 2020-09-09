<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'departamento';
    protected $fillable = [
        'id','nombre', 'descripcion','latitud','longitud','condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function departamento_persona()
    {
        return $this->hasMany('App\Departamento_persona', 'id_departamento', 'id');
    }
}
