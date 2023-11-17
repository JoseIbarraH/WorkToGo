<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pqr extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'tipo',
        'descripcion',
        'fechaCreacion',
        'estado',
        'respuesta',
        'fechaResolucion',
        'id_usuario'
    ];
}
