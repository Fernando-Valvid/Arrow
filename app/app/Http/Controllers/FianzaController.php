<?php

namespace App\Http\Controllers;

use App\Models\Afianzadora;
use App\Models\Contrato;
use App\Models\Fianza;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FianzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  

        request()->validate([
            
            'monto' => 'required',
            'fecha' => 'required',
            'num_fianza' => 'required',
            'id_contrato' => 'required',
            'id_afianzadora' => 'required',
          
        ]);

        $fianza=Fianza::create($request->all()); 
        return redirect()->route('contratos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $fianza=Fianza::where('id_contrato','=',$id)->first();

        $fianza=DB::table('fianzas')
        ->join('contratos','fianzas.id_contrato','=','contratos.id')
        ->join('afianzadoras','fianzas.id_afianzadora','=','afianzadoras.id')
        ->select('fianzas.*','contratos.contrato as name','contratos.nombre_obra as obra',
        'afianzadoras.nombre as nombre_afianzadora','afianzadoras.rfc as rfc','afianzadoras.telefono as tel',
        'afianzadoras.domicilio as domicilio')
        ->where('fianzas.id_contrato','=',$id)->first();

        // return $fianza;


        // $usuario=User::find($id);

        if($fianza==null){
            return  view('fianza.vacio',compact('id'));
        }else{
            return view('fianza.show',compact('fianza'));
        }



     



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fianza $fianza)
    {
        
        $id=Auth::id();
        $empresa=User::select('empresa')->where('id','=',$id)->first();
        $afianzadoras=Afianzadora::where('id_empresa','=',$empresa->empresa)->get();


        $fianza=DB::table('fianzas')
        ->join('contratos','fianzas.id_contrato','=','contratos.id')
        ->join('afianzadoras','fianzas.id_afianzadora','=','afianzadoras.id')
        ->select('fianzas.*','contratos.contrato as name',
        'contratos.id as idcontrato','contratos.nombre_obra as obra','contratos.fecha_alta as alta',
        'afianzadoras.nombre as nombre_afianzadora','afianzadoras.rfc as rfc','afianzadoras.telefono as tel',
        'afianzadoras.domicilio as domicilio')
        ->where('fianzas.id','=',$fianza->id)->first();

        // return $fianza;

        return view('fianza.editar',compact('fianza','afianzadoras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fianza $fianza)
    {
     

   
        
        request()->validate([
            
            'monto' => 'required',
            'fecha' => 'required',
            'num_fianza' => 'required',
            'id_contrato' => 'required',
            'id_afianzadora' => 'required',
          
        ]);

        $fianza->monto=$request->monto;
        $fianza->fecha=$request->fecha;
        $fianza->num_fianza=$request->num_fianza;
        $fianza->id_afianzadora=$request->id_afianzadora;


        // return $request->all();
        // return $fianza;

        $fianza->save();

        return redirect()->route('contratos.index');
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

    public function crear($id){

        // return $id;
        
        $contrato=Contrato::where('id','=',$id)->first();

        $id=Auth::id();
        $empresa=User::select('empresa')->where('id','=',$id)->first();
        $afianzadoras=Afianzadora::where('id_empresa','=',$empresa->empresa)->get();
        return view('fianza.crear',compact('contrato','afianzadoras'));


    }
}
