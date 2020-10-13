<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Departamento_persona;
use App\Departamento;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $registro = $request->registro;
        $password = $request->password;
        if (Auth::attempt(['registro' => $registro, 'password' => $password, 'condicion' => 1])) {
            return redirect()->route('main');
        }
        return back()
            ->withErrors(['registro' => trans('auth.failed')])
            ->withInput(request(['registro']));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'registro' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function login2(Request $request){
        $input = $request->only('registro','password');
        $registro = $request->registro;
        if (Auth::attempt($input)) {
            $cadena=User::join('persona','persona.id_usuario','users.id')
            ->join('departamento_persona','departamento_persona.id_persona','persona.id')
            ->join('departamento','departamento.id','departamento_persona.id_departamento')
            ->where('registro','=',$registro)
            ->get();    
            return response()->json([
                $cadena
            ],401);
        }
        return  response()->json([

        ],401);
    }

}
