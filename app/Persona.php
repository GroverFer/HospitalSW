<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre', 'apellido', 'fecha_nac', 'genero', 'tipo_sangre', 'telefono', 'ci', 'anio_experiencia', 'registro', 'estado'];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
