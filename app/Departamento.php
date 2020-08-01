<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['nombre', 'descripcion', 'condicion'];

    public function especialidad()
    {
        return $this->hasMany('App\Especialidad');
    }
}
