<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'sexo',
        'fechaNacimiento',
        'numeroAtenciones',
        'enTratamiento'
    ];
    
    protected $casts = [
        'fechaNacimiento' => 'date',
        'enTratamiento' => 'boolean',
    ];
}
