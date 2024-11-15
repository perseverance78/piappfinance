<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = ['id', 'categoria_id', 'monto', 'fecha', 'descripcion', 'es_fijo'];
    protected $table = 'gastos'; 
    protected $primaryKey = 'gasto_id';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');  // Asegúrate de que 'categoria_id' es la clave foránea en la tabla gastos
    }
}
