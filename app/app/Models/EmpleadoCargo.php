<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoCargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cargo',
        'id_empleado',

    ];
}
