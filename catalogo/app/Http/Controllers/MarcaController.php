<?php

namespace App\Http\Controllers;


use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //obtenemos listado de marcas
        $marcas = Marca::orderBy('idMarca', 'desc')->paginate(6);
        return view('marcas', [ 'marcas'=>$marcas ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('marcaCreate');
    }

    private function validarForm( Request $request ) : void
    {
        $request->validate(
            //[ 'campo'=>'regla1|regla2' ]
            [
                'mkNombre'=>'required|unique:marcas,mkNombre|min:2|max:45'
            ],
            [
                'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio',
                'mkNombre.unique'=>'Ya existe una marca con ese nombre',
                'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres',
                'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 45 caractéres como máximo'
            ]
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $mkNombre = $request->mkNombre;
        //validaci´´on
        $this->validarForm($request);
        try {
            $marca = new Marca; // instanciamos
            $marca->mkNombre = $mkNombre; // asignamos valor a atributo
            $marca->save();//almacenamos en tabla
            return redirect('/marcas')
                    ->with(
                        [
                            'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente',
                            'css'=>'green'
                        ]
                    );
        }
        catch ( Throwable $th ){
            return redirect('/marcas')
                        ->with(
                            [
                                'mensaje'=>'No se pudo agregar la marca: '.$mkNombre,
                                'css'=>'red'
                            ]
                        );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        //Obtenemos los datos de una marca por su ID
        //$marca = Marca::where('idMarca', $id)->first();
        $marca = Marca::find($id);
        return view('marcaEdit', ['marca'=>$marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $mkNombre = $request->mkNombre;
        $idMarca = $request->idMarca;
        $this->validarForm($request);
        try {
            $marca = Marca::find($idMarca) ; // obtenemos marca por su id
            $marca->mkNombre = $mkNombre; // asignamos valor a atributo
            $marca->save();//almacenamos en tabla
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente',
                        'css'=>'green'
                    ]
                );
        }
        catch ( Throwable $th ){
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'No se pudo modificar la marca: '.$mkNombre,
                        'css'=>'red'
                    ]
                );
        }
    }

    private function checkProducto( int $idMarca )
    {
        // obj || null
        /* $check = DB::table('productos')
                        ->where('idMarca', $idMarca)
                        ->first();*/
        // int
        $check = DB::table('productos')
                        ->where('idMarca', $idMarca)
                        ->count();
        return $check;
    }

    public function delete( string $id )
    {
        $marca = Marca::find($id);
        dd( $this->checkProducto($id) );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
