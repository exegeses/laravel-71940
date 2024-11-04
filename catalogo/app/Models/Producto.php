<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey = 'idProducto';
    public $timestamps = false;

    static function checkProductoPorMarca( int $idMarca ) : int
    {
        // obj | null
        /* $check = Producto::where('idMarca', $idMarca)
                            ->first(); */
        $check = Producto::where('idMarca', $idMarca)
                            ->count();
        return $check;
    }

    // mértodo de relación
    public function getMarca()
    {
        return $this->belongsTo(
                Marca::class,
                'idMarca',
                'idMarca'
        );
    }
    public function getCategoria()
    {
        return $this->belongsTo(
            Categoria::class,
            'idCategoria',
            'idCategoria'
        );
    }
}
