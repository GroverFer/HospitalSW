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
Route::get('/rol/selectRol', 'RolController@selectRol');


Route::get('/user', 'UserController@index');
Route::post('/user/registrar', 'UserController@store');
Route::put('/user/actualizar', 'UserController@update');
Route::put('/user/desactivar', 'UserController@desactivar');
Route::put('/user/activar', 'UserController@activar');

Route::get('/persona', 'PersonaController@index');
Route::get('/persona/selectPersona', 'PersonaController@selectPersona');


Route::get('/departamento', 'DepartamentoController@index');
Route::post('/departamento/registrar', 'DepartamentoController@store');
Route::put('/departamento/actualizar', 'DepartamentoController@update');
Route::put('/departamento/desactivar', 'DepartamentoController@desactivar');
Route::put('/departamento/activar', 'DepartamentoController@activar');
Route::get('/departamento/selectDep', 'DepartamentoController@selectDep');


Route::get('/especialidad', 'EspecialidadController@index');
Route::post('/especialidad/registrar', 'EspecialidadController@store');
Route::put('/especialidad/actualizar', 'EspecialidadController@update');
Route::put('/especialidad/desactivar', 'EspecialidadController@desactivar');
Route::put('/especialidad/activar', 'EspecialidadController@activar');
