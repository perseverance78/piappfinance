<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // Otros atributos y métodos del modelo

    // Implementación del método getJWTIdentifier
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Implementación del método getJWTCustomClaims
    public function getJWTCustomClaims()
    {
        return [];
    }
}
