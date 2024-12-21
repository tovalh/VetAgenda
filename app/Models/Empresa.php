<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    protected $fillable = [
        'nombre',
        'estado_suscripcion',
        'habilitado',
        'fecha_fin_suscripcion' => 1
    ];
    //
}
