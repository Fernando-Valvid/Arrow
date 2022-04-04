<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firmante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empleado_cargo',
        'id_contrato',

    ];
}
