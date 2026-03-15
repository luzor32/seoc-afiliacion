<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargaFamiliar extends Model
{
    protected $table = 'cargas_familiares';

    protected $fillable = [

        // Relación
        'afiliado_id',

        // Datos personales
        'nombre',
        'apellido',
        'dni',
        'parentesco',
        'fecha_nacimiento',

        // Documentación
        'foto_dni_frente',
        'foto_dni_dorso',
        'partida_nacimiento',
        'constancia_escolaridad',
        'certificado_discapacidad',
        'acta_matrimonio_convivencia',

        // Estado
        'estado',

        // Observaciones
        'observaciones'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function afiliado()
    {
        return $this->belongsTo(Afiliado::class);
    }

    public static function parentescos()
    {
        return [
            'Cónyuge' => 'Cónyuge',
            'Hijo' => 'Hijo',
            'Hijastro' => 'Hijastro',
        ];
    }
}
