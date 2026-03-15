<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'cuit',
        'direccion',
        'telefono',
        'email',
        'actividad',
        'estado'
    ];

    public function afiliados()
    {
        return $this->hasMany(Afiliado::class);
    }
}
