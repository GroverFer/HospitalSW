<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['iddepar','nombre', 'apellido', 'fecha_nac', 'genero', 'tipo_sangre', 'telefono', 'tipo_documento','num_documento','email', 'anio_experiencia', 'registro', 'foto','condicion'];

    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }
}
