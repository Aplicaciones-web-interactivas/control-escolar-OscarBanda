<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'grupo_id',
        'maestro_id',
        'fecha_entrega'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    
}
