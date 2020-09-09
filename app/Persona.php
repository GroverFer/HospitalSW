<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'persona';
    protected $fillable = [
        'id','registro','nombre','apellido','ci','fecha_nac','genero','telefono','año_experiencia','tipo_sangre','email','foto','condicion','id_tipoempleado','id_usuario'
    ];
    public $timestamps = false;
    public static function find($id)
    {
        return static::where('id',compact('id'))->first();
    }
    public function usuario()
    {
        return $this->belongsTo('App\User', 'id_usuario');
    }
    public function tipo_empleado()
    {
        return $this->belongsTo('App\Tipo_empleado','id_tipoempleado');
    }
    public function especialidad_persona()
    {
        return $this->hasMany('App\Especialidad_persona', 'id_persona', 'id');
    }
    public function departamento_persona()
    {
        return $this->hasMany('App\Departamento_persona', 'id_persona', 'id');
    }
}
