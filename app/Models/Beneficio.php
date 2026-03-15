<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    protected $table = 'beneficios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];
}
