<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Persona;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $usuarios = User::join('personas', 'users.idper', '=', 'personas.id')
                ->join('roles', 'users.idrol', '=', 'roles.id')
                ->select('users.id', 'personas.nombre', 'personas.apellido', 'personas.tipo_documento', 'personas.num_documento', 'personas.telefono', 'personas.email', 'users.usuario', 'users.password', 'users.condicion', 'users.idrol', 'users.idper', 'roles.nombre as rol')
                ->orderBy('personas.apellido', 'asc')->paginate(6);
        } else {
            $usuarios = User::join('personas', 'users.idper', '=', 'personas.id')
                ->join('roles', 'users.idrol', '=', 'roles.id')
                ->select('users.id', 'personas.nombre', 'personas.apellido', 'personas.tipo_documento', 'personas.num_documento', 'personas.telefono', 'personas.email', 'users.usuario', 'users.password', 'users.condicion', 'users.idrol', 'users.idper', 'roles.nombre as rol')
                ->where('personas.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('personas.apellido', 'asc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page'     => $usuarios->perPage(),
                'last_page'    => $usuarios->lastPage(),
                'from'         => $usuarios->firstItem(),
                'to'           => $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = new User();
        $user->idper = $request->idper;
        $user->idrol = $request->idrol;
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->condicion = '1';
        $user->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
        $user->idper = $request->idper;
        $user->idrol = $request->idrol;
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->condicion = '1';

        $user->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
