<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jornada;

class JornadaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $jornadas = Jornada::join('persona', 'jornada.id_persona', '=', 'persona.id')
                ->select('jornada.id', 'jornada.fecha_llegada', 'jornada.fecha_salida', 'jornada.hora_llegada', 'jornada.hora_salida', 'jornada.id_persona', 'persona.nombre as Pnombre')
                ->orderBy('id', 'desc')->paginate(6);
        } elseif ($criterio == 'id_persona') {
            $jornadas = Jornada::join('persona', 'jornada.id_persona', '=', 'persona.id')
                ->select('jornada.id', 'jornada.fecha_llegada', 'jornada.fecha_salida', 'jornada.hora_llegada', 'jornada.hora_salida', 'jornada.id_persona', 'persona.nombre as Pnombre')->where('persona.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(6);
        } else {
            $jornadas = Jornada::join('persona', 'jornada.id_persona', '=', 'persona.id')
                ->select('jornada.id', 'jornada.fecha_llegada', 'jornada.fecha_salida', 'jornada.hora_llegada', 'jornada.hora_salida', 'jornada.id_persona', 'persona.nombre as Pnombre')->where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $jornadas->total(),
                'current_page' => $jornadas->currentPage(),
                'per_page'     => $jornadas->perPage(),
                'last_page'    => $jornadas->lastPage(),
                'from'         => $jornadas->firstItem(),
                'to'           => $jornadas->lastItem(),
            ],
            'jornadas' => $jornadas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $jornada = new Jornada();
        $jornada->hora_llegada = $request->hora_llegada;
        $jornada->hora_salida = $request->hora_salida;
        $jornada->fecha_llegada = $request->fecha_llegada;
        $jornada->fecha_salida = $request->fecha_salida;
        $jornada->id_persona = $request->id_persona;
        $jornada->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $jornada = Jornada::findOrFail($request->id);
        $jornada->hora_llegada = $request->hora_llegada;
        $jornada->hora_salida = $request->hora_salida;
        $jornada->fecha_llegada = $request->fecha_llegada;
        $jornada->fecha_salida = $request->fecha_salida;
        $jornada->id_persona = $request->id_persona;
        $jornada->save();
    }

    // public function desactivar(Request $request)
    // {
    //     if (!$request->ajax()) return redirect('/');
    //     $jornada = Jornada::findOrFail($request->id);
    //     $jornada->condicion = '0';
    //     $jornada->save();
    // }

    // public function activar(Request $request)
    // {
    //     if (!$request->ajax()) return redirect('/');
    //     $jornada = Jornada::findOrFail($request->id);
    //     $jornada->condicion = '1';
    //     $jornada->save();
    // }
}
