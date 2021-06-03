<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actividades extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'id_actividad',
        'descripcion',
        'url_actividad',
        'id_docente',
        'id_materia'
    ];
}
