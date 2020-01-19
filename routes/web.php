<?php

Route::get('/', function () {
    return view('contenido.contenido');
});

//Gallo
Route::get('/gallo', 'GalloController@index');
Route::post('/gallo/registrar', 'GalloController@store');
Route::put('/gallo/actualizar', 'GalloController@update');
Route::post('/gallo/desactivar', 'GalloController@desactivar');
Route::put('/gallo/activar', 'GalloController@activar');
Route::get('/gallo/selectGallo', 'GalloController@selectGallo');
//gallina
Route::get('/gallina', 'GallinaController@index');
Route::post('/gallina/registrar', 'GallinaController@store');
Route::put('/gallina/actualizar', 'GallinaController@update');
Route::post('/gallina/desactivar', 'GallinaController@desactivar');
Route::put('/gallina/activar', 'GallinaController@activar');
Route::get('/gallina/selectGallina', 'GallinaController@selectGallina');
//Cria
Route::get('/Cria', 'CriaController@index');
Route::post('/Cria/registrar', 'CriaController@store');
Route::put('/Cria/actualizar', 'CriaController@update');
Route::post('/Cria/desactivar', 'CriaController@desactivar');
Route::put('/Cria/activar', 'CriaController@activar');