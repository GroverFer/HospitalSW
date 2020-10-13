<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'evento';
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'hora_entrada', 'hora_salida', 'fecha_inicio', 'fecha_fin', 'latitud', 'longitud', 'condicion'
    ];
    public $timestamps = false;
}
