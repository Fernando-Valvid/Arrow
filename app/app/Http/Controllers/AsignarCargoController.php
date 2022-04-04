<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\EmpleadoCargo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsignarCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id=Auth::id();

        $empresa=User::select('empresa')->where('id','=',$id)->first();


        $cargosasignados=DB::table('cargos')
        ->join('empleado_cargos', 'cargos.id', '=', 'empleado_cargos.id_cargo')
        ->join('empleados', 'empleados.id','=' ,'empleado_cargos.id_empleado')
        ->select('empleado_cargos.id as id', 'cargos.nombre_cargo as cargo', 'empleados.nombre as nombre' ,
        'empleados.apellido_paterno as paterno', 'empleados.apellido_materno as materno')
        ->where('cargos.id_empresa','=',$empresa->empresa)
        ->get();



        //return $cargosasignados;



        return view('asignarcargo.index', compact('cargosasignados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id=Auth::id();

        $empresa=User::select('empresa')->where('id','=',$id)->first();

        $cliente=Cliente::where('id_empresa','=',$empresa)->get();



        $cargos=DB::table('empresas')
        ->join('cargos', 'empresas.id', '=', 'cargos.id_empresa')
        ->select('cargos.*')
        ->where('empresas.id','=',$empresa->empresa)
        ->get();

        //empleados por clientes
        $empleadosC=DB::table('empresas')
        ->join('clientes','empresas.id','=','clientes.id_empresa')
        ->join('empleados','clientes.id','=','empleados.id_cliente')
        ->select('empleados.*')
        ->where('empresas.id','=',$empresa->empresa)
        ->get();


        //empleados por empresa

        $empleadosE=DB::table('empresas')
        ->join('empleados','empresas.id','=','empleados.id_empresa')
        ->select('empleados.*')
        ->where('empresas.id','=',$empresa->empresa)
        ->get();



        return view('asignarcargo.crear',compact('cargos','empleadosC','empleadosE'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request->all();

        $this->validate($request,
        [
            'id_cargo' => 'required',
            'tipo_empleado' => 'required',

        ],);


        if($request->input('id_cargo')==0){
            $mensaje_error="Por favor seleccione un cargo";
            return back()->withInput()->with(compact('mensaje_error'));

        }
        else if($request->input('tipo_empleado')=='em' && $request->input('id_empresa')==0){
            $mensaje_error="Por favor seleccione un empleado de empresa";
            return back()->withInput()->with(compact('mensaje_error'));


         }else if($request->input('tipo_empleado')=='cl' && $request->input('id_cliente')==0){
            $mensaje_error="Por favor seleccione un empleado de  un cliente";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')==0 && $request->input('id_empresa')==0 && $request->input('id_cliente')==0){

            $mensaje_error="Por favor seleccione un tipo de empleado";
            return back()->withInput()->with(compact('mensaje_error'));
         }else {
            $cargoasignado = new EmpleadoCargo();

            $cargoasignado->id_cargo=$request->id_cargo;

            if($request->input('tipo_empleado')=='cl'){
                $cargoasignado->id_empleado=$request->id_cliente;
            }

            if($request->input('tipo_empleado')=='em'){
                $cargoasignado->id_empleado=$request->id_empresa;
            }



               $cargoasignado->save();
               $mensaje="Cargo asignado exitosamente";
               return redirect()->route('asignarcargo.index')->with(compact('mensaje'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoCargo $asignarcargo)
    {
        $id=Auth::id();

        $empresa=User::select('empresa')->where('id','=',$id)->first();

        $cliente=Cliente::where('id_empresa','=',$empresa)->get();



        $cargos=DB::table('empresas')
        ->join('cargos', 'empresas.id', '=', 'cargos.id_empresa')
        ->select('cargos.*')
        ->where('empresas.id','=',$empresa->empresa)
        ->get();

        //empleados por clientes
        $empleadosC=DB::table('empresas')
        ->join('clientes','empresas.id','=','clientes.id_empresa')
        ->join('empleados','clientes.id','=','empleados.id_cliente')
        ->select('empleados.*')
        ->where('empresas.id','=',$empresa->empresa)
        ->get();


        //empleados por empresa

        $empleadosE=DB::table('empresas')
        ->join('empleados','empresas.id','=','empleados.id_empresa')
        ->select('empleados.*')
        ->where('empresas.id','=',$empresa->empresa)
        ->get();


        //tipo de empleado de cliente

        $tipoC=DB::table('empresas')
        ->join('clientes','empresas.id','=','clientes.id_empresa')
        ->join('empleados','clientes.id','=','empleados.id_cliente')
        ->select('empleados.tipo_empleado')
        ->where('empresas.id','=',$empresa->empresa)
        ->where('empleados.id','=',$asignarcargo->id_empleado)
        ->first();



        // tipo de empleado de empresa

        $tipoE=DB::table('empresas')
        ->join('empleados','empresas.id','=','empleados.id_empresa')
        ->select('empleados.tipo_empleado')
        ->where('empresas.id','=',$empresa->empresa)
        ->where('empleados.id','=',$asignarcargo->id_empleado)
        ->first();


       // return $tipoE;

       $tipo="";

        if(empty($tipoC->tipo_empleado)){


        }else if($tipoC->tipo_empleado=='cl'){
            $tipo="cl";

        }

        if(empty($tipoE->tipo_empleado)){

        }else if($tipoE->tipo_empleado=='em'){
            $tipo="em";
        }

    //    return $tipo;



        return view('asignarcargo.editar',compact('asignarcargo','cargos','empleadosC','empleadosE','tipo' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoCargo $asignarcargo)
    {
        $this->validate($request,
        [
            'id_cargo' => 'required',
            'tipo_empleado' => 'required',

        ],);


        if($request->input('id_cargo')==0){
            $mensaje_error="Por favor seleccione un cargo";
            return back()->withInput()->with(compact('mensaje_error'));

        }
        else if($request->input('tipo_empleado')=='em' && $request->input('id_empresa')==0){
            $mensaje_error="Por favor seleccione un empleado de empresa";
            return back()->withInput()->with(compact('mensaje_error'));


         }else if($request->input('tipo_empleado')=='cl' && $request->input('id_cliente')==0){
            $mensaje_error="Por favor seleccione un empleado de  un cliente";
            return back()->withInput()->with(compact('mensaje_error'));

         }else if($request->input('tipo_empleado')==0 && $request->input('id_empresa')==0 && $request->input('id_cliente')==0){

            $mensaje_error="Por favor seleccione un tipo de empleado";
            return back()->withInput()->with(compact('mensaje_error'));
         }else {


            $asignarcargo->id_cargo=$request->id_cargo;

            if($request->input('tipo_empleado')=='cl'){
                $asignarcargo->id_empleado=$request->id_cliente;
            }

            if($request->input('tipo_empleado')=='em'){
                $asignarcargo->id_empleado=$request->id_empresa;
            }



               $asignarcargo->save();
               $mensaje="Cargo asignado modificado exitosamente";
               return redirect()->route('asignarcargo.index')->with(compact('mensaje'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        EmpleadoCargo::find($id)->delete();
        $mensaje='El empleado ha sido revocado del cargo';
        return redirect()->route('asignarcargo.index')->with(compact('mensaje'));
    }
}
