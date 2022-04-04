<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    protected $fillable=[
        
        'hombro_derecho1',
        'hombro_derecho2', 
        'hombro_izquierdo1',
        'hombro_izquierdo2',
        'ancho1', 
        'ancho2', 
        'anchot',
        'altura', 
        'espesor',
        'pieza',
        'id_concepto',
        'id_avance'   
    ];
}
