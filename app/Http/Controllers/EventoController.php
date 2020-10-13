<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $eventos = Evento::orderBy('id', 'desc')->paginate(3);
        } else {
            $eventos = Evento::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }


        return [
            'pagination' => [
                'total'        => $eventos->total(),
                'current_page' => $eventos->currentPage(),
                'per_page'     => $eventos->perPage(),
                'last_page'    => $eventos->lastPage(),
                'from'         => $eventos->firstItem(),
                'to'           => $eventos->lastItem(),
            ],
            'eventos' => $eventos
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $evento = new Evento();
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->hora_entrada = $request->hora_entrada;
        $evento->hora_salida = $request->hora_salida;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->latitud;
        $evento->latitud = $request->hora_entrada;
        $evento->longitud = $request->longitud;
        $evento->condicion = '1';
        $evento->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $evento = Evento::findOrFail($request->id);
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->hora_entrada = $request->hora_entrada;
        $evento->hora_salida = $request->hora_salida;
        $evento->fecha_inicio = $request->fecha_inicio;
        $evento->fecha_fin = $request->latitud;
        $evento->latitud = $request->hora_entrada;
        $evento->longitud = $request->longitud;
        $evento->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $evento = Evento::findOrFail($request->id);
        $evento->condicion = '0';
        $evento->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $evento = Evento::findOrFail($request->id);
        $evento->condicion = '1';
        $evento->save();
    }

    public function selectEvento()
    {
        $eventos = Evento::where('condicion', '=', '1')
            ->select('id', 'nombre')
            ->orderBy('id', 'desc')->get();

        return ['eventos' => $eventos];
    }
}
