<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fianza extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto',
        'fecha',
        'num_fianza',
        'id_contrato',
        'id_afianzadora',
        
    ];
}
