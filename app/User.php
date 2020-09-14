<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = [
        'id', 'registro', 'password', 'condicion', 'id_rol'
    ];
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function find($id)
    {
        return static::where('id', compact('id'))->first();
    }
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'id_rol');
    }
    public function persona()
    {
        return $this->hasOne('App\Persona', 'id_usuario', 'id');
    }
}
