<?php

namespace App\Http\Controllers;


use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
