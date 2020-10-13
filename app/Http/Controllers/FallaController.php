<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Falla;

class FallaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $fallas = Falla::join('persona', 'falla.id_persona', '=', 'persona.id')
                ->select('falla.id', 'falla.fecha_hora', 'falla.id_persona', 'persona.nombre as Pnombre')
                ->orderBy('id', 'desc')->paginate(6);
        } elseif ($criterio == 'id_persona') {
            $fallas = Falla::join('persona', 'falla.id_persona', '=', 'persona.id')
                ->select('falla.id', 'falla.fecha_hora', 'falla.id_persona', 'persona.nombre as Pnombre')->where('persona.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(6);
        } else {
            $fallas = Falla::join('persona', 'falla.id_persona', '=', 'persona.id')
                ->select('falla.id', 'falla.fecha_hora', 'falla.id_persona', 'persona.nombre as Pnombre')->where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $fallas->total(),
                'current_page' => $fallas->currentPage(),
                'per_page'     => $fallas->perPage(),
                'last_page'    => $fallas->lastPage(),
                'from'         => $fallas->firstItem(),
                'to'           => $fallas->lastItem(),
            ],
            'fallas' => $fallas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $jornada = new Falla();
        $jornada->fecha_hora = $request->fecha_hora;
        $jornada->id_persona = $request->id_persona;
        $jornada->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $jornada = Falla::findOrFail($request->id);
        $jornada->fecha_hora = $request->fecha_hora;
        $jornada->id_persona = $request->id_persona;
        $jornada->save();
    }
}
