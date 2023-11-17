<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'descripcion',
        'fechaCreacion',
        'estado',
        'id_usuario',
        'id_servicio',
        'id_administrador',
    ];


}