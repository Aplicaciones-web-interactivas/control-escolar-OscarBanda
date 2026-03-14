<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'materia_id',
        'maestro_id',
        'dia',
        'hora_inicio',
        'hora_fin'
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function maestro()
    {
        return $this->belongsTo(User::class, 'maestro_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
