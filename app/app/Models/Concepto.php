<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    
    protected $fillable=[
        
        'id_codigo',
        'codigo', 
        'concepto',
        'id_unidad',
        'cantidad', 
        'punitario', 
        'precio_letra',
        'importe', 
        'porcentaje',
        'id_contrato'   
    ];
}
