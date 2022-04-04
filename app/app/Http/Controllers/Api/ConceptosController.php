<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConceptosController extends Controller
{
    public function show($id){



    $conceptos=DB::table("contratos")
    ->join('conceptos','contratos.id',"=","conceptos.id_contrato")
    ->join('unidad','unidad.id','=','conceptos.id_unidad')
    ->select('conceptos.id','conceptos.codigo')
    ->whereNotNull('conceptos.id_unidad')
    ->where('conceptos.id_contrato',"=",$id)
    ->get();

    return response()->json($conceptos);


    }
}
