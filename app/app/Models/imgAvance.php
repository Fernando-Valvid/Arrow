<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imgAvance extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_avance',
         'ip', 
         'country', 
         'countrycode', 
         'regioncode', 
         'regionname', 
         'cityname',
         'zipcode', 
         'postalcode', 
         'latitude', 
         'longitude',
         'imagen',
         'descripcion',
    ];


}
