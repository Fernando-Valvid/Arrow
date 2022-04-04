<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contrato;
use App\Models\Firmante;
use App\Models\EmpleadoCargo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FirmanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        $ide=User::select('empresa')->where('id','=',$id)->first();

        // $contrato=Contrato::where('id_empresa','=',$ide->empresa)
        // ->where('estatus','=',0)->get();

        $contratos=DB::table('contratos')
        ->join('firmantes','contratos.id','=','firmantes.id_contrato')
        ->join('empleado_cargos','empleado_cargos.id','=','firmantes.id_empleado_cargo')
        ->join('empleados','empleados.id','=','empleado_cargos.id_empleado')
        ->join('cargos','cargos.id','=','empleado_cargos.id_cargo')
        ->select('firmantes.id as id', 'empleados.nombre as nombre','empleados.apellido_paterno as paterno'
        ,'empleados.apellido_materno as materno','contratos.contrato','cargos.nombre_cargo as cargo')
        ->where('contratos.id_empresa','=',$ide->empresa)
        ->where('contratos.estatus','=',0)
        ->get();


        return view('firmantes.index',compact('contratos'));
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

        $cargosasignados=DB::table('cargos')
        ->join('empleado_cargos', 'cargos.id', '=', 'empleado_cargos.id_cargo')
        ->join('empleados', 'empleados.id','=' ,'empleado_cargos.id_empleado')
        ->select('empleado_cargos.id as id', 'empleados.nombre as nombre' ,
        'empleados.apellido_paterno as paterno', 'empleados.apellido_materno as materno')
        ->where('cargos.id_empresa','=',$empresa->empresa)
        ->get();


        $contratos=Contrato::where('id_empresa','=',$empresa->empresa)
        ->where('estatus','=',0)->get();

        

        return view('firmantes.crear',compact('cargosasignados','contratos'));
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
            'id_empleado_cargo' => 'required',
            'id_contrato' => 'required',

        ],);


        if($request->input('id_empleado_cargo')==0){
            $mensaje_error="Por favor seleccione un firmante.";
            return back()->withInput()->with(compact('mensaje_error'));

        }
        else if($request->input('id_contrato')==0){
            $mensaje_error="Por favor seleccione un contrato.";
            return back()->withInput()->with(compact('mensaje_error'));


         }else {
            $cargoasignado = new Firmante();

            $cargoasignado->id_empleado_cargo=$request->id_empleado_cargo;
            $cargoasignado->id_contrato=$request->id_contrato;

               $cargoasignado->save();
               $mensaje="Firmante registrado exitosamente.";
               return redirect()->route('firmantes.index')->with(compact('mensaje'));
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
    public function edit(Firmante $firmante)
    {

        $id=Auth::id();

        $empresa=User::select('empresa')->where('id','=',$id)->first();

        $cargosasignados=DB::table('cargos')
        ->join('empleado_cargos', 'cargos.id', '=', 'empleado_cargos.id_cargo')
        ->join('empleados', 'empleados.id','=' ,'empleado_cargos.id_empleado')
        ->select('empleado_cargos.id as id', 'empleados.nombre as nombre' ,
        'empleados.apellido_paterno as paterno', 'empleados.apellido_materno as materno')
        ->where('cargos.id_empresa','=',$empresa->empresa)
        ->get();


        $contratos=Contrato::where('id_empresa','=',$empresa->empresa)
        ->where('estatus','=',0)->get();

        

        return view('firmantes.editar',compact('firmante','cargosasignados','contratos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Firmante $firmante)
    {
        $this->validate($request,
        [
            'id_empleado_cargo' => 'required',
            'id_contrato' => 'required',

        ],);


        if($request->input('id_empleado_cargo')==0){
            $mensaje_error="Por favor seleccione un firmante.";
            return back()->withInput()->with(compact('mensaje_error'));

        }
        else if($request->input('id_contrato')==0){
            $mensaje_error="Por favor seleccione un contrato.";
            return back()->withInput()->with(compact('mensaje_error'));


         }else {
        

            $firmante->id_empleado_cargo=$request->id_empleado_cargo;
            $firmante->id_contrato=$request->id_contrato;

            $firmante->save();
            $mensaje="Firmante modificado exitosamente.";
            return redirect()->route('firmantes.index')->with(compact('mensaje'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firmante $firmante)
    {
        
            $firmante->delete();
            $mensaje='Firmante eliminado correctamente';
            return redirect()->route('firmantes.index')->with(compact('mensaje'));
        

    }
}
