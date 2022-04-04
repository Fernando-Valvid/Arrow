<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\imgAvance;

use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AvancesController extends Controller
{
    public function show($id){


        $avances=DB::table("contratos")
        ->join('conceptos','contratos.id',"=","conceptos.id_contrato")
        ->join('avances','conceptos.id','=','avances.id_concepto')
        ->select('avances.id')
        ->where('avances.id_concepto',"=",$id)
        ->first();
    
        return response()->json($avances);
    
    
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    public function store(Request $request){

        $ip=$this->getIp();

        $data = Location::get($ip);

       
	
        
        $guardar = new imgAvance;

        $guardar->id_avance=$request->id_avance;
        $guardar->ip=$data->ip; 
        $guardar->country=$data->countryName; 
        $guardar->countrycode=$data->countryCode; 
        $guardar->regioncode=$data->regionCode; 
        $guardar->regionname=$data->regionName; 
        $guardar->cityname=$data->cityName;
        $guardar->zipcode=$data->zipCode; 
        $guardar->postalcode=$data->postalCode; 
        $guardar->latitude=$data->latitude; 
        $guardar->longitude=$data->longitude; 
        $imagen = $request->imagen;


    
    
        // $nombreImagen = strtolower(pathinfo($imagen,PATHINFO_EXTENSION));
        

        $imagen = str_replace('data:image/png;base64,', '', $imagen); 
        $imagen = str_replace(' ', '+', $imagen); 
        $data = base64_decode($imagen); 

        $nombreImagen=strtotime(now()).rand(11111,99999).'.png';
        
    

        $guardar->imagen=$nombreImagen;

 
        Storage::disk('avances')->put($nombreImagen, base64_decode($imagen));

        $guardar->descripcion=$request->descripcion;

        

         $guardar->save();

         $mensaje="success";

         return compact('mensaje');

    }


}
