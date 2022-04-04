<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable=[
        'contrato',
        'nombre_obra',
        'descripcion',
        'fecha_alta',
        'ubicacion',
        'fecha_inicio',
        'fecha_termino',
        'plazo_dias',
        'importe',
        'amortizacion',
        'id_cliente',
        'id_empresa',
        'id_responsable',
        'id_asistente'
     
        
    ];
}
