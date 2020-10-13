<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento_persona extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'evento_persona';
    protected $fillable = [
        'id', 'id_persona', 'id_evento','condicion'
    ];
    public $timestamps = false;
}
