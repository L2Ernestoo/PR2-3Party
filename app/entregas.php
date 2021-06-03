<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entregas extends Model
{
    protected $table = 'entregas';

    protected $fillable = [
        'id_entregas',
        'descripcion',
        'url_entrega',
        'users_id'
    ];
}
