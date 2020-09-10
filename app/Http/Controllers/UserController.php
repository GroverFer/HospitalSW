<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
// use App\Persona;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $usuarios = User::join('persona', 'persona.id_usuario', '=', 'users.id')
                ->join('rol', 'rol.id', '=', 'users.id_rol')
                ->select('users.id', 'users.registro','users.password','users.condicion','persona.nombre','persona.apellido','users.id_rol','rol.nombre as rolnombre')
                ->orderBy('users.id', 'desc')->paginate(6);
        } else {
            $usuarios = User::join('persona', 'persona.id_usuario', '=', 'users.id')
                ->join('rol', 'rol.id', '=', 'users.id_rol')
                ->select('users.id', 'users.registro','users.password','users.condicion','persona.nombre','persona.apellido','users.id_rol','rol.nombre as rolnombre')
                ->where('persona.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('users.id', 'desc')->paginate(6);
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
        $user->registro = $request->registro;
        $user->password = bcrypt($request->password);
        $user->condicion = '1';
        $user->id_rol=$request->id_rol;
        $user->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
        $user->registro = $request->registro;
        $user->password = bcrypt($request->password);
        $user->id_rol=$request->id_rol;
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
