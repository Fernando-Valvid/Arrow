<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Contrato;

class ContratosResponsableController extends Controller
{
    public function index()
    {
    


    $user=Auth::guard('api')->user();


    
    $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
    ->join('roles','roles.id','=','model_has_roles.role_id')
    ->select('roles.name')
    ->where('users.id','=',$user->id)->first();

         
    if($rol->name=='Responsable de obra'){
        

        $contratos=DB::table('contratos')
        ->join('clientes','clientes.id','=','contratos.id_cliente')
        ->select('contratos.id', 'contratos.contrato', 'contratos.nombre_obra', 'contratos.descripcion', 
        'contratos.fecha_alta','contratos.ubicacion','contratos.fecha_inicio', 'contratos.fecha_termino', 
        'contratos.plazo_dias', 'contratos.importe', 'contratos.amortizacion',
        'contratos.estatus','contratos.id_cliente','contratos.id_empresa','contratos.id_responsable',
         'contratos.id_asistente','clientes.nombre as nombre_cliente')
        ->where('contratos.id_responsable','=',$user->id)
        ->where('estatus','=',0)
        ->get();

    
       
        return response()->json(['contratos' => $contratos]);


    }else if($rol->name=='Asistente de obra'){
        
        $contratos=Contrato::select('id', 'contrato', 'nombre_obra', 'descripcion', 'fecha_alta',
        'ubicacion','fecha_inicio', 'fecha_termino', 'plazo_dias', 'importe', 'amortizacion',
        'estatus','id_cliente','id_empresa','id_responsable', 'id_asistente')
        ->where('contratos.id_responsable','=',$user->id)
        ->where('estatus','=',0)
        ->get();


       
        return response()->json(['contratos' => $contratos]);

       

    }

    //  return Contrato::all([
    //         'id',
    //         'contrato',
    //         'nombre_obra',
    //         'descripcion',
    //         'fecha_alta',
    //         'ubicacion',
    //         'fecha_inicio',
    //         'fecha_termino',
    //         'plazo_dias',
    //         'importe',
    //         'amortizacion',
    //         'estatus',
    //         'id_cliente',
    //         'id_empresa',
    //         'id_responsable',
    //         'id_asistente'
    //  ]);

    
        
    }

    public function contratos(){
        $user=Auth::guard('api')->user();

    
    
    $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
    ->join('roles','roles.id','=','model_has_roles.role_id')
    ->select('roles.name')
    ->where('users.id','=',$user->id)->first();

         
        if($rol->name=='Responsable de obra'){
            

            $contratos=DB::table('contratos')
            ->join('clientes','clientes.id','=','contratos.id_cliente')
            ->select('contratos.id', 'contratos.contrato')
            ->where('contratos.id_responsable','=',$user->id)
            ->where('estatus','=',0)
            ->get();

        
        
            return response()->json($contratos);


        }else if($rol->name=='Asistente de obra'){
            
            $contratos=Contrato::select('id', 'contrato')
            ->where('contratos.id_responsable','=',$user->id)
            ->where('estatus','=',0)
            ->get();

        
            return response()->json($contratos);

        

        }
    }

    public function busqueda(Request $request){

        


        $user=Auth::guard('api')->user();

        $busqueda=$request->busqueda;

        

        
        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$user->id)->first();
    
             
        if($rol->name=='Responsable de obra'){
            

            if(!empty($busqueda)){
                $contratos=DB::table('contratos')
                ->join('clientes','clientes.id','=','contratos.id_cliente')
                ->select('contratos.id', 'contratos.contrato', 'contratos.nombre_obra', 'contratos.descripcion', 
                'contratos.fecha_alta','contratos.ubicacion','contratos.fecha_inicio', 'contratos.fecha_termino', 
                'contratos.plazo_dias', 'contratos.importe', 'contratos.amortizacion',
                'contratos.estatus','contratos.id_cliente','contratos.id_empresa','contratos.id_responsable',
                 'contratos.id_asistente','clientes.nombre as nombre_cliente')
                ->where('contratos.id_responsable','=',$user->id)
                ->where('estatus','=',0)
                 ->where('contratos.contrato','=',$busqueda)
                ->orWhere( 'contratos.ubicacion','=',$busqueda)
                ->get();
    
    
                return response()->json($contratos);
            }else{
                $contratos=DB::table('contratos')
                ->join('clientes','clientes.id','=','contratos.id_cliente')
                ->select('contratos.id', 'contratos.contrato', 'contratos.nombre_obra', 'contratos.descripcion', 
                'contratos.fecha_alta','contratos.ubicacion','contratos.fecha_inicio', 'contratos.fecha_termino', 
                'contratos.plazo_dias', 'contratos.importe', 'contratos.amortizacion',
                'contratos.estatus','contratos.id_cliente','contratos.id_empresa','contratos.id_responsable',
                'contratos.id_asistente','clientes.nombre as nombre_cliente')
                ->where('contratos.id_responsable','=',$user->id)
                ->where('estatus','=',0)
                ->get();

            return response()->json($contratos);

            }

            

    
        }else if($rol->name=='Asistente de obra'){

            if(!empty($busqueda)){
            
            $contratos=Contrato::select('id', 'contrato', 'nombre_obra', 'descripcion', 'fecha_alta',
            'ubicacion','fecha_inicio', 'fecha_termino', 'plazo_dias', 'importe', 'amortizacion',
            'estatus','id_cliente','id_empresa','id_responsable', 'id_asistente')
            ->where('contratos.id_responsable','=',$user->id)
            ->where('estatus','=',0)
            ->where('contratos.contrato','=',$busqueda)
            ->orWhere( 'contratos.ubicacion','=',$busqueda)
            ->get();

            return response()->json($contratos);

            }else{

                $contratos=Contrato::select('id', 'contrato', 'nombre_obra', 'descripcion', 'fecha_alta',
                'ubicacion','fecha_inicio', 'fecha_termino', 'plazo_dias', 'importe', 'amortizacion',
                'estatus','id_cliente','id_empresa','id_responsable', 'id_asistente')
                ->where('contratos.id_responsable','=',$user->id)
                ->where('estatus','=',0)
                ->get();

            }
    
           
    
        }
    }
    
}