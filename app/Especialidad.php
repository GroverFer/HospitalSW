<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    protected $fillable = ['nombre', 'descripcion', 'condicion'];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }
}
