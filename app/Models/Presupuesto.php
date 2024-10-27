<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $fillable = [
        'id',
        'categoria_id',
        'monto_max',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $table = 'presupuestos'; 
    protected $primaryKey = 'presupuesto_id';
}
