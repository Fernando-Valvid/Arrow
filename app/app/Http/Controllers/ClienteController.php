<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        $id_tenant=User::select('id_tenant','empresa')->where('id','=',$id)->first();
        $clientes=Cliente::where('id_tenant','=',$id_tenant->id_tenant)
        ->where('id_empresa','=',$id_tenant->empresa)->get();

        
     return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

 
       return view('clientes.crear'); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       
        
        $id=Auth::id();
        $id_tenant=User::select('id_tenant')->where('id','=',$id)->first();
        $id_empresa=User::select('empresa')->where('id','=',$id)->first();

        // return $id_empresa;
        // $empresa=Empresa::where('id_tenant','=', $idempresa)->get();
        

        request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required',
          
        ]);


        $data=$request->only([
            'nombre',
            'telefono',
            'email'
        ]);

        $data['id_tenant']=$id_tenant->id_tenant;
        $data['id_empresa']=$id_empresa->empresa;
        Cliente::create($data);
        return redirect()->route('clientes.index');

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
    public function edit(Cliente $cliente)
    {
        
        return view('clientes.editar',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        
        request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required',

        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {

        $empleados=Empleado::where('id_cliente','=',$cliente->id)->where('estatus','=',0)->count();

        $contratos=Contrato::where('id_cliente','=',$cliente->id)->count();

        // return $contratos;
        
        if($empleados>0 || $contratos>0){
            $mensaje_error="No se puede eliminar el cliente: ". $cliente->nombre. "  cuenta con empleados activos ó contratos";
            return redirect()->route('clientes.index')->with(compact('mensaje_error'));
        }else{
            
            DB::table('empleados')->where('id_cliente','=',$cliente->id)->delete();
            $cliente->delete();
            $mensaje="Cliente:".$cliente->nombre." Eliminado exitosamente asi como sus empleados inactivos";
            return redirect()->route('clientes.index')->with(compact('mensaje'));
        }


      
      
    }
}
