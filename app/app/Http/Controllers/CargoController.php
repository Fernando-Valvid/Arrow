<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\EmpleadoCargo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct(){
        $this->middleware('permission:ver-cargo|crear-cargo|editar-cargo|borrar-cargo', ['only' => ['index']] );
        $this->middleware('permission:crear-cargo' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-cargo' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-cargo' , ['only' => ['destroy']] );
    }

    public function index()
    {
        $id=Auth::id();
        $empresa=User::select('empresa')->where('id','=',$id)->first();
        $cargos=Cargo::where('id_empresa','=',$empresa->empresa)->get();
        return view('cargos.index',compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     return view('cargos.crear');
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

        $empresa=User::select('empresa')->where('id','=',$id)->first();


        request()->validate([
            'nombre_cargo' => 'required',
            'descripcion' => 'required', 
        ]);


        $data=$request->only([
            'nombre_cargo',
            'descripcion',
            'id_empresa'
        ]);

        $data['id_empresa']=$empresa->empresa;
        Cargo::create($data);
        return redirect()->route('cargos.index');


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
    public function edit(Cargo $cargo)
    {
        return view('cargos.editar',compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {

        
        request()->validate([
            'nombre_cargo' => 'required',
            'descripcion' => 'required', 
        ]);

        $cargo->nombre_cargo=$request->nombre_cargo;
        $cargo->descripcion=$request->descripcion;
        $cargo->save();

        return redirect()->route('cargos.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

        $cargo=EmpleadoCargo::where('id_cargo','=',$id)->count();

        if($cargo>0){
            $mensaje_error="No se puede eliminar el cargo, existen empleados asociados a el";
            return redirect()->route('cargos.index')->with(compact('mensaje_error'));
        }else{
            $cargo=Cargo::where('id','=',$id)->first();
            $cargo->delete();

            $mensaje="cargo eliminado exitosamente";
            return redirect()->route('cargos.index')->with(compact('mensaje'));
        }
    }
}
