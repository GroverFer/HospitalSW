<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento_persona extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'departamento_persona';
    protected $fillable = [
        'id', 'id_departamento', 'id_persona','condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function departamento()
    {
        return $this->belongsTo('App\Departamento','id_departamento');
    }
    public function persona()
    {
        return $this->belongsTo('App\Persona','id_persona');
    }
}
