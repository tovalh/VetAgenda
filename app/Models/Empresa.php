<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    protected $fillable = [
        'nombre',
        'dominio',
        'estado_suscripcion',
        'habilitado',
        'fecha_fin_suscripcion',
        'configuracion'
    ];
    //

    public function usuarios(){
        return $this->hasMany(User::class);
    }
}
