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
                ->select('users.id', 'personas.nombre', 'personas.tipo_documento', 'personas.num_documento', 'personas.telefono', 'personas.email', 'users.usuario', 'users.password', 'users.condicion', 'users.idrol', 'roles.nombre as rol')
                ->orderBy('users.id', 'desc')->paginate(3);
        } else {
            $usuarios = User::join('personas', 'users.idper', '=', 'personas.id')
                ->join('roles', 'users.idrol', '=', 'roles.id')
                ->select('users.id', 'personas.nombre', 'personas.tipo_documento', 'personas.num_documento', 'personas.telefono', 'personas.email', 'users.usuario', 'users.password', 'users.condicion', 'users.idrol', 'roles.nombre as rol')
                ->where('personas.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(3);
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

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $persona = Persona::findOrFail($user->id);
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();


            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
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
