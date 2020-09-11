<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $personas = Persona::join('tipo_empleado','tipo_empleado.id','persona.id_tipoempleado')
            ->join('users','users.id','persona.id_usuario')
            ->select('persona.id','persona.nombre','persona.apellido','persona.ci','persona.fecha_nac','persona.genero','persona.telefono','persona.año_experiencia','persona.tipo_sangre','persona.email','persona.foto','persona.condicion','persona.id_tipoempleado','persona.id_usuario','tipo_empleado.cargo as cargo','users.registro as registro')
            ->orderBy('persona.id', 'desc')->paginate(6);
        }else if ($criterio == 'id_tipoempleado') {
            $personas = Persona::join('tipo_empleado','tipo_empleado.id','persona.id_tipoempleado')
            ->join('users','users.id','persona.id_usuario')
            ->select('persona.id','persona.nombre','persona.apellido','persona.ci','persona.fecha_nac','persona.genero','persona.telefono','persona.año_experiencia','persona.tipo_sangre','persona.email','persona.foto','persona.condicion','persona.id_tipoempleado','persona.id_usuario','tipo_empleado.cargo as cargo','users.registro as registro')
            ->where('tipo_empleado.cargo', 'like', '%' . $buscar . '%')
            ->orderBy('persona.id', 'desc')->paginate(6); 
        }else if ($criterio == 'id_usuario') {
            $personas = Persona::join('tipo_empleado','tipo_empleado.id','persona.id_tipoempleado')
            ->join('users','users.id','persona.id_usuario')
            ->select('persona.id','persona.nombre','persona.apellido','persona.ci','persona.fecha_nac','persona.genero','persona.telefono','persona.año_experiencia','persona.tipo_sangre','persona.email','persona.foto','persona.condicion','persona.id_tipoempleado','persona.id_usuario','tipo_empleado.cargo as cargo','users.registro as registro')
            ->where('users.registro', 'like', '%' . $buscar . '%')
            ->orderBy('persona.id', 'desc')->paginate(6); 
        } else {
            $personas = Persona::join('tipo_empleado','tipo_empleado.id','persona.id_tipoempleado')
            ->join('users','users.id','persona.id_usuario')
            ->select('persona.id','persona.nombre','persona.apellido','persona.ci','persona.fecha_nac','persona.genero','persona.telefono','persona.año_experiencia','persona.tipo_sangre','persona.email','persona.foto','persona.condicion','persona.id_tipoempleado','persona.id_usuario','tipo_empleado.cargo as cargo','users.registro as registro')
            ->where($criterio, 'like', '%' . $buscar . '%')->orderBy('persona.id', 'desc')->paginate(6);
        }


        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->ci = $request->ci;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->genero = $request->genero;
        $persona->telefono = $request->telefono;
        $persona->año_experiencia = $request->año_experiencia;
        $persona->tipo_sangre = $request->tipo_sangre;
        $persona->email = $request->email;
        $persona->foto = $request->foto;
        $persona->id_tipoempleado = $request->id_tipoempleado;
        $persona->id_usuario = $request->id_usuario;
        $persona->condicion = '1';
        $persona->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->ci = $request->ci;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->genero = $request->genero;
        $persona->telefono = $request->telefono;
        $persona->año_experiencia = $request->año_experiencia;
        $persona->tipo_sangre = $request->tipo_sangre;
        $persona->email = $request->email;
        $persona->foto = $request->foto;
        $persona->id_tipoempleado = $request->id_tipoempleado;
        $persona->id_usuario = $request->id_usuario;
        $persona->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->condicion = '0';
        $persona->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->condicion = '1';
        $persona->save();
    }

    public function selectPersona()
    {
        $personas = Persona::where('condicion', '=', '1')
            ->select('id', 'nombre', 'apellido')
            ->orderBy('id', 'desc')->get();

        return ['personas' => $personas];
    }
}
