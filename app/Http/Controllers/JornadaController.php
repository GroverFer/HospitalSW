<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jornada;
use App\Persona;
use App\Horario;
use App\Falla;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

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
                ->orderBy('jornada.fecha_llegada', 'asc')->paginate(6);
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

    public function listarPdf2(Request $request, $criterio, $buscar)
    {
        //if (!$request->ajax()) return redirect('/');

        // $buscar = $request->buscar;
        // $criterio = $request->criterio;
        $buscar = substr($buscar, 0, -7);

        if ($buscar == '') {
            $jornadas2 = Jornada::join('persona', 'jornada.id_persona', '=', 'persona.id')
                ->select('jornada.id', 'jornada.fecha_llegada', 'jornada.fecha_salida', 'jornada.hora_llegada', 'jornada.hora_salida', 'jornada.id_persona', 'persona.nombre as Pnombre')
                ->orderBy('id', 'desc')->get();
        } elseif ($criterio == 'id_persona') {
            $jornadas2 = Jornada::join('persona', 'jornada.id_persona', '=', 'persona.id')
                ->select('jornada.id', 'jornada.fecha_llegada', 'jornada.fecha_salida', 'jornada.hora_llegada', 'jornada.hora_salida', 'jornada.id_persona', 'persona.nombre as Pnombre')->where('persona.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('jornada.fecha_llegada', 'asc')->get();
        } else {
            $jornadas2 = Jornada::join('persona', 'jornada.id_persona', '=', 'persona.id')
                ->select('jornada.id', 'jornada.fecha_llegada', 'jornada.fecha_salida', 'jornada.hora_llegada', 'jornada.hora_salida', 'jornada.id_persona', 'persona.nombre as Pnombre')->where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->get();
        }

        $cont = count($jornadas2);

        $pdf = \PDF::loadView('pdf.jornadaspdf2', ['jornadas2' => $jornadas2, 'criterio' => $criterio, 'buscar' => $buscar, 'cont' => $cont]);
        return $pdf->download('jornadas2.pdf');
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

    public function ingresar(Request $request)
    {

        $mensajeFoto = $request->mensajeFoto;
        $mensajeLatitud = $request->mensajeLatitud;
        $mensajeLongitud = $request->mensajeLongitud;
        if ($mensajeFoto == "Hay similitud") {
            if (($mensajeLongitud == "Aceptado") && ($mensajeLatitud == "Aceptado")) {
                $idpersona = $request->idpersona;
                $date = Carbon::now();
                $fecha = $date->toDateString();
                // $date=$date->addHour(1);
                $hora = $date->toTimeString();
                $fecha_hora = $date->toDateTimeString();

                $vacio = Jornada::where('jornada.id_persona', '=', $idpersona)->where('fecha_llegada', '=', $fecha)->orderBy('fecha_llegada', 'desc')->first();
                if (is_null($vacio)) {
                    $hora_entrada = Persona::join('horario', 'persona.id', 'horario.id_persona')
                        ->select(DB::raw('horario.hora_entrada'))
                        ->where('horario.condicion', '=', '1')->where('horario.id_persona', '=', $idpersona)->first();
                    $hora_salida = Persona::join('horario', 'persona.id', 'horario.id_persona')
                        ->select(DB::raw('horario.hora_salida'))
                        ->where('horario.condicion', '=', '1')->where('horario.id_persona', '=', $idpersona)->first();

                    if ($hora <= $hora_entrada->hora_entrada) {
                        $jornada = new Jornada();
                        $jornada->hora_llegada = $hora;
                        $jornada->fecha_llegada = $fecha;
                        $jornada->id_persona = $idpersona;
                        $jornada->save();
                        return "registrado su entrada con exito";
                    } else {
                        $jornada = new Jornada();
                        $jornada->hora_llegada = $hora;
                        $jornada->fecha_llegada = $fecha;
                        $jornada->id_persona = $idpersona;
                        $jornada->save();

                        $falla = new Falla();
                        $falla->fecha_hora = $fecha_hora;
                        $falla->id_persona = $idpersona;
                        $falla->save();
                        return "registrado con exito, pero ha ingresado tarde";
                    }
                } else {
                    return "Con anterioridad usted ya se ha registrado";
                }
            } else {
                return "Usted no se encuentra dentro del rango establecido";
            }
        } else {
            return "Saquese otra foto porfavor";
        }
    }

    public function salir(Request $request)
    {
        $mensajeFoto = $request->mensajeFoto;
        $mensajeLatitud = $request->mensajeLatitud;
        $mensajeLongitud = $request->mensajeLongitud;
        if ($mensajeFoto == "Hay similitud") {
            if (($mensajeLongitud == "Aceptado") && ($mensajeLatitud == "Aceptado")) {
                $idpersona = $request->idpersona;
                $date = Carbon::now();
                $fecha = $date->toDateString();
                $date = $date->addHour(1);
                $hora = $date->toTimeString();
                $fecha_hora = $date->toDateTimeString();

                $vacio = Jornada::where('jornada.id_persona', '=', $idpersona)->where('fecha_llegada', '=', $fecha)->orderBy('fecha_llegada', 'desc')->first();
                if (!is_null($vacio)) {
                    $hora_entrada = Persona::join('horario', 'persona.id', 'horario.id_persona')
                        ->select(DB::raw('horario.hora_entrada'))
                        ->where('horario.condicion', '=', '1')->where('horario.id_persona', '=', $idpersona)->first();
                    $hora_salida = Persona::join('horario', 'persona.id', 'horario.id_persona')
                        ->select(DB::raw('horario.hora_salida'))
                        ->where('horario.condicion', '=', '1')->where('horario.id_persona', '=', $idpersona)->first();

                    if ($hora >= $hora_salida->hora_salida) {
                        $id = $vacio->id;
                        $jornada = Jornada::findOrFail($id);
                        $jornada->hora_salida = $hora;
                        $jornada->fecha_salida = $fecha;
                        $jornada->save();
                        return "registrado su salida con exito";
                    } else {
                        return "Todavia no es hora de su salida";
                    }
                } else {
                    return "Usted no puede registrar su salidad porque todavia no ha ingresado a laborar";
                }
            } else {
                return "Usted no se encuentra dentro del rango establecido";
            }
        } else {
            return "Saquese otra foto porfavor";
        }
    }
}
