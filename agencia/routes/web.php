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
//----
Route::get('/datos', function ()
{
    return [
               'curso'=>'Desarrollo con Laravel',
               'codigo'=>71940,
               'inicio'=>'20-04-2024',
               'fin'=>'22-05-2024'
           ];
});
//-- vistas
Route::get('/vista', function ()
{
    $curso = 'Desarrollo con Laravel';
    // pasar un dato a la vista
    return view('vista',
                [
                    'curso'=>$curso,
                    'fruta'=>'pera',
                    'numero'=>77,
                    'zeppelin'=>[
                                    'Jimmy Page',
                                    'Robert Plant',
                                    'John Paul Jones',
                                    'John Bonham'
                                ]
                ]
            );
});
Route::get('/vista2', function ()
{
    return view('vista2');
});
/*---- CRUDS */
Route::view('/plantilla', 'plantilla');
