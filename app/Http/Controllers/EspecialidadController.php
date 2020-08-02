<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\Departamento;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
                ->select('especialidades.id', 'especialidades.nombre', 'especialidades.descripcion', 'departamentos.nombre as depa', 'especialidades.condicion', 'especialidades.iddep')
                ->orderBy('especialidades.nombre', 'asc')->paginate(6);
        } elseif ($criterio == 'iddep') {
            $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
                ->select('especialidades.id', 'especialidades.nombre', 'especialidades.descripcion', 'departamentos.nombre as depa', 'especialidades.condicion', 'especialidades.iddep')
                ->where('departamentos.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('especialidades.nombre', 'asc')->paginate(6);
        } else {
            $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
                ->select('especialidades.id', 'especialidades.nombre', 'especialidades.descripcion', 'departamentos.nombre as depa', 'especialidades.condicion', 'especialidades.iddep')
                ->where('especialidades.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('especialidades.nombre', 'asc')->paginate(6);
        }

        // if ($buscar == '') {
        //     $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
        //         ->select('especialidades.id', 'especialidades.nombre', 'especialidades.descripcion', 'departamentos.nombre as depa', 'especialidades.condicion', 'especialidades.iddep')
        //         ->orderBy('especialidades.nombre', 'asc')->paginate(6);
        // } else {
        //     $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
        //         ->select('especialidades.id', 'especialidades.nombre as nombre', 'especialidades.descripcion', 'departamentos.nombre as depa', 'especialidades.condicion', 'especialidades.iddep')
        //         ->where('especialidades.' . $criterio, 'like', '%' . $buscar . '%')
        //         ->orderBy('especialidades.nombre', 'asc')->paginate(6);
        // }

        return [
            'pagination' => [
                'total'        => $especialidades->total(),
                'current_page' => $especialidades->currentPage(),
                'per_page'     => $especialidades->perPage(),
                'last_page'    => $especialidades->lastPage(),
                'from'         => $especialidades->firstItem(),
                'to'           => $especialidades->lastItem(),
            ],
            'especialidades' => $especialidades
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $especialidad = new Especialidad();
        $especialidad->iddep = $request->iddep;
        $especialidad->nombre = $request->nombre;
        $especialidad->descripcion = $request->descripcion;
        $especialidad->condicion = '1';
        $especialidad->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $especialidad = Especialidad::findOrFail($request->id);
        $especialidad->iddep = $request->iddep;
        $especialidad->nombre = $request->nombre;
        $especialidad->descripcion = $request->descripcion;
        $especialidad->condicion = '1';
        $especialidad->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especialidad = Especialidad::findOrFail($request->id);
        $especialidad->condicion = '0';
        $especialidad->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $especialidad = Especialidad::findOrFail($request->id);
        $especialidad->condicion = '1';
        $especialidad->save();
    }
}
