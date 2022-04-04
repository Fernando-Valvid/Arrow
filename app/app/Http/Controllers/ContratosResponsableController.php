<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class ContratosResponsableController extends Controller
{
    
    public function index()
    {
    


    $id=Auth::id();

    // return $id;

    
    $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
    ->join('roles','roles.id','=','model_has_roles.role_id')
    ->select('roles.name')
    ->where('users.id','=',$id)->first();

   
        
    if($rol->name=='Responsable de obra'){
        // $contratos=Contrato::where('id_responsable','=',$id)->get();

        // $contratos

        $contratos=DB::table('contratos')
        // ->join('fianzas','contratos.id','=','fianzas.id_contrato')
        ->select('contratos.*')
        ->where('contratos.id_responsable','=',$id)
        ->where('estatus','=',0)
        ->get();

        //  return $contratos;

      
        return view('contratosR.contratos',compact('contratos'));





    }else if($rol->name=='Asistente de obra'){
        
        $contratos=Contrato::where('id_asistente','=',$id)->get();
       
        return view('contratosR.contratos',compact('contratos'));

    }

    
        
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato=Contrato::where('id','=',$id)->first();

        // return $contrato;

       $contratoUnion=DB::table('contratos')
        ->join('empresas', 'contratos.id_empresa', '=', 'empresas.id')
        ->join('users', 'contratos.id_responsable', '=', 'users.id')
        ->join('clientes', 'contratos.id_cliente', '=', 'clientes.id')
       ->where('contratos.id','=',$id)
       ->select('contratos.*','contratos.id as contrato_id','users.name',
       'users.id','empresas.id as id_empresa','empresas.nombre as nombre_empresa',
       'clientes.id as id_cliente','clientes.nombre as nombre_cliente')
       ->first();

       $imagenes=DB::table('contratos')
       ->join('imagenes_contratos','contratos.id','=','imagenes_contratos.id_contrato')
       ->select('imagenes_contratos.*')
       ->where('contratos.id','=',$id)->get();


       $asistente=DB::table('contratos')
       ->join('users', 'contratos.id_asistente', '=', 'users.id')
       ->where('contratos.id','=',$id)
       ->select('users.id as asistente_id','users.name as asistente_name')
       ->first();

       return view('contratosR.contratosver',compact('contratoUnion','asistente','imagenes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
