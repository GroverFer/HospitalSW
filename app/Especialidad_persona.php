<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad_persona extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'especialidad_persona';
    protected $fillable = [
        'id', 'id_especialidad', 'id_persona', 'condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id', compact('id'))->first();
    }
    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad', 'id_especialidad');
    }
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_persona');
    }
}
