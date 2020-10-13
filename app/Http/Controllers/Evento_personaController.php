<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento_persona;

class Evento_personaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $eventos_personas = Evento_persona::join('evento','evento.id','evento_persona.id_evento')
            ->join('persona','persona.id','evento_persona.id_persona')
            ->select('evento_persona.id','evento_persona.id_evento','evento_persona.id_persona','evento_persona.condicion','evento.nombre as nombreEvento','persona.nombre as nombrePersona')
            ->orderBy('evento_persona.id', 'desc')->paginate(6);
        }elseif ($criterio == 'id_persona') {
            $eventos_personas =Evento_persona::join('evento','evento.id','evento_persona.id_evento')
            ->join('persona','persona.id','evento_persona.id_persona')
            ->select('evento_persona.id','evento_persona.id_evento','evento_persona.id_persona','evento_persona.condicion','evento.nombre as nombreEvento','persona.nombre as nombrePersona')
            ->where('persona.nombre', 'like', '%' . $buscar . '%')
            ->orderBy('evento_persona.id', 'desc')->paginate(6);
        }elseif ($criterio == 'id_evento') {
            $eventos_personas =Evento_persona::join('evento','evento.id','evento_persona.id_evento')
            ->join('persona','persona.id','evento_persona.id_persona')
            ->select('evento_persona.id','evento_persona.id_evento','evento_persona.id_persona','evento_persona.condicion','evento.nombre as nombreEvento','persona.nombre as nombrePersona')
            ->where('evento.nombre', 'like', '%' . $buscar . '%')
            ->orderBy('evento_persona.id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $eventos_personas->total(),
                'current_page' => $eventos_personas->currentPage(),
                'per_page'     => $eventos_personas->perPage(),
                'last_page'    => $eventos_personas->lastPage(),
                'from'         => $eventos_personas->firstItem(),
                'to'           => $eventos_personas->lastItem(),
            ],
            'eventos_personas' => $eventos_personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $eventos_persona = new Evento_persona();
        $eventos_persona->id_evento = $request->id_evento;
        $eventos_persona->id_persona = $request->id_persona;
        $eventos_persona->condicion = '1';
        $eventos_persona->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $eventos_persona = Evento_persona::findOrFail($request->id);
        $eventos_persona->id_evento = $request->id_evento;
        $eventos_persona->id_persona = $request->id_persona;
        $eventos_persona->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $eventos_persona = Evento_persona::findOrFail($request->id);
        $eventos_persona->condicion = '0';
        $eventos_persona->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $eventos_persona = Evento_persona::findOrFail($request->id);
        $eventos_persona->condicion = '1';
        $eventos_persona->save();
    }
}
