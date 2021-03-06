<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_permiso;


class Tipo_permisoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $tipo_permisos = Tipo_permiso::orderBy('id', 'desc')->paginate(6);
        } else {
            $tipo_permisos = Tipo_permiso::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $tipo_permisos->total(),
                'current_page' => $tipo_permisos->currentPage(),
                'per_page'     => $tipo_permisos->perPage(),
                'last_page'    => $tipo_permisos->lastPage(),
                'from'         => $tipo_permisos->firstItem(),
                'to'           => $tipo_permisos->lastItem(),
            ],
            'tipo_permisos' => $tipo_permisos
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipo_permisos = new Tipo_permiso();
        $tipo_permisos->nombre = $request->nombre;
        $tipo_permisos->descripcion = $request->descripcion;
        $tipo_permisos->condicion = '1';
        $tipo_permisos->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipo_permisos = Tipo_permiso::findOrFail($request->id);
        $tipo_permisos->nombre = $request->nombre;
        $tipo_permisos->descripcion = $request->descripcion;
        $tipo_permisos->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipo_permisos = Tipo_permiso::findOrFail($request->id);
        $tipo_permisos->condicion = '0';
        $tipo_permisos->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipo_permisos = Tipo_permiso::findOrFail($request->id);
        $tipo_permisos->condicion = '1';
        $tipo_permisos->save();
    }

    public function selectTipo_permiso()
    {
        $tipo_permisos = Tipo_permiso::where('condicion', '=', '1')
            ->select('id', 'nombre')
            ->orderBy('id', 'desc')->get();

        return ['tipo_permisos' => $tipo_permisos];
    }
}
