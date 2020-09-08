<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'rol';
    protected $fillable = [
        'id','nombre','descripcion','condicion'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function user()
    {
        return $this->hasMany('App\User', 'id_usuario', 'id');
    }
}
