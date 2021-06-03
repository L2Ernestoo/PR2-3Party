<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grados extends Model
{
    public $table = "grados";

    protected $fillable = [
        'id_grado',
        'descripcion'
    ];
}
