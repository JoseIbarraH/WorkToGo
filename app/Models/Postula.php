<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postula extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_trabajador',
        'id_servicio',
        'sugerido',
    ];
}
