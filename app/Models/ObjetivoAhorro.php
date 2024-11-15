<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoAhorro extends Model
{
    use HasFactory;
    
    protected $table = 'objetivos_ahorro';

    protected $primaryKey = 'objetivo_id';

    protected $fillable = [
        'id',  // id del usuario
        'nombre',
        'monto_objetivo',
        'monto_actual',
        'fecha_meta',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
