<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puerco extends Model
{
    protected $fillable = [
        'nombre',
        'raza',
        'color',
        'fecha_nacimiento',
        'ubicacion',
        'descripcion',
        'estado',
        'foto',
    ];
    public $timestamps = false;
    public function Cria()
    {
        return $this->hasOne('App\Cria');
    }
    
}
