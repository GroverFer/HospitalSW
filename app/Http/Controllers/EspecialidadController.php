<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $especialidades = Especialidad::orderBy('id', 'desc')->paginate(6);
        } else {
            $especialidades = Especialidad::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
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
        $especialidad->nombre = $request->nombre;
        $especialidad->descripcion = $request->descripcion;
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

    public function selectEspecialidad()
    {
        $especialidades = Especialidad::where('condicion', '=', '1')
            ->select('id', 'nombre')
            ->orderBy('id', 'desc')->get();

        return ['especialidades' => $especialidades];
    }
}
