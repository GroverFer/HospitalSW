<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;

class HorarioController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $horarios = Horario::join('persona', 'horario.id_persona', '=', 'persona.id')
                ->select('horario.id', 'horario.fecha_inicio', 'horario.fecha_fin', 'horario.hora_entrada', 'hora_salida', 'horario.condicion', 'horario.id_persona', 'persona.nombre as Pnombre')
                ->orderBy('id', 'desc')->paginate(6);
        } elseif ($criterio == 'id_persona') {
            $horarios = Horario::join('persona', 'horario.id_persona', '=', 'persona.id')
                ->select('horario.id', 'horario.fecha_inicio', 'horario.fecha_fin', 'horario.hora_entrada', 'hora_salida', 'horario.condicion', 'horario.id_persona', 'persona.nombre as Pnombre')->where('persona.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(6);
        } else {
            $horarios = Horario::join('persona', 'horario.id_persona', '=', 'persona.id')
                ->select('horario.id', 'horario.fecha_inicio', 'horario.fecha_fin', 'horario.hora_entrada', 'hora_salida', 'horario.condicion', 'horario.id_persona', 'persona.nombre as Pnombre')->where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $horarios->total(),
                'current_page' => $horarios->currentPage(),
                'per_page'     => $horarios->perPage(),
                'last_page'    => $horarios->lastPage(),
                'from'         => $horarios->firstItem(),
                'to'           => $horarios->lastItem(),
            ],
            'horarios' => $horarios
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $horario = new horario();
        $horario->hora_entrada = $request->hora_entrada;
        $horario->hora_salida = $request->hora_salida;
        $horario->fecha_inicio = $request->fecha_inicio;
        $horario->fecha_fin = $request->fecha_fin;
        $horario->id_persona = $request->id_persona;
        $horario->condicion = '1';
        $horario->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $horario = Horario::findOrFail($request->id);
        $horario->hora_entrada = $request->hora_entrada;
        $horario->hora_salida = $request->hora_salida;
        $horario->fecha_inicio = $request->fecha_inicio;
        $horario->fecha_fin = $request->fecha_fin;
        $horario->id_persona = $request->id_persona;
        $horario->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->condicion = '0';
        $horario->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->condicion = '1';
        $horario->save();
    }
}
