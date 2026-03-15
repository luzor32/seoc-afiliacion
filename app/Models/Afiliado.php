<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    protected $table = 'afiliados';

    protected $fillable = [

        // Datos personales
        'numero_afiliado',
        'nombre',
        'apellido',
        'dni',
        'cuil',
        'nacionalidad',
        'fecha_nacimiento',

        // Domicilio
        'provincia',
        'localidad',
        'calle',
        'numero',
        'codigo_postal',

        // Contacto
        'telefono',
        'email',

        // Datos laborales
        'empresa_id',
        'puesto',
        'categoria_laboral',
        'seccion',
        'tipo_contrato',
        'jornada_laboral',

        // Datos sindicales
        'fecha_afiliacion',
        'seccional',
        'delegacion_sindical',

        // Baja sindical
        'fecha_baja',
        'motivo_baja',

        // Documentación
        'foto_dni_frente',
        'foto_dni_dorso',
        'foto_recibo_sueldo',
        'foto_constancia_laboral',

        // Estados
        'estado_solicitud',
        'estado_afiliado',

        // Observaciones
        'observaciones'
    ];

    // Conversión automática de fechas
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_afiliacion' => 'date',
        'fecha_baja' => 'date'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cargasFamiliares()
    {
        return $this->hasMany(CargaFamiliar::class);
    }

    public function pagoCuota()
    {
        return $this->hasMany(PagoCuota::class);
    }

    public function beneficio()
    {
        return $this->belongsToMany(Beneficio::class, 'afiliado_beneficio');
    }
}
