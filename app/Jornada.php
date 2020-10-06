<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'jornada';
    protected $fillable = [
        'id', 'hora_llegada', 'hora_salida', 'fecha_llegada', 'fecha_salida', 'id_persona'
    ];
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_persona');
    }
}
