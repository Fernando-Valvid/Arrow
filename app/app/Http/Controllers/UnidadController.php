<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //si existen inactivos
        $inactivos=Unidad::where('estatus','=',1)->count();


        $usuario=User::select('empresa')->where('id','=',Auth::id())->first();

        $unidades=Unidad::where('id_empresa','=',$usuario->empresa)
        ->where('estatus','=',0)->get();
        // return $unidades;
        return view('unidades.index',compact('unidades','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('unidades.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        
        $this->validate($request,
        [
            'nombre' => 'required',
            'descripcion' => 'required',
           
        ]
        
         );
        
        $id_empresa=User::select('empresa')->where('id','=',Auth::id())->first();

        $unidad= new Unidad;

        $unidad->nombre=$request->nombre;
        $unidad->descripcion=$request->descripcion;
        $unidad->id_empresa=$id_empresa->empresa;

        $mensaje="unidad guardada con exito";        
        $unidad->save();
        return redirect()->route('unidades.index')->with(compact('mensaje'));


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
    public function edit($id)
    {
        
     $unidad=Unidad::find($id); 

     return view('unidades.editar',compact('unidad'));
        
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
     
        $this->validate($request,
        [
            'nombre' => 'required',
            'descripcion' => 'required',
           
        ]
        
         );
         $unidad=Unidad::find($id); 
         $unidad->nombre=$request->nombre;
         $unidad->descripcion=$request->descripcion;
       

        $mensaje="Unidad editada con exito";        
        $unidad->save();
        return redirect()->route('unidades.index')->with(compact('mensaje'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidad=Unidad::find($id); 
        $unidad->estatus=1;
        $unidad->save();
        $mensaje_alerta="Unidad eliminada";   
        return redirect()->route('unidades.index')->with(compact('mensaje_alerta'));   

    }

    public function eliminadas(){
        $unidades=Unidad::where('estatus','!=',0)->get(); 
    return  view('unidades.eliminadas',compact('unidades'));

    }

    public function activar($id){
        $unidad=Unidad::find($id); 
        $unidad->estatus=0;
        $unidad->save();
        $mensaje="Unidad Agregada";   
        return redirect()->route('unidades.index')->with(compact('mensaje'));   
    }
    
}
