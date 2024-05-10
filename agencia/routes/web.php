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
    //$regiones = DB::select('SELECT * FROM regiones ORDER BY idRegion DESC');
    //$regiones = DB::table('regiones')->get();
    //$regiones = DB::table('regiones')->orderBy('idRegion', 'desc')->get();
    //paginador
    $regiones = DB::table('regiones')->orderBy('idRegion', 'desc')->paginate(6);
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
Route::get('/region/edit/{id}', function ($id)
{
    //obtenemos los datos de una región filtrada por su id
    /* $region = DB::select('SELECT * FROM regiones
                            WHERE idRegion = :id',
                         [ $id ]); */
    $region = DB::table('regiones')
                    ->where('idRegion',$id)
                    ->first(); // object
    return view('regionEdit', [ 'region'=>$region ]);
});
Route::post('/region/update', function ()
{
    $idRegion = request('idRegion');
    $nombre = request('nombre');
    try {
        /* DB::update('UPDATE regiones
                      SET
                          nombre = :nombre
                      WHERE idRegion = :idRegion',
                    [ $nombre, $idRegion ]); */
        DB::table('regiones')
                ->where('idRegion', $idRegion)
                ->update(['nombre' => $nombre]);
        return redirect('/regiones')
                    ->with([
                            'css'=>'green',
                            'mensaje'=>'Región: '.$nombre.' modificada correctamente.'
                        ]);
    }
    catch( Throwable $th ){
        return redirect('/regiones')
                    ->with([
                            'css'=>'red',
                            'mensaje'=>'No se pudo modificar la región: '.$nombre
                        ]);
    }
});
Route::get('/region/delete/{id}', function ($id)
{
    //obtenemos los datos de una región filtrada por su id
    $region = DB::table('regiones')
                ->where('idRegion',$id)
                ->first(); // object

    //Chequear que no haya destinos relacionados a la región a eliminar
    $check = DB::table('destinos')
                ->where('idRegion', $id)
                ->count();
    if( !$check ){
        //Si no hay destinos relacionados
        // mostramos la vista con el
        // formulario de confirmación de baja
        return view('regionDelete', ['region'=>$region]);
    }
    //Si llegamos a este punto es porque hay destinos relacionados
    // flashing con mensaje que NO se puede eliminar
    return redirect('/regiones')
                ->with(
                    [
                        'css'=>'rose',
                        'mensaje'=>'No se puede eliminar la región: '.$region->nombre.' porque tiene destinos relacionados',
                    ]
                );
});
Route::post('/region/destroy', function ()
{
    $idRegion = request('idRegion');
    $nombre = request('nombre');
    try {
        /*DB::delete( 'DELETE FROM regiones
                          WHERE idRegion = :idRegion',
                        [ $idRegion ] );*/
        DB::table('regiones')
                ->where('idRegion', $idRegion)
                ->delete();

        return redirect('/regiones')
            ->with([
                'css'=>'green',
                'mensaje'=>'Región: '.$nombre.' eliminada correctamente.'
            ]);
    }
    catch( Throwable $th ){
        return redirect('/regiones')
            ->with([
                'css'=>'red',
                'mensaje'=>'No se pudo eliminar la región: '.$nombre
            ]);
    }
});
/*---- CRUDS */
#### CRUD de destinos
Route::get('/destinos', function ()
{
    /* $destinos = DB::select('SELECT *, nombre
                      FROM destinos d
                      JOIN regiones r
                        ON d.idRegion = r.idRegion');*/
    $destinos = DB::table('destinos AS d')
                        ->join('regiones AS r',
                                'd.idRegion','=','r.idRegion'
                               )
                       ->get();
    return view('destinos', [ 'destinos'=>$destinos ]);
});
