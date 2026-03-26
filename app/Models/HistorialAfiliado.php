<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialAfiliado extends Model
{
    protected $fillable = [
        'afiliado_id',
        'estado',
        'observacion',
        'user_id', // opcional (quién hizo el cambio)
    ];

    // Relación con afiliado
    public function afiliado()
    {
        return $this->belongsTo(Afiliado::class);
    }
}