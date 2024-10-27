<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    

    protected $fillable = [
        'id', 
        'nombre', 
        'tipo', 
    ];

    protected $table = 'categorias'; 
    protected $primaryKey = 'categoria_id';
}
