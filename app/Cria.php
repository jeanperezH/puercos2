<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cria extends Model
{
    protected $fillable = [
        'id','id_gallo','id_gallina',
    ];
    public $timestamps = false;
    public function Puerco(){
        return $this->belongsTo('App\Puerco');
    }
}
