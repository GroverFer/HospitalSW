<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'horario';
    protected $fillable = [
        'id', 'hora_entrada', 'hora_salida', 'fecha_inicio', 'fecha_fin', 'condicion', 'id_persona'
    ];
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_persona');
    }


}
