<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento_persona;

class Departamento_personaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $departamentos_personas = Departamento_persona::join('departamento','departamento.id','departamento_persona.id_departamento')
            ->join('persona','persona.id','departamento_persona.id_persona')
            ->select('departamento_persona.id','departamento_persona.id_departamento','departamento_persona.id_persona','departamento_persona.condicion','departamento.nombre as nombreDepartamento','persona.nombre as nombrePersona')
            ->orderBy('departamento_persona.id', 'desc')->paginate(6);
        }elseif ($criterio == 'id_persona') {
            $departamentos_personas =Departamento_persona::join('departamento','departamento.id','departamento_persona.id_departamento')
            ->join('persona','persona.id','departamento_persona.id_persona')
            ->select('departamento_persona.id','departamento_persona.id_departamento','departamento_persona.id_persona','departamento_persona.condicion','departamento.nombre as nombreDepartamento','persona.nombre as nombrePersona')
            ->where('persona.nombre', 'like', '%' . $buscar . '%')
            ->orderBy('departamento_persona.id', 'desc')->paginate(6);
        }elseif ($criterio == 'id_departamento') {
            $departamentos_personas =Departamento_persona::join('departamento','departamento.id','departamento_persona.id_departamento')
            ->join('persona','persona.id','departamento_persona.id_persona')
            ->select('departamento_persona.id','departamento_persona.id_departamento','departamento_persona.id_persona','departamento_persona.condicion','departamento.nombre as nombreDepartamento','persona.nombre as nombrePersona')
            ->where('departamento.nombre', 'like', '%' . $buscar . '%')
            ->orderBy('departamento_persona.id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $departamentos_personas->total(),
                'current_page' => $departamentos_personas->currentPage(),
                'per_page'     => $departamentos_personas->perPage(),
                'last_page'    => $departamentos_personas->lastPage(),
                'from'         => $departamentos_personas->firstItem(),
                'to'           => $departamentos_personas->lastItem(),
            ],
            'departamentos_personas' => $departamentos_personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $departamentos_persona = new Departamento_persona();
        $departamentos_persona->id_departamento = $request->id_departamento;
        $departamentos_persona->id_persona = $request->id_persona;
        $departamentos_persona->condicion = '1';
        $departamentos_persona->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $departamentos_persona = Departamento_persona::findOrFail($request->id);
        $departamentos_persona->id_departamento = $request->id_departamento;
        $departamentos_persona->id_persona = $request->id_persona;
        $departamentos_persona->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $departamentos_persona = Departamento_persona::findOrFail($request->id);
        $departamentos_persona->condicion = '0';
        $departamentos_persona->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $departamentos_persona = Departamento_persona::findOrFail($request->id);
        $departamentos_persona->condicion = '1';
        $departamentos_persona->save();
    }
}
