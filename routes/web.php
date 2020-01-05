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