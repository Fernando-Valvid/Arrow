<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\Concepto;
use App\Models\Contrato;
use App\Models\imgConceptos;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;



class ConceptoController extends Controller
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
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $idcp=Concepto::where('id','=',$request->input('id_codigo'))->first();

    
        $this->validate($request,
        [
            'id_codigo' => 'required',
            'codigo' => 'required',
            'concepto' => 'required',
            'id_unidad' => 'required',
            'cantidad' => 'required',
            'punitario' => 'required',
            'precio_letra' => 'required',
            'importe' => 'required',
            'porcentaje' => 'required'        
           
        ],
        [
            'codigo.required'=>'el codigo debe ser obligatorio',
            'concepto.required'=>'La descripcion del concepto es necesaria',
            'cantidad.required'=>'Ingrese una cantidad',
            'punitario.required'=>'Ingrese un precio unitario',
            'importe.required'=>'Ingrese un importe',
            'precio_letra.required' => 'Digite el precio letra',
            'porcentaje.required'=>'Ingrese un porcentaje',
            
        ]

    );

        $data=$request->only([
            'id_codigo',
            'codigo',
            'concepto',
            'id_unidad',
            'cantidad',
            'punitario',
            'precio_letra',
            'importe',
            'porcentaje',     
        ]);

        $data['id_contrato']=$idcp->id_contrato;
        
    
        $concepto=Concepto::create($data);

       
        $a = new Avance();

        $a->id_concepto=$concepto->id;

        $a->save();

     
     


        return redirect()->route('codigo.principal',$idcp->id_contrato);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // return $id;

    
     
        $concepto=Concepto::where('id','=',$id)->first();

        // return $concepto;

 


        $conceptos=DB::table('unidad')->select('conceptos.codigo','conceptos.id_codigo','conceptos.id','conceptos.cantidad',
        'conceptos.punitario','conceptos.precio_letra','conceptos.importe','conceptos.porcentaje',
        'conceptos.estatus','conceptos.concepto','id_unidad as id_uni','nombre as nombre_unidad')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('id_codigo','=',$id)->paginate(5);



        return view('conceptos.listaConceptos',compact('conceptos','concepto'));
    }

    public function ver($id){
        $concepto=DB::table('unidad')->select('conceptos.codigo','conceptos.id','conceptos.id_codigo','conceptos.cantidad',
        'conceptos.punitario','conceptos.precio_letra','conceptos.importe','conceptos.porcentaje',
        'conceptos.estatus','conceptos.concepto','id_unidad as id_uni','nombre as nombre_unidad')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$id)->first();

        $imagenes=DB::table('conceptos')
       ->join('img_conceptos','conceptos.id','=','img_conceptos.id_concepto')
       ->select('img_conceptos.*')
       ->where('conceptos.id','=',$id)->get();

      

        return view('conceptos.show',compact('concepto','imagenes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $concepto=DB::table('unidad')->select('conceptos.codigo','conceptos.id_codigo','conceptos.id','conceptos.cantidad',
        'conceptos.punitario','conceptos.precio_letra','conceptos.importe','conceptos.porcentaje',
        'conceptos.estatus','conceptos.concepto','id_unidad as id_uni','nombre as nombre_unidad')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$id)->first();

        $conceptop=Concepto::where('id','=',$concepto->id_codigo)->first();

        $idempresa=Contrato::select('id_empresa')->where('id','=',$conceptop->id_contrato)->first();
        $unidades=Unidad::where('id_empresa','=',$idempresa->id_empresa)->get();

        return view('conceptos.editar',compact('conceptop','concepto','unidades'));
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
            'id_codigo' => 'required',
            'codigo' => 'required',
            'concepto' => 'required',
            'id_unidad' => 'required',
            'cantidad' => 'required',
            'punitario' => 'required',
            'precio_letra' => 'required',
            'importe' => 'required',
            'porcentaje' => 'required'        
           
        ],
        [
            'codigo.required'=>'el codigo debe ser obligatorio',
            'concepto.required'=>'La descripcion del concepto es necesaria',
            'cantidad.required'=>'Ingrese una cantidad',
            'punitario.required'=>'Ingrese un precio unitario',
            'importe.required'=>'Ingrese un importe',
            'precio_letra.required' => 'Digite el precio letra',
            'porcentaje.required'=>'Ingrese un porcentaje',
            
        ]);

        $concepto=Concepto::find($id);
        
        $concepto->codigo=$request->codigo;
        $concepto->concepto=$request->concepto;
        $concepto->id_unidad=$request->id_unidad;
        $concepto->cantidad=$request->cantidad;
        $concepto->punitario=$request->punitario;
        $concepto->precio_letra=$request->precio_letra;
        $concepto->importe=$request->importe;
        $concepto->porcentaje=$request->porcentaje;

        $concepto->save();

        $concepto=DB::table('unidad')->select('conceptos.codigo','conceptos.id','conceptos.id_codigo','conceptos.cantidad',
        'conceptos.punitario','conceptos.precio_letra','conceptos.importe','conceptos.porcentaje',
        'conceptos.estatus','conceptos.concepto','id_unidad as id_uni','nombre as nombre_unidad')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$id)->first();

        $imagenes=DB::table('conceptos')
        ->join('img_conceptos','conceptos.id','=','img_conceptos.id_concepto')
        ->select('img_conceptos.*')
        ->where('conceptos.id','=',$id)->get();

        return view('conceptos.show',compact('concepto','imagenes'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
        $concepto=Concepto::find($id);

        $concepto->estatus=1;
        $concepto->save();

        return redirect()->route('conceptosec.show',$concepto->id_codigo);

    }

    public function crear($id){



        $concepto=Concepto::where('id','=',$id)->first();
      
        $idpadre=Concepto::where('id','=',$concepto->id_codigo)->first();
        $idempresa=Contrato::select('id_empresa')->where('id','=',$idpadre->id_contrato)->first();
        $unidades=Unidad::where('id_empresa','=',$idempresa->id_empresa)->get();

        // return $unidades;
        


        return view('conceptos.crear',compact('concepto','unidades'));
    }

    public function editarsec(Concepto $concepto){
    
        //concepto padre
        $conceptop=Concepto::where('id','=',$concepto->id_codigo)->first();

        return view('conceptos.editarsecundario',compact('conceptop','concepto')); 



    }

    public function updatesec(Request $request,Concepto $concepto){

        $this->validate($request,
        [
            'codigo' => 'required',
            'concepto' => 'required',
                   
           
        ]
        
         );

        $concepto->codigo=$request->codigo;
        $concepto->concepto=$request->concepto;
        $concepto->save();

        $id=$concepto->id_contrato;

        return redirect()->route('codigo.principal',compact('id'));
    }


    public function eliminarsec(Concepto $concepto ){



        $concepto->estatus=1;
        $concepto->save();

        $conceptos=DB::table('conceptos')->where('id_codigo','=',$concepto->id)
        ->update(['estatus'=>1]);
    
        return redirect()->route('codigo.principal',$concepto->id_contrato);

    }

    public function activar(Concepto $concepto){

        // return $concepto;

      
        $concepto->estatus=0;
        $concepto->save();

        $conceptos=DB::table('conceptos')->where('id_codigo','=',$concepto->id)
        ->update(['estatus'=>0]);
    
        return redirect()->route('codigo.principal',$concepto->id_contrato);
      
    }

    public function secactivar(Concepto $concepto){

        // return $concepto;

        $conceptop=Concepto::select('estatus')->where('id','=',$concepto->id_codigo)->first();

        if($conceptop->estatus>0){
            $mensaje_error="Error!, Active el concepto principal de esta actividad";
        }else{
            $concepto->estatus=0;
            $concepto->save();
            $mensaje_error="";
        }

        return redirect()->route('conceptosec.show',$concepto->id_codigo)->with(compact('mensaje_error'));


    }

    public function imagen($id){
        
        

        return view('conceptos.imagen',compact('id'));
    }

    public function guardarimagen(Request $request){

        $conceptos=Concepto::where('id','=',$request->input('id_concepto'))->first();

        

        $this->validate($request,
        [
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png|max:1024',
            'id_concepto'

        ],
        [
            'descripcion.required' => 'El campo nombre debe ser obligatorio'
        ]

         );

         $imagen=$request->all();



        $guardar = new imgConceptos;

       

         if($imagen=$request->file("imagen")){
                $ruta="img/usuarios/";
                $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->getClientOriginalExtension();
                $imagen->move($ruta,$nombreImagen);
                $guardar->imagen = $nombreImagen;
        
        }

         $guardar->descripcion=$request->descripcion;
        // $guardar->imagen=implode("|",$fotos);
         $guardar->id_concepto=$request->id_concepto;
        $guardar->save();

        //return $conceptos->id;

        $mensaje="Plano agregado correctamente";
        return redirect()->route('concepto.ver',$conceptos->id)->with(compact('mensaje'));
    }

    public function editarimagen(imgConceptos $imagen){

        //return $imagen;

        return view("conceptos.editarimage",compact('imagen'));

    }

    public function actualizarimagen(Request $request, imgConceptos $img){

        $conceptos=Concepto::where('id','=',$request->input('id_concepto'))->first();


        $this->validate($request,
        [
            'descripcion' => 'required',
            'imagen' => 'image|mimes:jpeg,png|max:1024',

        ],
        [
            'descripcion.required' => 'El campo nombre debe ser obligatorio'
        ]

         );

        $image=$request->all();

        if($imagen=$request->file("imagen")){
            $ruta="img/usuarios/";
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->getClientOriginalExtension();
            $imagen->move($ruta,$nombreImagen);
            $img->imagen = $nombreImagen;
    
        }else{
            unset($imagen['imagen']);
        }


        $img->descripcion=$request->descripcion;
        $img->id_concepto=$request->id_concepto;
        $img->save();



        $mensaje="Plano actualizado correctamente";
        return redirect()->route('concepto.ver',$conceptos->id)->with(compact('mensaje'));
    }

    public function eliminarimagen(imgConceptos $imag){
        
        $conceptos=Concepto::where('id','=',$imag->id_concepto)->first();

        
        $imag->delete();
        
        $mensaje="Plano eliminado correctamente";
        return redirect()->route('concepto.ver',$conceptos->id)->with(compact('mensaje'));
    }



   
}
