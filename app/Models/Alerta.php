<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $fillable = [
        'usuario_id',
        'tipo_alerta',
        'mensaje',
        'fecha_alerta',
        'vista',
    ];

    /**
     * Relación con el modelo Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
