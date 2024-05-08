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

Route::view('/plantilla', 'plantilla');
/*---- CRUDS */
#### CRUD de regiones
Route::get('/regiones', function ()
{
    //Obtenemos listado de regiones
    //$regiones = DB::select('SELECT * FROM regiones');
    //$regiones = DB::table('regiones')->get();
    //paginador
    $regiones = DB::table('regiones')->paginate(3);
    return view('regiones', [ 'regiones'=>$regiones ]);
});
Route::get('/region/create', function ()
{
    return view('regionCreate');
});
Route::post('/region/store', function ()
{
    //capturamos dato enviado por el form
    //$nombre = request()->post('nombre');
    //$nombre = request()->input('nombre');
    //$nombre = request()->nombre;
    $nombre = request('nombre');
    try {
        //insertamos en tabla regiones
        /* versión raw SQL
        DB::insert(
                "INSERT INTO regiones
                            (nombre)
                        VALUE
                            ( :nombre )",
                [ $nombre ]
            );
        */
        /*### versión Query Builder*/
        DB::table('regiones')
                ->insert(['nombre'=>$nombre]);
        return redirect('/regiones')
                    ->with([
                            'css'=>'green',
                            'mensaje'=>'Región: '.$nombre.' agregada correctamente.'
                        ]);
    }catch ( Throwable $th ){
        //si falla
        return redirect('/regiones')
                    ->with([
                            'css'=>'red',
                            'mensaje'=>'No se pudo agrergar la región: '.$nombre
                        ]);
    }
});
