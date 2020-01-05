<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cria extends Model
{
    protected $fillable = [
        'id_cria','id_gallo','id_gallina'
    ];
    public $timestamps = false;
}
