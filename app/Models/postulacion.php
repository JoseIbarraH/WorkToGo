<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postulacion extends Model
{
    use HasFactory;


    protected $fillable = [
        'proyectos',
        'tipo',
        'estado',
        'id_usuario',
    ];
}
