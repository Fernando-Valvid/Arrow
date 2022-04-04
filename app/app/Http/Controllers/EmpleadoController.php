<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\User;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //id del tenar en el usuario
        $usuario=Auth::id();
        $empresaid=User::select('empresa')->where('id','=',$usuario)->first();
        
        
        //empleados con esa empresa
        $empleados=Empleado::where('id_empresa','=',$empresaid->empresa)->get();
        $empresas=Empresa::where('id_tenant','=',$usuario)->get();

       
      
        //empelados que son de clientes Registrados
        $id_tenant=User::select('id_tenant','empresa')->where('id','=',$usuario)->first();
        // return $id_tenant;
        // $clientes=Cliente::where('id_tenant','=',$id_tenant->id_tenant)->get();

        $clientes=DB::table('users')->join('clientes', 'users.id_tenant','=','clientes.id_tenant')
        ->join('empleados', 'empleados.id_cliente','=', 'clientes.id')
        ->join('empresas', 'empresas.id','=','clientes.id_empresa')
        ->select('empleados.*')->where('clientes.id_tenant','=',$id_tenant->id_tenant)
        ->where('clientes.id_empresa','=',$id_tenant->empresa)
        ->groupBy('empleados.id')->get();

        return view('empleados.index',compact('empleados','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //consulta para traer el idempresa
        // $usuario=Auth::id();
        // $empresa=User::select('empresa')->where('id','=',$usuario)->first();

        // return $idempresa;
        // $empresa=Empresa::where('id_tenant','=', $idempresa)->get();
        $usuario=Auth::id();
        $tenat=User::select('id_tenant','empresa')->where('id','=',$usuario)->first();

        //obtener el id de la empresa
        $id_empresa=User::select('empresa')->where('id','=',$usuario)->first();
        //obtener nombre de la la empresa
        $empresa=Empresa::select('id','nombre')->where('id','=',$id_empresa->empresa)->first();


        $clientes=Cliente::select('id','nombre')->where('id_tenant','=',$tenat->id_tenant)
        ->where('id_empresa','=',$tenat->empresa)->get();
    

        
        // $clientes=Cliente::where('nombre','=',)
    
        return view('empleados.crear',compact('clientes','empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

    //  return $request->all();

        $this->validate($request,
        [
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'tipo_empleado'=>'required',
        ],
        [
            'name.required' => 'El campo nombre debe ser obligatorio'
        ]
        
         );


         if($request->input('tipo_empleado')=='em' && $request->input('id_empresa')==0){
            $mensaje_error="Por favor seleccione una empresa";
            return back()->withInput()->with(compact('mensaje_error'));


         }else if($request->input('tipo_empleado')=='cl' && $request->input('id_cliente')==0){
            $mensaje_error="Por favor seleccione un cliente Encargado";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')==0 && $request->input('id_empresa')==0 && $request->input('id_cliente')==0){
        
            $mensaje_error="Por favor seleccione un tipo de empleado";
            return back()->withInput()->with(compact('mensaje_error'));
         }else {
            $empleado = new Empleado();
            $empleado->nombre=$request->nombre;
            $empleado->apellido_paterno=$request->apellido_paterno;
            $empleado->apellido_materno=$request->apellido_materno;
            $empleado->tipo_empleado=$request->tipo_empleado;
            $empleado->num_casa=$request->num_casa;
            $empleado->num_cel=$request->num_cel;
   
            if($request->input('id_empresa')==0){
              $empleado->id_empresa=null;  
            }else{
                $empleado->id_empresa=$request->id_empresa;
            }
   
            
            if($request->input('id_cliente')==0){
               $empleado->id_cliente=null;  
             }else{
                 $empleado->id_cliente=$request->id_cliente;
             }
         
   
   
             $empleado->save();
             $mensaje="Empleado ". $empleado->nombre ." Agregado exitosamente";
             return redirect()->route('empleados.index')->with(compact('mensaje'));
         }


       
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {

       

        if($empleado->id_empresa!=null){
            
            // $idem=Empleado::select('id_empresa')->where('id','=',$empleado->id)->first();
            $empresa=DB::table('empresas')->join('empleados','empresas.id','=','empleados.id_empresa')
            ->select('empresas.nombre')->where('empleados.id','=',$empleado->id)->first();

        }else{
            $empresa=null;
        }

        if($empleado->id_cliente!=null){
            
            // $idem=Empleado::select('id_empresa')->where('id','=',$empleado->id)->first();
            $cliente=DB::table('clientes')->join('empleados','clientes.id','=','empleados.id_cliente')
            ->select('clientes.nombre')->where('empleados.id','=',$empleado->id)->first();


        }else{
            $cliente=null;
        }

        return view('empleados.show',compact('empleado','empresa','cliente'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
    
        $usuario=Auth::id();
        $id_empresa=User::select('empresa')->where('id','=',$usuario)->first();
        $empresa=Empresa::select('id','nombre')->where('id','=',$id_empresa->empresa)->first();
        $tenat=User::select('id_tenant','empresa')->where('id','=',$usuario)->first();

        $clientes=Cliente::select('id','nombre')->where('id_tenant','=',$tenat->id_tenant)
        ->where('id_empresa','=',$tenat->empresa)->get();
        
        
        return view('empleados.editar',compact('empleado','empresa','clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {

       
        $this->validate($request,
        [
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'tipo_empleado'=>'required',
        ],
        [
            'name.required' => 'El campo nombre debe ser obligatorio'
        ]
        
         );


         if($request->input('tipo_empleado')=='em' && $request->input('id_empresa')==0){
            $mensaje_error="Por favor seleccione una empresa";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')=='cl' && $request->input('id_cliente')==0){
            $mensaje_error="Por favor seleccione un cliente Encargado";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')==0 && $request->input('id_cliente')==0 && $request->input('id_empresa')==0){
            $mensaje_error="Por favor seleccione un tipo de empleado";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')!='cl' && $request->input('tipo_empleado')!='em'){
            $mensaje_error="Por favor seleccione un tipo de empleado";
            return back()->withInput()->with(compact('mensaje_error'));
         }else{
           
            $empleado->nombre=$request->nombre;
            $empleado->apellido_paterno=$request->apellido_paterno;
            $empleado->apellido_materno=$request->apellido_materno;
            $empleado->tipo_empleado=$request->tipo_empleado;
            $empleado->num_casa=$request->num_casa;
            $empleado->num_cel=$request->num_cel;
   
            if($request->input('id_empresa')==0){
              $empleado->id_empresa=null;  
            }else{
                $empleado->id_empresa=$request->id_empresa;
            }
   
            
            if($request->input('id_cliente')==0){
               $empleado->id_cliente=null;  
             }else{
                 $empleado->id_cliente=$request->id_cliente;
             }
         
   
   
             $empleado->save();
             $mensaje="Empleado ". $empleado->nombre ." Modificado exitosamente";

             return redirect()->route('empleados.index')->with(compact('mensaje'));
    
    }
}

   
    public function destroy($id)
    {

        Empleado::where('id','=',$id)->update(['estatus'=>1]);
        // Empleado::find($id)->delete();
        $mensaje='Empleado dado de baja exitosamente';
        return redirect()->route('empleados.index')->with(compact('mensaje'));
    }

    public function activar($id){
        Empleado::where('id','=',$id)->update(['estatus'=>0]);
        // Empleado::find($id)->delete();
        $mensaje='Empleado Activado exitosamente';
        return redirect()->route('empleados.index')->with(compact('mensaje'));
    }
}
