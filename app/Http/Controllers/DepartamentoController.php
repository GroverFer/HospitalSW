<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $departamentos = Departamento::orderBy('id', 'desc')->paginate(6);
        } else {
            $departamentos = Departamento::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $departamentos->total(),
                'current_page' => $departamentos->currentPage(),
                'per_page'     => $departamentos->perPage(),
                'last_page'    => $departamentos->lastPage(),
                'from'         => $departamentos->firstItem(),
                'to'           => $departamentos->lastItem(),
            ],
            'departamentos' => $departamentos
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $departamento = new Departamento();
        $departamento->nombre = $request->nombre;
        $departamento->descripcion = $request->descripcion;
        $departamento->latitud = $request->latitud;
        $departamento->longitud = $request->longitud;
        $departamento->condicion = '1';
        $departamento->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $departamento = Departamento::findOrFail($request->id);
        $departamento->nombre = $request->nombre;
        $departamento->descripcion = $request->descripcion;
        $departamento->latitud = $request->latitud;
        $departamento->longitud = $request->longitud;
        $departamento->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $departamento = Departamento::findOrFail($request->id);
        $departamento->condicion = '0';
        $departamento->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $departamento = Departamento::findOrFail($request->id);
        $departamento->condicion = '1';
        $departamento->save();
    }

    public function selectDepartamento()
    {
        $departamentos = Departamento::where('condicion', '=', '1')
            ->select('id', 'nombre')
            ->orderBy('id', 'desc')->get();

        return ['departamentos' => $departamentos];
    }
}
