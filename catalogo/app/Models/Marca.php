<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    //protected $table = 'regiones';
    protected $primaryKey = 'idMarca';
    public $timestamps = false;
}
