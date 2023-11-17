<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodo_pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'numeroTarjeta',
        'mes',
        'año',
        'nombreTitula',
        'ccv',
        'id_usuario',
    ];
}
