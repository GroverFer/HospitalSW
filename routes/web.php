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

Route::get('/', function () {
    return view('contenido/contenido');
});

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
