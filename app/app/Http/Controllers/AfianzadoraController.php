<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afianzadora;
use App\Models\Fianza;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AfianzadoraController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-afianzadora|crear-afianzadora|editar-afianzadora|borrar-afianzadora')->only('index');
        $this->middleware('permission:crear-afianzadora' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-afianzadora' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-afianzadora' , ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id=Auth::id();
        $empresa=User::select('empresa')->where('id','=',$id)->first();
        $afianzadoras=Afianzadora::where('id_empresa','=',$empresa->empresa)->get();
        $afianzadoras=Afianzadora::where('id_empresa','=',$empresa->empresa)->paginate(5);
        // $afianzadoras=Afianzadora::paginate(5);

        return view('afianzadoras.index',compact('afianzadoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('afianzadoras.crear');
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
            'nombre' => 'required',
            'rfc' => 'required',
            'razon_social' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',

        ]);


        
        $data=$request->only([
            'nombre',
            'rfc',
            'razon_social',
            'domicilio',
            'telefono',
            'id_empresa'
        ]);


         $data['id_empresa']=$empresa->empresa;
        Afianzadora::create($data);

        // $data['id_empresa']=auth()->id();

        // Afianzadora::create($request->all());
        return redirect()->route('afianzadoras.index');


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
    public function edit(Afianzadora $afianzadora)
    {


        return view('afianzadoras.editar',compact('afianzadora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afianzadora $afianzadora)
    {
        request()->validate([
            'nombre' => 'required',
            'rfc' => 'required',
            'razon_social' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',

        ]);

        $afianzadora->update($request->all());
        return redirect()->route('afianzadoras.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Afianzadora $afianzadora)
    {

        //  return $afianzadora->id;


         $busqueda=DB::table('fianzas')
         ->join('contratos','fianzas.id_contrato','=','contratos.id')
         ->join('afianzadoras','fianzas.id_afianzadora','=','afianzadoras.id')
         ->where('contratos.estatus','=',0)
         ->where('fianzas.id_afianzadora','=',$afianzadora->id)->count();

        if($busqueda>0){

            $mensaje_error='La afianzadora no se puede eliminar, cuenta con contratos activos';
            return redirect()->route('afianzadoras.index')->with(compact('mensaje_error'));

        }else{
            $busqueda2=DB::table('fianzas')
            ->join('contratos','fianzas.id_contrato','=','contratos.id')
            ->join('afianzadoras','fianzas.id_afianzadora','=','afianzadoras.id')
            ->select('fianzas.id')
            ->where('contratos.estatus','=',1)
            ->where('fianzas.id_afianzadora','=',$afianzadora->id)->get();



            for($i=0; $i<count($busqueda2);$i++){
                $emilinar=Fianza::where('id','=',$busqueda2[$i]->id)->delete();
            }
            
              $afianzadora->delete();
                return redirect()->route('afianzadoras.index');
        }
        


        // return $contratoA;

        // $fianza=Fianza::where('id_afianzadora','=',$afianzadora->id)->count();

  

        

    }
}
