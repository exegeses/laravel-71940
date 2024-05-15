<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;

//Route::get('peticion', acción);
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::view('/', 'plantilla');

##################
### crud de marcas
Route::get('/marcas', [ MarcaController::class, 'index' ]);
