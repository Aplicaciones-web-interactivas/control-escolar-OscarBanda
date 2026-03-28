<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = [
        'tarea_id',
        'alumno_id',
        'archivo_pdf'
    ];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function tarea()
{
    return $this->belongsTo(Tarea::class);
}
}
