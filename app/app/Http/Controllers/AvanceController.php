<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use App\Models\Concepto;
use App\Models\Contrato;
use App\Models\Dato;
use App\Models\imgAvance;
use App\Models\ImagenesContrato;
use App\Models\imgConceptos;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
use Stevebauman\Location\Facades\Location;


class AvanceController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //que concepto pertenece
        $concepto=Concepto::find($id);
        //concepto padre
        $conceptop=Concepto::select('id_codigo')->where('id','=',$concepto->id_codigo)->first();
        $conceptopp=Concepto::where('id','=',$conceptop->id_codigo)->first();
        $imgc=imgConceptos::where('id_concepto','=',$conceptopp->id)
        ->where('descripcion','=','croquis')->first();

         $p=$concepto->id_codigo;

        //  return $p;
       

        // return $imgc;

        //img del contrato
        $imgco=[];
        $imgco=ImagenesContrato::where('id_contrato','=',$concepto->id_contrato)->get();

        $imgn=ImagenesContrato::where('id_contrato','=',$concepto->id_contrato)->count();

        //fecha

        $avancef=Avance::where('id_concepto','=',$id)->first();


        // if($avancef->inicio=null || $avancef->inicio=null  ){
        //     $avancef=1;
        // }


        if($imgn==0){

            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';

            $imgco[0]=$img;
            $imgco[1]=$imgco[0];

            // return $imgco;


        }else if($imgn==1){

            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';

            $imgco[1]=$img;
        }
        
    

        $avance=DB::table('contratos')
        ->select('conceptos.concepto as nom_concepto','conceptos.id as idc', 'conceptos.codigo','clientes.nombre as nombre_cliente',
        'contratos.nombre_obra as nom_obra', 'contratos.ubicacion','contratos.importe as conimporte',
        'contratos.contrato as nom_contrato','empresas.nombre as nom_empresa')
        ->join('conceptos', 'contratos.id','=','conceptos.id_contrato')
        ->join('clientes', 'contratos.id_cliente','=','clientes.id')
        ->join('empresas', 'contratos.id_empresa','=','empresas.id')
        ->where('conceptos.id','=',$id)->first();


        $unidad=DB::table('unidad')->select('unidad.nombre as unidad_nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$id)->first();

       
 

         $dato=Dato::where('id_concepto','=',$id)->count();

         $imagenesavances=DB::table('avances')
         ->join('img_avances','avances.id','=','img_avances.id_avance')
         ->select('img_avances.*')
         ->where('img_avances.id_avance','=', $avancef->id)
         ->get();

         

        //  $json=DB::table('avances')
        //  ->join('img_avances','avances.id','=','img_avances.id_avance')
        //  ->select('img_avances.*')
        //  ->where('img_avances.id_avance','=', $avancef->id)
        //  ->get();

        //  $data=['success' => true, 'iamagenesa' => $json]; 

        //  return response()->json($data, 200, []);
 
  

        return view("avances.show",compact('avance','imgc','imgco','unidad','avancef','dato','p','imagenesavances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
      //Datos de mi avance
        $dato=Dato::find($id);

        

        // return $dato;

    //Opciones seleccionadas de mi formulario
    $avance=Avance::where('id','=',$dato->id_avance)->first();

    
    // return $avance;
    $l=$avance->localizacion;
    $ap=$avance->anchoM;
    $an=$avance->anchoP;
    $vt=$avance->volumenT;
    $are=$avance->area;
    $al=$avance->altura;
    $es=$avance->espesor;
    $pie=$avance->pieza;


        return view('avances.editaravance',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));



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

        $dato=Dato::find($id);

        // return $dato->hombro_izquierdo1;

      

        if($dato->hombro_derecho1==null  && $dato->hombro_derecho2==null){
            $dato->hombro_izquierdo1=$request->hombro_izquierdo1;
            $dato->hombro_izquierdo2=$request->hombro_izquierdo2;

            
        
        }else{
            $dato->hombro_derecho1=$request->hombro_derecho1;
            $dato->hombro_derecho2=$request->hombro_derecho2;
      
        
        }


        $avance=Avance::where('id','=',$dato->id_avance)->first();
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;
        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;
        $dato->save();
        return redirect()->route('ver.avance',$avance->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
      $dato=Dato::find($id);
      $avance=Avance::where('id','=',$dato->id_avance)->first();

      $dato->delete();

      return redirect()->route('ver.avance',$avance->id);
    }

    public function agregarf($id){

        $avance=Avance::where('id_concepto','=',$id)->first();

        $avance=DB::table('conceptos')->select('conceptos.codigo as codigo','conceptos.id as idc','avances.id as ida')
        ->join('avances', 'conceptos.id','=','avances.id_concepto')
        ->where('id_concepto','=',$id)->first();

        // return $avance;

        return view('avances.fecha',compact('avance'));



    }

    public function guardarf($id, Request $request){

        $avance=Avance::where('id_concepto','=',$id)->first();

       

        $avance->inicio=$request->fecha_inicio;
        $avance->fin=$request->fecha_termino;

       

        $avance->save();

        

        return redirect()->route('Avance.show',$id);
    }



    public function agregaropc($id){

        $a=Avance::find($id);
       

        $concepto=Concepto::where('id','=',$a->id_concepto)->first();

        $l=$a->localizacion;
        $al=$a->altura;
        $ap=$a->anchoM;
        $am=$a->anchoP;
        $vt=$a->volumenT;
        $are=$a->area;
        $es=$a->espesor;


        $unidad=DB::table('unidad')->select('unidad.nombre as nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$concepto->id)->first();

        if($unidad->nombre=='PZ' || $unidad=='pz'){
            $pieza=true;
        }else{
            $pieza=false;
        }
        
        return view('avances.opc',compact('a','l','al','ap','am','vt','are','pieza','es'));
    }

    public function guardaropc($id,Request $request){

        

        $l=$request->localizacion;
        $al=$request->altura;
        $ar=$request->area;
        $an=$request->ancho;
        $ancp=$request->anchop;
        $volumenr=$request->volument;
        $pieza=$request->pieza;
        $es=$request->espesor;

     
    

        if($request->volument=='on'){
            if(  $an==null || $ar==null || $l==null){
                $mensaje_error="Error!! Asegurate de tener los valores de localizacion, Altura, Area, Ancho Promedio" ;
                return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

      

        if($request->pieza=='on'){
            if( $ar=='on' || $al=='on' || $ancp=='on'  ){
               
               $mensaje_error="Estos campos no se suelen seleccionar en pieza podrían provocar errores, !Recomiendo: Localizacion y Espesor";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

        if($an=='on'){
            if( $ancp=='on'){
               $mensaje_error="Asegúrate de calular el ancho de una sola forma'";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }


        if($al=='on' && $volumenr!="on" ){

            if( $l!='on' ||  $ancp!='on'  ){
               $mensaje_error="Seleccione mas opciones para la altura se recomienda; la localización y el Ancho total para esta opción'";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

        if($ancp=='on'){
            if( $l!='on' ){
               $mensaje_error="Seleccione mas opciones se recomienda; la localización ó  la localización y la altura '";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

        if($ar=='on'){
            if( $l!='on' && $ancp!="on" ){
               $mensaje_error="Para Calcular el AREA es necesario marcar una localización y un Ancho Promedio'";
               return  redirect()->back()->with(compact('mensaje_error'));
            }
        }

      

    
        $avance=Avance::find($id);

        if($l!=null){
            $avance->localizacion=1;
            $avance->save();
        }else{
            $avance->localizacion=0;
            $avance->save();
        }
        if($al!=null){
            $avance->altura=1;
            $avance->save();
        }else{
            $avance->altura=0;
            $avance->save();
        }
        if($ar!=null){
            $avance->area=1;
            $avance->save();
        } else{
            $avance->area=0;
            $avance->save();
        }
        if($an!=null){
            $avance->anchoM=1;
            $avance->save();
        }else{
            $avance->anchoM=0;
            $avance->save();
        }
        if($ancp !=null){
            $avance->anchoP=1;
            $avance->save();
        }else{
            $avance->anchoP=0;
            $avance->save();
        }
        if($volumenr!=null){
            $avance->volumenT=1;
            $avance->save();
        }else{
            $avance->volumenT=0;
            $avance->save();
        }  if($pieza!=null){
            $avance->pieza=1;
            $avance->save();
        }else{
            $avance->pieza=0;
            $avance->save();
        }
        if($es!=null){
            $avance->espesor=1;
            $avance->save();
        }else{
            $avance->espesor=0;
            $avance->save();
        }
                
       
        return redirect()->route('Avance.show',$avance->id_concepto);
     
    }

    public function veravance($id){

       

        $avance=Avance::find($id);
        $concepto=Concepto::where('id','=',$avance->id_concepto)->first();


        $l=$avance->localizacion;
        //este promedio total 
        $an=$avance->anchoM;
        $al=$avance->altura;
        // Ancho Total
        $ap=$avance->anchoP;
   
        $vtt=$avance->volumenT;
        $pie=$avance->pieza;
        $es=$avance->espesor;
        $are=$avance->area;

 

        //avance

        $datosG=Dato::where('id_avance','=',$avance->id)
        ->where('hombro_izquierdo1','=',null)->where('hombro_izquierdo2','=',null)->get();

        $datosD=Dato::where('id_avance','=',$avance->id)
        ->where('hombro_derecho1','=',null)->where('hombro_derecho2','=',null)->whereNotNull('hombro_izquierdo1')
        ->whereNotNull('hombro_izquierdo2')->get();

        
        // si existen datos ya 
        // $datosexisten= DB::table('avances')
        // ->selectRaw('SUM(localizacion)+(altura)+(AnchoM)+(AnchoP)+(VolumanT)+(Area)')->groupBy('id')
        // ->get();

        // return $datosexisten;

        
        

        // return $l;

        return view('avances.tablaavance',compact('l','an','al','ap','vtt','are','pie','es','avance','datosG','datosD','concepto'));
    }


    public function formulario($id){

        $avance=Avance::find($id);
    
 

        $l=$avance->localizacion;
        $ap=$avance->anchoP;
        $al=$avance->altura;
        $an=$avance->anchoM;
        $vt=$avance->volumenT;
        $are=$avance->area;
        $es=$avance->espesor;
        $pie=$avance->pieza;
        
        return view('avances.createHombroD',compact('l','an','al','ap','vt','are','avance','es','pie'));
    }


    public function formularioIzquierdo($id){

        $avance=Avance::find($id);
    
        $l=$avance->localizacion;
        $ap=$avance->anchoP;
        $al=$avance->altura;
        $an=$avance->anchoM;
        $vt=$avance->volumenT;
        $are=$avance->area;
        $es=$avance->espesor;
        $pie=$avance->pieza;
        
        return view('avances.createHombroI',compact('l','an','al','ap','vt','are','avance','es','pie'));
    }


    public function registrarAvance($id,Request $request){

        $avance=Avance::find($id);


        // $hd1=$request->hombro_derecho1;
        // $hd1 = str_replace(',', '', $hd1);
        // return $hd1;

        
        $dato= new Dato();

        $dato->hombro_derecho1=$request->hombro_derecho1;
        $dato->hombro_derecho2=$request->hombro_derecho2;
    
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;

        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;

        $dato->id_concepto=$avance->id_concepto;
        $dato->id_avance=$avance->id;

        $dato->save();

        // return $dato;


        // return $request->all();

        return redirect()->route('ver.avance',$avance->id);

    }

    public function  registrarAvanceIzquierdo($id,Request $request){

        $avance=Avance::find($id);

        
        $dato= new Dato();

        $dato->hombro_izquierdo1=$request->hombro_izquierdo1;
        $dato->hombro_izquierdo2=$request->hombro_izquierdo2 ;
        

        // return $request->all();
        $dato->ancho1=$request->ancho1;
        $dato->ancho2=$request->ancho2;
        $dato->anchot=$request->anchot;
        $dato->altura=$request->altura;

        $dato->pieza=$request->pieza;
        $dato->espesor=$request->espesor;

        $dato->id_concepto=$avance->id_concepto;
        $dato->id_avance=$avance->id;

        $dato->save();
        
    
        return redirect()->route('ver.avance',$avance->id);

    }


    public function editarIz($id){
        
      //Datos de mi avance
      $dato=Dato::find($id);

      
  //Opciones seleccionadas de mi formulario
  $avance=Avance::where('id','=',$dato->id_avance)->first();

  
  // return $avance;
  $l=$avance->localizacion;
  $ap=$avance->anchoM;
  $an=$avance->anchoP;
  $vt=$avance->volumenT;
  $are=$avance->area;
  $al=$avance->altura;
  $es=$avance->espesor;
  $pie=$avance->pieza;



 


      return view('avances.editarIzquierdo',compact('l','ap','an','vt','are','al','es','pie','avance','dato'));


    }

    public function createPDF($id)
    {


            
    $avancef=Avance::find($id);


    //concepto padre
    $conceptop=Concepto::select('id_codigo')->where('id','=',$avancef->id_concepto)->first();

    $conceptosimg=[];
    $conceptosimg=imgConceptos::where('id_concepto','=',$avancef->id_concepto)->get();
    $imgpn=imgConceptos::where('id_concepto','=',$avancef->id_concepto)->count();
 
 
 
         if($imgpn==0){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $conceptosimg[0]=$img;
             $conceptosimg[1]=$conceptosimg[0];
             $conceptosimg[2]=$conceptosimg[0];

 
             // return $imgco;
 
 
         }else if($imgpn==1){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
             $conceptosimg[1]=$img;
             $conceptosimg[2]=$img;


         }else if($imgpn==2){
          
            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';
            $conceptosimg[2]=$img;
         }
         
    
    $conceptopp=Concepto::where('id','=',$conceptop->id_codigo)->first();
    $conceptoppp=Concepto::where('id','=',$conceptopp->id_codigo)->first();
    $imgc=imgConceptos::where('id_concepto','=',$conceptoppp->id)
    ->where('descripcion','=','croquis')->first();


   
    

    if($avancef->inicio==null || $avancef->fin==null){
        $avancef->inicio='sin fecha';
        $avancef->fin='sin fecha';

     
    }

  

        $l=$avancef->localizacion;$an=$avancef->anchoM;$al=$avancef->altura;$ap=$avancef->anchoP;
        $vtt=$avancef->volumenT;$pie=$avancef->pieza;$es=$avancef->espesor;$are=$avancef->area;

        $datosG=Dato::where('id_avance','=',$avancef->id)
        ->where('hombro_izquierdo1','=',null)->where('hombro_izquierdo2','=',null)->get();

        $datosD=Dato::where('id_avance','=',$avancef->id)
        ->where('hombro_derecho1','=',null)->where('hombro_derecho2','=',null)->whereNotNull('hombro_izquierdo1')
        ->whereNotNull('hombro_izquierdo2')->get();

        $concepto=Concepto::where('id','=',$avancef->id_concepto)->first();
        //contrato
        $idcontrato=$concepto->id_contrato;


        //img del contrato
        $imgco=[];
        $imgco=ImagenesContrato::where('id_contrato','=',$idcontrato)->get();

        
         $imgn=ImagenesContrato::where('id_contrato','=',$idcontrato)->count();
 
 
 
         if($imgn==0){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $imgco[0]=$img;
             $imgco[1]=$imgco[0];
 
             // return $imgco;
 
 
         }else if($imgn==1){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $imgco[1]=$img;
         }
         

    

   


        $avance=DB::table('contratos')
        ->select('conceptos.concepto as nom_concepto','conceptos.id as idc', 'conceptos.codigo','clientes.nombre as nombre_cliente',
        'contratos.nombre_obra as nom_obra', 'contratos.ubicacion','contratos.importe as conimporte',
        'contratos.contrato as nom_contrato','empresas.nombre as nom_empresa')
        ->join('conceptos', 'contratos.id','=','conceptos.id_contrato')
        ->join('clientes', 'contratos.id_cliente','=','clientes.id')
        ->join('empresas', 'contratos.id_empresa','=','empresas.id')
        ->where('conceptos.id','=',$concepto->id)->first();


        $unidad=DB::table('unidad')->select('unidad.nombre as unidad_nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$concepto->id)->first();


        $firmantes=DB::table('contratos')
        ->join('firmantes','contratos.id','=','firmantes.id_contrato')
        ->join('empleado_cargos','empleado_cargos.id','=','firmantes.id_empleado_cargo')
        ->join('empleados','empleados.id','=','empleado_cargos.id_empleado')
        ->join('cargos','cargos.id','=','empleado_cargos.id_cargo')
        ->select('firmantes.id as id', 'empleados.nombre as nombre','empleados.apellido_paterno as paterno'
        ,'empleados.apellido_materno as materno','contratos.contrato','cargos.nombre_cargo as cargo')
        ->where('contratos.id','=',$idcontrato)
        ->get();


 


    
    // return $avance->id_concepto;

    

    //concepto
    // $concepto=Concepto::where('id','=',$avance->id_concepto)->first();  


    
    $pdf=PDF::loadView('avances.pdf',['avance'=>$avance,'concepto'=>$concepto,'l'=>$l,'an'=>$an,
                        'al'=>$al,'ap'=>$ap,'vtt'=>$vtt,'pie'=>$pie,'es'=>$es,'are'=>$are,
                        'datosG'=>$datosG,'datosD'=>$datosD,'imgco'=>$imgco,'avance'=>$avance,
                        'unidad'=>$unidad,'avancef'=>$avancef,'imgc'=>$imgc,'firmantes'=>$firmantes,
                        'conceptosimg'=>$conceptosimg]);
                      
    // return $pdf->download('avances.pdf');
    
    $pdf->setPaper('A4', 'landscape');


 

 

 
    return $pdf->stream();


    //    return view('avances.pdf',compact('concepto'));
    }


    public function create2PDF($id){

        $avancef=Avance::find($id);

        $conceptop=Concepto::select('id_codigo')->where('id','=',$avancef->id_concepto)->first();

        $conceptosimg=[];
        $conceptosimg=imgConceptos::where('id_concepto','=',$avancef->id_concepto)->get();
        $imgpn=imgConceptos::where('id_concepto','=',$avancef->id_concepto)->count();
 
 
 
         if($imgpn==0){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $conceptosimg[0]=$img;
             $conceptosimg[1]=$conceptosimg[0];
             $conceptosimg[2]=$conceptosimg[0];

 
             // return $imgco;
 
 
         }else if($imgpn==1){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
             $conceptosimg[1]=$img;
             $conceptosimg[2]=$img;


         }else if($imgpn==2){
          
            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';
            $conceptosimg[2]=$img;
         }
         
    
    $conceptopp=Concepto::where('id','=',$conceptop->id_codigo)->first();
    $conceptoppp=Concepto::where('id','=',$conceptopp->id_codigo)->first();
    $imgc=imgConceptos::where('id_concepto','=',$conceptoppp->id)
    ->where('descripcion','=','croquis')->first();


   
    

    if($avancef->inicio==null || $avancef->fin==null){
        $avancef->inicio='sin fecha';
        $avancef->fin='sin fecha';

     
    }

  

       
        $concepto=Concepto::where('id','=',$avancef->id_concepto)->first();
        //contrato
        $idcontrato=$concepto->id_contrato;


        //img del contrato
        $imgco=[];
        $imgco=ImagenesContrato::where('id_contrato','=',$idcontrato)->get();

        
         $imgn=ImagenesContrato::where('id_contrato','=',$idcontrato)->count();
 
 
 
         if($imgn==0){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $imgco[0]=$img;
             $imgco[1]=$imgco[0];
 
             // return $imgco;
 
 
         }else if($imgn==1){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $imgco[1]=$img;
         }
         

    

   


        $avance=DB::table('contratos')
        ->select('conceptos.concepto as nom_concepto','conceptos.id as idc', 'conceptos.codigo','clientes.nombre as nombre_cliente',
        'contratos.nombre_obra as nom_obra', 'contratos.ubicacion','contratos.importe as conimporte',
        'contratos.contrato as nom_contrato','empresas.nombre as nom_empresa')
        ->join('conceptos', 'contratos.id','=','conceptos.id_contrato')
        ->join('clientes', 'contratos.id_cliente','=','clientes.id')
        ->join('empresas', 'contratos.id_empresa','=','empresas.id')
        ->where('conceptos.id','=',$concepto->id)->first();


        $unidad=DB::table('unidad')->select('unidad.nombre as unidad_nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$concepto->id)->first();


        $firmantes=DB::table('contratos')
        ->join('firmantes','contratos.id','=','firmantes.id_contrato')
        ->join('empleado_cargos','empleado_cargos.id','=','firmantes.id_empleado_cargo')
        ->join('empleados','empleados.id','=','empleado_cargos.id_empleado')
        ->join('cargos','cargos.id','=','empleado_cargos.id_cargo')
        ->select('firmantes.id as id', 'empleados.nombre as nombre','empleados.apellido_paterno as paterno'
        ,'empleados.apellido_materno as materno','contratos.contrato','cargos.nombre_cargo as cargo')
        ->where('contratos.id','=',$idcontrato)
        ->get();


        
 



               
        $pdf=PDF::loadView('avances.pdf2',['imgco'=>$imgco,'avance'=>$avance,'unidad'=>$unidad,
                            'avancef'=>$avancef,'conceptosimg'=>$conceptosimg,'firmantes'=>$firmantes]);
  
// return $pdf->download('avances.pdf');


     

            return $pdf->stream();

       

    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }





    public function agregarimagenubi($id){

        //$ip='189.234.201.64';
        //$ip = request()->ip(); 

        //return $ip;
        
        $ip=$this->getIp();

        $data = Location::get($ip);
        
        
        //dd($data);
        //$data = Location::get($ip);

        //dd($locationData);
    

       return view('avances.imagen',compact('id','data'));
    }

    public function guardarimagen(Request $request){

        //  $id_avance=$request->id_avance;
        //  $ip=$request->ip; 
        //  $country=$request->country; 
        //  $countrycode=$request->countrycode; 
        //  $regioncode=$request->regioncode; 
        //  $regionname=$request->regionname; 
        //  $cityname=$request->cityname;
        //  $zipcode=$request->zipcode; 
        //  $postalcode=$request->postalcode; 
        //  $latitude=$request->latitude; 
        //  $longitude=$request->longitude; 
        //  $descripcion=$request->descripcion;        

        $guardar = new imgAvance;


        $guardar->id_avance=$request->id_avance;
        $guardar->ip=$request->ip; 
        $guardar->country=$request->country; 
        $guardar->countrycode=$request->countrycode; 
        $guardar->regioncode=$request->regioncode; 
        $guardar->regionname=$request->regionname; 
        $guardar->cityname=$request->cityname;
        $guardar->zipcode=$request->zipcode; 
        $guardar->postalcode=$request->postalcode; 
        $guardar->latitude=$request->latitude; 
        $guardar->longitude=$request->longitude; 
        $guardar->descripcion=$request->descripcion;

        if($imagen=$request->file("imagen")){


            // foreach($imagen as $img ){

                $ruta="img/usuarios/";
                $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->getClientOriginalExtension();
                $imagen->move($ruta,$nombreImagen);
                $guardar->imagen = $nombreImagen;
        

            //     $datasave=[
            //         'id_avance' => $id_avance[$i],
            //         'ip' => $ip[$i],
            //         'country' => $country[$i],
            //         'countrycode' => $countrycode[$i],
            //         'regioncode' => $regioncode[$i],
            //         'regionname' => $regionname[$i],
            //         'cityname' => $cityname[$i],
            //         'zipcode' => $zipcode[$i],
            //         'postalcode' => $postalcode[$i],
            //         'latitude' => $latitude[$i],
            //         'longitude' => $longitude[$i],
            //         'imagen'=> $imagen[$i],
            //         'descripcion' => $descripcion[$i]

            //     ];

            //    imgAvance::create([
                
            //         'id_avance' => $id_avance,
            //         'ip' => $ip,
            //         'country' => $country,
            //         'countrycode' => $countrycode,
            //         'regioncode' => $regioncode,
            //         'regionname' => $regionname,
            //         'cityname' => $cityname,
            //         'zipcode' => $zipcode,
            //         'postalcode' => $postalcode,
            //         'latitude' => $latitude,
            //         'longitude' => $longitude,
            //         'imagen'=> $nombreImagen,
            //         'descripcion' => $descripcion
            //    ]);
                
            //  }

        }

         $guardar->save();

         $avance=Avance::where('id','=',$request->id_avance)->first();

        //  return $avance;

         return redirect()->route('Avance.show',$avance->id_concepto);


        // return "Guardado";

    } 

 
    public function editarimagen(imgAvance $imagen){

        $ip = request()->ip(); 
        $data = Location::get('https://'.$ip);

        
       

        return view("avances.editarimage",compact('imagen','data'));

    }

    public function actualizarimagen(Request $request, imgAvance $img){

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

        $img->id_avance=$request->id_avance;
        $img->ip=$request->ip; 
        $img->country=$request->country; 
        $img->countrycode=$request->countrycode; 
        $img->regioncode=$request->regioncode; 
        $img->regionname=$request->regionname; 
        $img->cityname=$request->cityname;
        $img->zipcode=$request->zipcode; 
        $img->postalcode=$request->postalcode; 
        $img->latitude=$request->latitude; 
        $img->longitude=$request->longitude; 
        $img->descripcion=$request->descripcion;


        $img->save();

        $avance=Avance::where('id','=',$request->id_avance)->first();

        //  return $avance;

         return redirect()->route('Avance.show',$avance->id_concepto);

  


    }

    public function eliminarimagen(imgAvance $imag){

        // return $imag;
        $imag->delete();
        $avance=Avance::where('id','=',$imag->id_avance)->first();


         return redirect()->route('Avance.show',$avance->id_concepto);
    }

    public function createPDFAvance($id){

        $avancef=Avance::find($id);

       
        //concepto padre
    $conceptop=Concepto::select('id_codigo')->where('id','=',$avancef->id_concepto)->first();

    $conceptosimg=[];
    $conceptosimg=imgConceptos::where('id_concepto','=',$avancef->id_concepto)->get();
    $imgpn=imgConceptos::where('id_concepto','=',$avancef->id_concepto)->count();
 
 
         if($imgpn==0){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $conceptosimg[0]=$img;
             $conceptosimg[1]=$conceptosimg[0];
             $conceptosimg[2]=$conceptosimg[0];

 
             // return $imgco;
 
 
         }else if($imgpn==1){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
             $conceptosimg[1]=$img;
             $conceptosimg[2]=$img;


         }else if($imgpn==2){
          
            $img = new ImagenesContrato();
            $img->imagen='sinimg.png';
            $conceptosimg[2]=$img;
         }
         
    
    $conceptopp=Concepto::where('id','=',$conceptop->id_codigo)->first();
    $conceptoppp=Concepto::where('id','=',$conceptopp->id_codigo)->first();
    




  

        

        $concepto=Concepto::where('id','=',$avancef->id_concepto)->first();
        //contrato
        $idcontrato=$concepto->id_contrato;


       // img del contrato
        $imgco=[];
        $imgco=ImagenesContrato::where('id_contrato','=',$idcontrato)->get();

        
         $imgn=ImagenesContrato::where('id_contrato','=',$idcontrato)->count();
 
 
 
         if($imgn==0){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $imgco[0]=$img;
             $imgco[1]=$imgco[0];
 
             // return $imgco;
 
 
         }else if($imgn==1){
 
             $img = new ImagenesContrato();
             $img->imagen='sinimg.png';
 
             $imgco[1]=$img;
         }
         

        $avance=DB::table('contratos')
        ->select('conceptos.concepto as nom_concepto','conceptos.id as idc', 'conceptos.codigo','clientes.nombre as nombre_cliente',
        'contratos.nombre_obra as nom_obra', 'contratos.ubicacion','contratos.importe as conimporte',
        'contratos.contrato as nom_contrato','empresas.nombre as nom_empresa')
        ->join('conceptos', 'contratos.id','=','conceptos.id_contrato')
        ->join('clientes', 'contratos.id_cliente','=','clientes.id')
        ->join('empresas', 'contratos.id_empresa','=','empresas.id')
        ->where('conceptos.id','=',$concepto->id)->first();


        $unidad=DB::table('unidad')->select('unidad.nombre as unidad_nombre')
        ->join('conceptos', 'unidad.id','=','conceptos.id_unidad')
        ->where('conceptos.id','=',$concepto->id)->first();


        $firmantes=DB::table('contratos')
        ->join('firmantes','contratos.id','=','firmantes.id_contrato')
        ->join('empleado_cargos','empleado_cargos.id','=','firmantes.id_empleado_cargo')
        ->join('empleados','empleados.id','=','empleado_cargos.id_empleado')
        ->join('cargos','cargos.id','=','empleado_cargos.id_cargo')
        ->select('firmantes.id as id', 'empleados.nombre as nombre','empleados.apellido_paterno as paterno'
        ,'empleados.apellido_materno as materno','contratos.contrato','cargos.nombre_cargo as cargo')
        ->where('contratos.id','=',$idcontrato)
        ->get();

        $imagenesavances=DB::table('avances')
         ->join('img_avances','avances.id','=','img_avances.id_avance')
         ->select('img_avances.*')
         ->where('img_avances.id_avance','=', $avancef->id)
         ->get();


     
    $pdf=PDF::loadView('avances.avancepdf',['avance'=>$avance,'concepto'=>$concepto,'avance'=>$avance,
                        'unidad'=>$unidad,'avancef'=>$avancef,'firmantes'=>$firmantes,'imgco'=>$imgco,
                        'conceptosimg'=>$conceptosimg, 'imagenesavances'=> $imagenesavances]);
                      
    // return $pdf->download('avances.pdf');
    
    //$pdf->setPaper('A4', 'landscape');


 

 

 
    return $pdf->stream();


        

    }


   
}
