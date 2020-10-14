<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud_permiso;


class Solicitud_permisoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $solicitud_permisos = Solicitud_permiso::join('tipo_permiso', 'tipo_permiso.id', '=', 'solicitud_permiso.id_tipopermiso')
                ->join('persona', 'persona.id', '=', 'solicitud_permiso.id_persona')
                ->select('solicitud_permiso.id', 'solicitud_permiso.id_tipopermiso', 'solicitud_permiso.id_persona', 'solicitud_permiso.fecha_inicio', 'solicitud_permiso.fecha_fin', 'solicitud_permiso.motivo',  'tipo_permiso.nombre as tipoTipo_permiso', 'persona.nombre as nombrePersona')
                ->orderBy('solicitud_permiso.id', 'desc')->paginate(6);
        } elseif ($criterio == 'id_persona') {
            $solicitud_permisos = Solicitud_permiso::join('tipo_permiso', 'tipo_permiso.id', '=', 'solicitud_permiso.id_tipopermiso')
                ->join('persona', 'persona.id', '=', 'solicitud_permiso.id_persona')
                ->select('solicitud_permiso.id', 'solicitud_permiso.id_tipopermiso', 'solicitud_permiso.id_persona', 'solicitud_permiso.fecha_inicio', 'solicitud_permiso.fecha_fin', 'solicitud_permiso.motivo', 'tipo_permiso.nombre as tipoTipo_permiso', 'persona.nombre as nombrePersona')
                ->where('persona.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('solicitud_permiso.id', 'desc')->paginate(6);
        } elseif ($criterio == 'id_tipopermiso') {
            $solicitud_permisos = Solicitud_permiso::join('tipo_permiso', 'tipo_permiso.id', '=', 'solicitud_permiso.id_tipopermiso')
                ->join('persona', 'persona.id', '=', 'solicitud_permiso.id_persona')
                ->select('solicitud_permiso.id', 'solicitud_permiso.id_tipopermiso', 'solicitud_permiso.id_persona', 'solicitud_permiso.fecha_inicio', 'solicitud_permiso.fecha_fin', 'solicitud_permiso.motivo', 'tipo_permiso.nombre as tipoTipo_permiso', 'persona.nombre as nombrePersona')
                ->where('tipo_permiso.nombre', 'like', '%' . $buscar . '%')
                ->orderBy('solicitud_permiso.id', 'desc')->paginate(6);
        }else{
            $solicitud_permisos = Solicitud_permiso::join('tipo_permiso', 'tipo_permiso.id', '=', 'solicitud_permiso.id_tipopermiso')
                ->join('persona', 'persona.id', '=', 'solicitud_permiso.id_persona')
                ->select('solicitud_permiso.id', 'solicitud_permiso.id_tipopermiso', 'solicitud_permiso.id_persona', 'solicitud_permiso.fecha_inicio', 'solicitud_permiso.fecha_fin', 'solicitud_permiso.motivo', 'tipo_permiso.nombre as tipoTipo_permiso', 'persona.nombre as nombrePersona')
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('solicitud_permiso.id', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $solicitud_permisos->total(),
                'current_page' => $solicitud_permisos->currentPage(),
                'per_page'     => $solicitud_permisos->perPage(),
                'last_page'    => $solicitud_permisos->lastPage(),
                'from'         => $solicitud_permisos->firstItem(),
                'to'           => $solicitud_permisos->lastItem(),
            ],
            'solicitud_permisos' => $solicitud_permisos
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $solicitud_permiso = new Solicitud_permiso();

        $solicitud_permiso->fecha_inicio = $request->fecha_inicio;
        $solicitud_permiso->fecha_fin = $request->fecha_fin;
        $solicitud_permiso->motivo = $request->motivo;
        $solicitud_permiso->id_tipopermiso = $request->id_tipopermiso;
        $solicitud_permiso->id_persona = $request->id_persona;
        $solicitud_permiso->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $solicitud_permiso = Solicitud_permiso::findOrFail($request->id);
        $solicitud_permiso->fecha_inicio = $request->fecha_inicio;
        $solicitud_permiso->fecha_fin = $request->fecha_fin;
        $solicitud_permiso->motivo = $request->motivo;
        $solicitud_permiso->id_tipopermiso = $request->id_tipopermiso;
        $solicitud_permiso->id_persona = $request->id_persona;
        $solicitud_permiso->save();
    }

    // public function desactivar(Request $request)
    // {
    //     if (!$request->ajax()) return redirect('/');
    //     $solicitud_permiso = Solicitud_permiso::findOrFail($request->id);
    //     $solicitud_permiso->condicion = '0';
    //     $solicitud_permiso->save();
    // }

    // public function activar(Request $request)
    // {
    //     if (!$request->ajax()) return redirect('/');
    //     $solicitud_permiso = Solicitud_permiso::findOrFail($request->id);
    //     $solicitud_permiso->condicion = '1';
    //     $solicitud_permiso->save();
    // }
}
