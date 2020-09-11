<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad_persona;

class Especialidad_personaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $especialidades_personas = Especialidad_persona::join('especialidad', 'especialidad_persona.id_especialidad', '=', 'especialidad.id')
                ->join('persona', 'especialidad_persona.id_persona', '=', 'persona.id')
                ->select('especialidad_persona.id', 'especialidad_persona.condicion', 'especialidad.nombre as Nespecialidad', 'persona.nombre as Npersona', 'especialidad_persona.id_persona', 'especialidad_persona.id_especialidad')
                ->orderBy('especialidad_persona.id', 'asc')->paginate(6);
        } elseif ($criterio == 'id_especialidad') {
            $especialidades_personas = Especialidad_persona::join('especialidad', 'especialidad_persona.id_especialidad', '=', 'especialidad.id')
                ->join('persona', 'especialidad_persona.id_persona', '=', 'persona.id')
                ->select('especialidad_persona.id', 'especialidad_persona.condicion', 'especialidad.nombre as Nespecialidad', 'persona.nombre as Npersona', 'especialidad_persona.id_persona', 'especialidad_persona.id_especialidad')
                ->where('especialidad.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('especialidad_persona.id', 'asc')->paginate(6);
        } elseif ($criterio == 'id_persona') {
            $especialidades_personas = Especialidad_persona::join('especialidad', 'especialidad_persona.id_especialidad', '=', 'especialidad.id')
                ->join('persona', 'especialidad_persona.id_persona', '=', 'persona.id')
                ->select('especialidad_persona.id', 'especialidad_persona.condicion', 'especialidad.nombre as Nespecialidad', 'persona.nombre as Npersona', 'especialidad_persona.id_persona', 'especialidad_persona.id_especialidad')
                ->where('persona.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('especialidad_persona.id', 'asc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $especialidades_personas->total(),
                'current_page' => $especialidades_personas->currentPage(),
                'per_page'     => $especialidades_personas->perPage(),
                'last_page'    => $especialidades_personas->lastPage(),
                'from'         => $especialidades_personas->firstItem(),
                'to'           => $especialidades_personas->lastItem(),
            ],
            'especialidades_personas' => $especialidades_personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $especialidad_persona = new Especialidad_persona();
        $especialidad_persona->id_especialidad  = $request->id_especialidad;
        $especialidad_persona->id_persona = $request->id_persona;
        $especialidad_persona->condicion = '1';
        $especialidad_persona->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $especialidad_persona = Especialidad_persona::findOrFail($request->id);
        $especialidad_persona->id_especialidad = $request->id_especialidad;
        $especialidad_persona->id_persona = $request->id_persona;
        $especialidad_persona->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especialidad_persona = Especialidad_persona::findOrFail($request->id);
        $especialidad_persona->condicion = '0';
        $especialidad_persona->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especialidad_persona = Especialidad_persona::findOrFail($request->id);
        $especialidad_persona->condicion = '1';
        $especialidad_persona->save();
    }
}
