<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Especialidad;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
                ->select('especialidades.id', 'especialidades.nombre',  'especialidades.descripcion', 'departamentos.nombre')
                ->orderBy('especialidades.nombre', 'asc')->paginate(6);
        } else {
            $especialidades = Especialidad::join('departamentos', 'especialidades.iddep', '=', 'departamentos.id')
                ->join('roles', 'especialidades.idrol', '=', 'roles.id')
                ->select('especialidades.id', 'especialidades.nombre',  'especialidades.descripcion', 'departamentos.nombre')
                ->where('especialidades.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('especialidades.nombre', 'asc')->paginate(6);
        }

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
        $especialidad->nombre = $request->nombre;
        $especialidad->descripcion = $request->descripcion;
        $especialidad->condicion = '1';
        $especialidad->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $especialidad = Especialidad::findOrFail($request->id);
        $especialidad->usuario = $request->usuario;
        $especialidad->descripcion = bcrypt($request->descripcion);
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
