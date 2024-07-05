<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\ProductoRequest;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //Obtenemos listado de productos
        $productos = Producto::orderBy('idProducto', 'desc')
                            ->paginate(6);
        return view('productos', [ 'productos'=>$productos ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //Obtenemos listados de marcas y de categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('productoCreate',
                    [
                        'marcas'=>$marcas,
                        'categorias'=>$categorias
                    ]
                );
    }

    private function validarForm( Request $request )
    {
        $request->validate(
            [
                //'prdNombre'=>'required|unique:productos,prdNombre|min:2|max:75',
                'prdNombre'=>'required|'.Rule::unique('productos')->ignore($request->idProducto, 'idProducto').'|min:2|max:75',
                'prdPrecio'=>'required|numeric|min:0',
                'idMarca'=>'required|exists:marcas,idMarca',
                'idCategoria'=>'required|exists:categorias,idCategoria',
                'prdDescripcion'=>'max:1000',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'El campo "Nombre del producto" es obligatorio.',
                'prdNombre.unique'=>'El "Nombre del producto" ya existe.',
                'prdNombre.min'=>'El campo "Nombre del producto" debe tener como mínimo 2 caractéres.',
                'prdNombre.max'=>'El campo "Nombre" debe tener 75 caractéres como máximo.',
                'prdPrecio.required'=>'Complete el campo Precio.',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número.',
                'prdPrecio.min'=>'Complete el campo Precio con un número mayor a 0.',
                'idMarca.required'=>'Seleccione una marca.',
                'idMarca.exists'=>'Seleccione una marca existente',
                'idCategoria.required'=>'Seleccione una categoría.',
                'idCategoria.exists'=>'Seleccione una categoría existente',
                'prdDescripcion.max'=>'Complete el campo Descripción con 1000 caractéres como máxino.',
                'prdImagen.mimes'=>'Debe ser una imagen.',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo.'
            ]
        );
    }

    private function subirImagen( Request $request ) : string
    {
        //Si no enviaron una imagen store()
        $prdImagen = 'noDisponible.svg';

        //si no enviaron imagen update()
        if( $request->has('imgActual') ){
            $prdImagen = $request->imgActual;
        }

        //si enviaron una imagen
        if( $request->file('prdImagen') ){
            $file = $request->file('prdImagen');
            /* Renombramos el archivo enviado */
            $time = time();
            $extension = $file->getClientOriginalExtension();
            $prdImagen = $time.'.'.$extension;

            /* subimos archivo */
            $file->move(public_path('/imgs/productos'), $prdImagen);
        }

        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(Request $request)
    public function store(ProductoRequest $request) : RedirectResponse
    {
        $prdNombre = $request->prdNombre;
        //$this->validarForm($request);
        $prdImagen = $this->subirImagen( $request );
        try {
            $producto = new Producto;
            //Asignamos atributos
            $producto->prdNombre = $prdNombre;
            $producto->prdPrecio = $request->prdPrecio;
            $producto->idMarca = $request->idMarca;
            $producto->idCategoria = $request->idCategoria;
            $producto->prdDescripcion = $request->prdDescripcion;
            $producto->prdImagen = $prdImagen;
            //Almacenamos en la tabla productos
            $producto->save();
            return redirect('/productos')
                ->with(
                    [
                        'mensaje' => 'Producto: ' . $prdNombre . ' agregado correctamente',
                        'css' => 'green'
                    ]
                );
        }
        catch ( Throwable $th ){
            //log  $th->getMessage()
            return redirect('/productos')
                ->with(
                    [
                        'mensaje'=>'No se pudo agregar el producto: '.$prdNombre.'.',
                        'css'=>'red'
                    ]
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto) : View
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('productoEdit',
                [
                    'marcas'=>$marcas,
                    'categorias'=>$categorias,
                    'producto'=>$producto
                ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request)
    public function update(ProductoRequest $request) : RedirectResponse
    {
        $prdNombre = $request->prdNombre;
        //$this->validarForm($request);
        $prdImagen = $this->subirImagen( $request );
        try {
            $producto = Producto::find($request->idProducto);
            //Asignamos atributos
            $producto->prdNombre = $prdNombre;
            $producto->prdPrecio = $request->prdPrecio;
            $producto->idMarca = $request->idMarca;
            $producto->idCategoria = $request->idCategoria;
            $producto->prdDescripcion = $request->prdDescripcion;
            $producto->prdImagen = $prdImagen;
            //Almacenamos en tabla productos
            $producto->save();

            return redirect('/productos')
                ->with(
                    [
                        'mensaje'=>'Producto: '.$prdNombre.' modificado correctamente',
                        'css'=>'green'
                    ]
                );
        }catch ( Throwable $th ){
            //log  $th->getMessage()
            return redirect('/productos')
                ->with(
                    [
                        'mensaje'=>'No se pudo modificar el producto: '.$prdNombre.'.',
                        'css'=>'red'
                    ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
