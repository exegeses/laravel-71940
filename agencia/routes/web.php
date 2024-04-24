<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('peticion', acción );
Route::get('/mensaje.html', function ()
{
    return 'hola mundo desde laravel';
});

/*Route::get('/inicio', function ()
{
    return view('inicio');
});*/
Route::view('/inicio', 'inicio');
