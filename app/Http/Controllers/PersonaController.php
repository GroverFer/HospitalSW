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
            $personas = Persona::orderBy('id', 'desc')->paginate(3);
        } else {
            $personas = Persona::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(3);
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
        $persona->iddepar = $request->iddepar;
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->genero = $request->genero;
        $persona->tipo_sangre = $request->tipo_sangre;
        $persona->telefono = $request->telefono;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->email = $request->email;
        $persona->anio_experiencia = $request->anio_experiencia;
        $persona->registro = $request->registro;
        $persona->foto = $request->foto;
        $persona->condicion = $request->condicion;

        $persona->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->iddepar = $request->iddepar;
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->genero = $request->genero;
        $persona->tipo_sangre = $request->tipo_sangre;
        $persona->telefono = $request->telefono;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->email = $request->email;
        $persona->anio_experiencia = $request->anio_experiencia;
        $persona->registro = $request->registro;
        $persona->foto = $request->foto;
        $persona->condicion = $request->condicion;
        $persona->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especialidad = Persona::findOrFail($request->id);
        $especialidad->condicion = '0';
        $especialidad->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especialidad = Persona::findOrFail($request->id);
        $especialidad->condicion = '1';
        $especialidad->save();
    }

    public function selectPersona(Request $request)
    {
        $personas = Persona::where('estado', '=', '1')
            ->select('id', 'nombre', 'apellido', 'num_documento')
            ->orderBy('apellido', 'des')->get();

        return ['personas' => $personas];
    }
}
