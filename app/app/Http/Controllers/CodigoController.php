<?php

namespace App\Http\Controllers;

use App\Models\Codigos;
use App\Models\Concepto;
use App\Models\Contrato;
use App\Models\imgConceptos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class CodigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
          
        $this->validate($request,
        [
            'codigo' => 'required',
            'concepto' => 'required',
            'id_contrato' => 'required'        
           
        ]
        
         );

         if($request->hasFile("croquis")){
            $imagen=$request->file("croquis");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
            $imagen->move($ruta,$nombreImagen);
            
        }else{
            $mensaje="seleccione una img";
        }

        // return $request->input('codigo');

       $c= Concepto::create($request->only('codigo','concepto','id_contrato'));

        $id=Concepto::select('id')->find($c->id);

        $img= new imgConceptos();

        $img->imagen=$nombreImagen;
        $img->descripcion="Croquis";
        $img->id_concepto=$id->id;

        $img->save();


        return redirect()->route('codigo.principal',$request->id_contrato);
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
    
        $concepto=DB::table('conceptos')->select('conceptos.id','conceptos.codigo','conceptos.id_contrato','conceptos.concepto'
        ,'img_conceptos.imagen')->
        join('img_conceptos', 'conceptos.id','=','img_conceptos.id_concepto')
        ->where('conceptos.id','=',$id)->first();
        

        $contrato=Contrato::select('id','contrato')->where('id','=',$concepto->id_contrato)->first();

     

        return view('codigos.editarcodigo',compact('concepto','contrato'));



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
            'codigo' => 'required',
            'concepto' => 'required',
            'id_contrato' => 'required'        
           
        ]  );

        $concepto=Concepto::find($id);
        //buscamos la img
        $img=imgConceptos::where('id_concepto','=',$id)->first();

    
        if(!empty($request->hasFile("croquis"))){
           
            $imagen=$request->file("croquis");
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
             $imagen->move($ruta,$nombreImagen);
            $img->imagen=$nombreImagen;
            $img->save();             

        }else{
            $concepto->codigo=$request->codigo;
            $concepto->concepto=$request->concepto;
            $concepto->save();

        }

        return redirect()->route('codigo.principal',$concepto->id_contrato);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concepto $concepto, $id)
    {
        return $concepto;
    }

    public function principal($id){

       

        $contrato=Contrato::select('contrato','id')->where('id','=',$id)->first();
        $conceptose=0;

    
// wwww
        // $conceptop = DB::table('conceptos')
        //    ->where('id_codigo', '=', null)
        //    ->where('id_contrato','=',$contrato->id)
        //    ->first();

        // //id padre 

   

        // $conceptoh=DB::table('conceptos')->select('id')
        // ->where('id_codigo', '=', $conceptop->id)
        // ->get();


        //   count($conceptoh);
        //  $hijos=[];

        // return $conceptoh;
        //  for($i=0; $i<count($conceptoh); $i++ ){
        //     $hijos[]=$conceptoh=DB::table('conceptos')
        //     ->where('id_codigo', '=', $conceptoh[$i]->id)
        //     ->get();
        //  }

        // return $hijos;



        // ddd
        
        $codigo=Concepto::where('id_contrato','=',$id)
        ->where('id_codigo','=',null)->first();


        if(empty($codigo)){
            $codigo=null;
            $conceptos=null;
        }else{
            $conceptos=Concepto::where('id_codigo','=',$codigo->id)
            ->where('estatus','=',0)->get();

            $conceptosEliminados=Concepto::where('id_codigo','=',$codigo->id)
            ->where('estatus','=',1)->count();

            
          
         
            if($conceptosEliminados>0){
                $conceptose=$conceptosEliminados;
            }



           

        }


         return view('conceptos.index',compact('contrato','codigo','conceptos','conceptose'));

    }


    
    public function crear($id){

        $contrato=Contrato::select('id','contrato')->where('id','=',$id)->first();
     
        return view('codigos.crear',compact('contrato'));

     
    }

    public function nuevoconcepto($id){

        $concepto=Concepto::where('id','=',$id)->first();

        // return $concepto;
        
        return view('codigos.crearsecundario',compact('concepto'));
    }

    public function  createsecundario(Request $request){

      
        $codigo_contrato=Concepto::where('id','=',$request->id_codigo)->first();        
        $id_contrator=$codigo_contrato->id_contrato;

        $this->validate($request,
        [
            'codigo' => 'required',
            'concepto' => 'required',
            'id_codigo' => 'required'   
            
        ],
        [
            'codigo.required' => 'El campo nombre debe ser obligatorio'
        ]
        
         );
        

        $concepto= new Concepto();
        $concepto->codigo=$request->codigo;
        $concepto->concepto=$request->concepto;
        $concepto->id_codigo=$request->id_codigo;
        $concepto->id_contrato=$id_contrator;
        $concepto->save();

        $c=$request->input('id_codigo');
        $ids=Concepto::select('id_contrato')->where('id','=',$c)->first();

        $id=$ids->id_contrato;
        

        return redirect()->route('codigo.principal',compact('id'));
        
     
    }

    public function eliminados( Concepto $concepto){


        $conceptos=Concepto::where('id_codigo','=',$concepto->id)
        ->where('estatus','=',1)->get();

        // return $conceptos;

        $contrato=Contrato::select('contrato','id')->where('id','=',$concepto->id_contrato)->first();

       

        $codigo=Concepto::where('id_contrato','=',$concepto->id_contrato)
        ->where('id_codigo','=',$concepto->id_codigo)->first();



         return view('conceptos.indexeliminados',compact('contrato','codigo','conceptos'));

        
    }

   
}
