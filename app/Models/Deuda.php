<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;
    protected $table = 'deudas';

    protected $primaryKey = 'deuda_id';

    protected $fillable = [
        'id',  // id del usuario
        'nombre',
        'monto_total',
        'monto_pagado',
        'fecha_vencimiento',
        'recordatorio',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
