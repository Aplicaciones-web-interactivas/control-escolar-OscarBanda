<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{

    protected $table = 'calificaciones';

    protected $fillable = [
        'user_id',
        'grupo_id',
        'calificacion'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
