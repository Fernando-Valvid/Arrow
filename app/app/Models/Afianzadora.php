<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afianzadora extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre',
        'rfc',
        'razon_social',
        'domicilio',
        'telefono',
        'id_empresa'
    ];

}
