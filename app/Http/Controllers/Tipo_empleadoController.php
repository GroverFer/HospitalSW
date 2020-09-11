<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_empleado;

class Tipo_empleadoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $tipo_empleados = Tipo_empleado::orderBy('id', 'desc')->paginate(6);
        } else {
            $tipo_empleados = Tipo_empleado::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $tipo_empleados->total(),
                'current_page' => $tipo_empleados->currentPage(),
                'per_page'     => $tipo_empleados->perPage(),
                'last_page'    => $tipo_empleados->lastPage(),
                'from'         => $tipo_empleados->firstItem(),
                'to'           => $tipo_empleados->lastItem(),
            ],
            'tipo_empleados' => $tipo_empleados
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipo_empleado = new Tipo_empleado();
        $tipo_empleado->cargo = $request->cargo;
        $tipo_empleado->descripcion = $request->descripcion;
        $tipo_empleado->condicion = '1';
        $tipo_empleado->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipo_empleado = Tipo_empleado::findOrFail($request->id);
        $tipo_empleado->cargo = $request->cargo;
        $tipo_empleado->descripcion = $request->descripcion;
        $tipo_empleado->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipo_empleado = Tipo_empleado::findOrFail($request->id);
        $tipo_empleado->condicion = '0';
        $tipo_empleado->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipo_empleado = Tipo_empleado::findOrFail($request->id);
        $tipo_empleado->condicion = '1';
        $tipo_empleado->save();
    }

    public function selectTipo_empleado()
    {
        $tipos_empleados = Tipo_empleado::where('condicion', '=', '1')
            ->select('id', 'cargo')
            ->orderBy('id', 'desc')->get();

        return ['tipos_empleados' => $tipos_empleados];
    }
}
