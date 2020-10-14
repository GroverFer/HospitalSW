<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Administrador']], function () {
        Route::get('/rol', 'RolController@index');
        Route::post('/rol/registrar', 'RolController@store');
        Route::put('/rol/actualizar', 'RolController@update');
        Route::put('/rol/desactivar', 'RolController@desactivar');
        Route::put('/rol/activar', 'RolController@activar');
        Route::get('/rol/selectRol', 'RolController@selectRol');

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::get('/user/selectUsuario', 'UserController@selectUsuario');

        Route::get('/persona', 'PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::put('/persona/actualizar', 'PersonaController@update');
        Route::put('/persona/activar', 'PersonaController@activar');
        Route::put('/persona/desactivar', 'PersonaController@desactivar');
        Route::get('/persona/selectPersona', 'PersonaController@selectPersona');

        Route::get('/departamento', 'DepartamentoController@index');
        Route::post('/departamento/registrar', 'DepartamentoController@store');
        Route::put('/departamento/actualizar', 'DepartamentoController@update');
        Route::put('/departamento/desactivar', 'DepartamentoController@desactivar');
        Route::put('/departamento/activar', 'DepartamentoController@activar');
        Route::get('/departamento/selectDepartamento', 'DepartamentoController@selectDepartamento');

        Route::get('/departamento_persona', 'Departamento_personaController@index');
        Route::post('/departamento_persona/registrar', 'Departamento_personaController@store');
        Route::put('/departamento_persona/actualizar', 'Departamento_personaController@update');
        Route::put('/departamento_persona/desactivar', 'Departamento_personaController@desactivar');
        Route::put('/departamento_persona/activar', 'Departamento_personaController@activar');

        Route::get('/especialidad', 'EspecialidadController@index');
        Route::post('/especialidad/registrar', 'EspecialidadController@store');
        Route::put('/especialidad/actualizar', 'EspecialidadController@update');
        Route::put('/especialidad/desactivar', 'EspecialidadController@desactivar');
        Route::put('/especialidad/activar', 'EspecialidadController@activar');
        Route::get('/especialidad/selectEspecialidad', 'EspecialidadController@selectEspecialidad');

        Route::get('/tipo_empleado', 'Tipo_empleadoController@index');
        Route::post('/tipo_empleado/registrar', 'Tipo_empleadoController@store');
        Route::put('/tipo_empleado/actualizar', 'Tipo_empleadoController@update');
        Route::put('/tipo_empleado/desactivar', 'Tipo_empleadoController@desactivar');
        Route::put('/tipo_empleado/activar', 'Tipo_empleadoController@activar');
        Route::get('/tipo_empleado/selectTipo_empleado', 'Tipo_empleadoController@selectTipo_empleado');

        Route::get('/especialidad_persona', 'Especialidad_personaController@index');
        Route::post('/especialidad_persona/registrar', 'Especialidad_personaController@store');
        Route::put('/especialidad_persona/actualizar', 'Especialidad_personaController@update');
        Route::put('/especialidad_persona/desactivar', 'Especialidad_personaController@desactivar');
        Route::put('/especialidad_persona/activar', 'Especialidad_personaController@activar');

        Route::get('/horario', 'HorarioController@index');
        Route::post('/horario/registrar', 'HorarioController@store');
        Route::put('/horario/actualizar', 'HorarioController@update');
        Route::put('/horario/desactivar', 'HorarioController@desactivar');
        Route::put('/horario/activar', 'HorarioController@activar');

        Route::get('/jornada', 'JornadaController@index');
        Route::post('/jornada/registrar', 'JornadaController@store');
        Route::put('/jornada/actualizar', 'JornadaController@update');

        Route::get('/evento', 'EventoController@index');
        Route::post('/evento/registrar', 'EventoController@store');
        Route::put('/evento/actualizar', 'EventoController@update');
        Route::put('/evento/desactivar', 'EventoController@desactivar');
        Route::put('/evento/activar', 'EventoController@activar');
        Route::get('/evento/selectEvento', 'EventoController@selectEvento');

        Route::get('/evento_persona', 'Evento_personaController@index');
        Route::post('/evento_persona/registrar', 'Evento_personaController@store');
        Route::put('/evento_persona/actualizar', 'Evento_personaController@update');
        Route::put('/evento_persona/desactivar', 'Evento_personaController@desactivar');
        Route::put('/evento_persona/activar', 'Evento_personaController@activar');

        Route::get('/tipo_permiso', 'Tipo_permisoController@index');
        Route::post('/tipo_permiso/registrar', 'Tipo_permisoController@store');
        Route::put('/tipo_permiso/actualizar', 'Tipo_permisoController@update');
        Route::put('/tipo_permiso/desactivar', 'Tipo_permisoController@desactivar');
        Route::put('/tipo_permiso/activar', 'Tipo_permisoController@activar');
        Route::get('/tipo_permiso/selectTipo_permiso', 'Tipo_permisoController@selectTipo_permiso');

        Route::get('/solicitud_permiso', 'Solicitud_permisoController@index');
        Route::post('/solicitud_permiso/registrar', 'Solicitud_permisoController@store');
        Route::put('/solicitud_permiso/actualizar', 'Solicitud_permisoController@update');
        Route::put('/solicitud_permiso/desactivar', 'Solicitud_permisoController@desactivar');
        Route::put('/solicitud_permiso/activar', 'Solicitud_permisoController@activar');

        Route::get('/falla', 'FallaController@index');
        Route::post('/falla/registrar', 'FallaController@store');
        Route::put('/falla/actualizar', 'FallaController@update');
        Route::put('/falla/desactivar', 'FallaController@desactivar');
        Route::put('/falla/activar', 'FallaController@activar');
    });

    Route::group(['middleware' => ['Usuario']], function () {
        Route::get('/rol', 'RolController@index');
        Route::post('/rol/registrar', 'RolController@store');
        Route::put('/rol/actualizar', 'RolController@update');
        Route::put('/rol/desactivar', 'RolController@desactivar');
        Route::put('/rol/activar', 'RolController@activar');
        Route::get('/rol/selectRol', 'RolController@selectRol');
    });
});


// Route::get('/home', 'HomeController@index')->name('home');
