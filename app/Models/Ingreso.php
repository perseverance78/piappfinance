<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = ['id', 'monto', 'fecha', 'fuente', 'es_fijo'];
    protected $table = 'ingresos'; 
    protected $primaryKey = 'ingreso_id';
    // public function usuario() {
    //     return $this->belongsTo(Usuario::class);
    // }

    // public function categoria() {
    //     return $this->belongsTo(Categoria::class);
    // }
    use HasFactory;
}
