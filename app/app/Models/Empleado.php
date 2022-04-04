<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'tipo_empleado',
        'num_casa',
        'num_cel',
        'id_empresa',
        'id_cliente'
        
    ];
}
