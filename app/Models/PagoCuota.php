<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoCuota extends Model
{
    protected $table = 'pagos_cuotas';

    protected $fillable = [
        'afiliado_id',
        'fecha_pago',
        'monto',
        'periodo',
        'metodo_pago'
    ];

    public function afiliado()
    {
        return $this->belongsTo(Afiliado::class);
    }
}
