<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialAfiliado extends Model
{
    //

    public function afiliado()
    {
        return $this->belongsTo(Afiliado::class);
    }
}


