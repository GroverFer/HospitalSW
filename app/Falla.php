<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Falla extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'falla';
    protected $fillable = [
        'id', 'fecha_hora', 'id_persona'
    ];
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_persona');
    }
}
