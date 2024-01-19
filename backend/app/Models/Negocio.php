<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombrenegocio',
        'industria_id',
        'nombre',
        'apellido',
        'celular',
        'correo'
    ];

    public function industria()
    {
        return $this->belongsTo(Industria::class);
    }

}
