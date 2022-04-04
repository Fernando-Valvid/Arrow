@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')


<div class="container-fluid">
    <div class="block-header">

        <h2>Avance</h2>
        <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
          {{session('mensaje')}}
        </div>
        @endif
        <div>

        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
               
                                             
                {{--Cabecera  --}}
                <div class="header clearfix">
                    <h2 class="text-center">Datos del avance</h2>
                    <br>
                    <a href="{{route('Avance.show',$avance->id_concepto)}}" class="btn btn-raised btn-success m-auto" ><i class="material-icons">arrow_back</i></a>
                    
                    {{-- en el caso de que este amrcado la longitud --}}
                    @if ($l==1)
                    <a href="{{route('registrar.avance',$avance->id)}}"  class="m-auto btn btn-raised btn-warning m-auto">Hombro Derecho</a>   
                    <a href="{{route('registrar.avanceI',$avance->id)}}"  class="m-auto btn btn-raised btn-warning m-auto">Hombro Izquierdo</a>   
                    
                        
                    @else
                    <a href="{{route('registrar.avance',$avance->id)}}"  class="m-auto btn btn-raised btn-warning m-auto">Registrar avance</a><br><br>
                    @endif

                   
                </div>
                
                <div class="body">
                    
                     <div class="mt-40"></div><br>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>

                                        <?php $total_estimado=0; $total_estimado1=0;  $total_estimado2=0; $total_pieza=0; $total_pieza1=0; $total_estimado3=0;
                                        $total_estimado4=0; $vt=0; $vta=0; $totalp=0;  $est=0?>

                                        @if ($pie==1 && $l!=1 )
                                        <th  class="text-center bg-info">Posicion</th>
                                        @endif

                                        @if ($an==1 && $l!=1 )
                                        <th  class="text-center bg-info">Posicion</th>
                                        @endif

                                   
                                        @if ($l==1)
                                        <tr>
                                            <th  class="text-center bg-info">Posicion</th>
                                            <th  class="text-center col-2 mb-4">Localización
                                            <div class="col d-flex justify-content-around mt-3">
                                                <p>De</p>
                                                <p>Al</p>
                                            </div>
                                               
                                            </div>
                                         
                                            
                                        </th >
                                        <th class="text-center " style="background-color: rgb(190, 191, 192)">Longitud</th>
                                        @endif

                                             {{-- Opcion cuando se tiene la longitud  --}}
                                     @if ( $l==1  && $are!=1 && $vt!=1 && $pie!=1 && $es!=1 && $ap!=1 && $an!=1  && $al!=1 && $ap!=1)  
                                     <th class="text-center">Total</th>
                                     @endif
                                       
                                        @if ($an==1)
                                        <th  class="text-center">Ancho 1</th>
                                        <th class="text-center">Ancho 2</th>
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Ancho Promedio </th>
                                        @endif

                                        {{-- El total cuando solo se tiene el ancho promedio --}}

                                        @if ($an==1 && $are!=1 && $vt!=1 && $pie!=1 && $es!=1  )
                                        <th  class="text-center">Total</th>
                                        @endif
                                        @if ($ap==1)
                                         
                                        <th class="text-center">Ancho</th>
                                        @endif

                                         {{-- Total cuando existe solamente una localizacion y un achoPromedio --}}
                                        @if ($ap==1 && $l==1  && $are!=1 && $vt!=1 && $pie!=1 && $es!=1 && $al!=1 )  
                                        <th class="text-center">Total</th>
                                        @endif

                                        @if ($are==1)
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Area</th>
                                        @endif


                                        @if ($al==1)
                                        <th class="text-center">Altura</th>
                                        @endif

                                           {{-- Total cuando existe solamente una localizacion altura un achoPromedio --}}
                                           @if ($ap==1 && $l==1  && $are!=1 && $vt!=1 && $pie!=1 && $es!=1 && $al==1 )  
                                           <th class="text-center">Total</th>
                                           @endif

                                 


                                        @if ($vtt==1)     
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Volumen total</th>
                                        @endif


                                        {{-- El total cuando se tiene longitud ancho promedio area --}}

                                        @if ($l==1 && $an==1 && $ap!=1 && $are==1 && $vtt!=1 && $pie!=1 && $es!=1 && $al!=1  )
                                        <th  class="text-center">Total</th>
                                        @endif

                                
                                        @if ($pie==1)     
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Pieza</th>
                                        @endif

                                        {{-- Cunado solo se tiene la pieza  --}}

                                        @if ($pie==1 && $l!=1 && $es!=1  )
                                        <th  class="text-center">Total</th>

                                        @endif

                                        {{-- Cunado se tiene longitud y pieza --}}
                                        @if ($pie==1 && $l==1 && $es!=1  )
                                        <th  class="text-center">Total</th>
                                        @endif


                                       



                                        @if ($es==1)     
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Espesor</th>
                                        @endif

                                         {{-- total cuando se tiene longitud ancho promedio pieza y espesor --}}
                                         @if ($l==1 && $an==1 && $ap!=1 && $are!=1 && $vt!=1 && $pie==1 && $es==1  )
                                         <th  class="text-center">Total</th>
                                         @endif


                                        <th class="text-center ">OPC</th>
                                      
                                    </tr></thead>
                                    <tbody>

                                  
                                        
                                        {{-- Cuerpo de la tabla --}}
                                        @foreach ($datosG as $key=> $dato)
                                          
                                      <td class="text-center bg-info">{{$key}}</td>

                           
                                        @if ($l==1)
                                        
                                       <td class="d-flex">
                                        <div class="col text-center">{{$dato->hombro_derecho1}}</div>
                                        <div class="col text-center">{{$dato->hombro_derecho2}}</div>
                                       <td class=" text-center" style="background-color: rgb(190, 191, 192)">{{$dato->hombro_derecho2-$dato->hombro_derecho1}}</td>
                                        @endif  
                                    </td>

                                    

                                  

                                     {{-- Opcion cuando se tiene la longitud  --}}
                                     @if ( $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 && $ap!=1 && $an!=1  && $al!=1 && $ap!=1)  
                                     <td class="text-center">{{$dato->hombro_derecho2-$dato->hombro_derecho1}}</td>
                                     <?php  $total_estimado2+= $dato->hombro_derecho2-$dato->hombro_derecho1;?>
                                     

                                     @endif
                                     

                                     @if ($an==1)
                                     <td class="text-center">{{$dato->ancho1}}</td>
                                       <td class="text-center">{{$dato->ancho2}}</td>
                                       <td class="text-center"  style="background-color: rgb(190, 191, 192)">{{($dato->ancho1+$dato->ancho2)/2}}</td>
                                     @endif

                                       {{-- pieza --}}

                                    @if ($pie==1)
                                    <td class=" text-center" style="background-color: rgb(190, 191, 192)">{{$dato->pieza}}</td>
                                    
                                @endif
                                     @if ($are==1)
                                     <td class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                     @endif
                                     
                                        {{-- El total cuando solo se tiene el ancho promedio --}}
                                        @if ($an==1 && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1  )
                                        <td  class="text-center">{{($dato->ancho1+$dato->ancho2)/2}}</td>
                                        <?php $total_estimado3+=($dato->ancho1+$dato->ancho2)/2;?>
                                        @endif

                     
                                    
                                    @if ($ap==1)
                                    <td  class="text-center">{{$dato->anchot}}</td>
                                    @endif

                                    @if ($al==1)
                                    <td  class="text-center">{{$dato->altura}}</td>
                                    @endif

                                    @if ($vtt==1 && $al==1)
                                    <td  class="text-center" style="background-color: rgb(190, 191, 192)">{{(($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)*$dato->altura)}}</td>
                                    <?php $vt+=(($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)*$dato->altura); ?>
                                    @endif

                                    @if ($vtt==1 && $al!=1)
                                    <td  class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                    <?php $vta+=($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2); ?>
                                    @endif


                                    @if ($es==1)
                                    <td  class="text-center" style="background-color: rgb(190, 191, 192)">{{$dato->espesor}}</td>
                                   
                                    @endif



                                      {{-- Total cuando existe solamente una localizacion altura un achoPromedio --}}
                                      @if ($ap==1 && $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 && $al==1 )  
                                      <td class="text-center">{{(($dato->hombro_derecho2-$dato->hombro_derecho1)*($dato->altura)*($dato->anchot))}}</td>
                                      <?php  $total_estimado1+= (($dato->hombro_derecho2-$dato->hombro_derecho1)*($dato->altura)*($dato->anchot)); ?>
                                      @endif


                                    {{-- Opcion cuando se tiene la longitud y ancho total --}}
                                    @if ($ap==1 && $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 &&  $al!=1)  
                                    <td class="text-center">{{($dato->hombro_derecho2-$dato->hombro_derecho1)*$dato->anchot}}</td>
                                    <?php  $total_estimado+= ($dato->hombro_derecho2-$dato->hombro_derecho1)*$dato->anchot; ?>
                                    @endif
                                    

                            
                                       
                                         
                                     {{-- Cunado solo se tiene la pieza  --}}

                                     @if ($pie==1 && $l!=1 && $es!=1  )       
                                      <td class="text-center ">{{ $dato->pieza}}</td>
                                     <?php $total_pieza1+= $dato->pieza;?>
                               

                                    
                                     @endif
                                       

                                       {{-- Cunado se tiene longitud y pieza --}}
                               
                                       @if ($pie==1 && $l==1 && $es!=1 && $an!=1  )
                                       <td class="text-center ">{{$dato->pieza}}</td>
                                       <?php $total_pieza+= $dato->pieza;?>
                                       @endif

                                          {{-- Cunado se tiene longitud y pieza y ancho promerdio --}}
                                        {{--ss  --}}
                                          @if ($pie==1 && $l==1 && $es!=1 && $an==1 && $are!=1  )
                                          <td class="text-center ">{{($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                          <?php $totalp+=($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2); ?>
                                     
                                          @endif

                                        {{-- El total cuando se tiene longitud ancho promedio area --}}
                                        @if ($l==1 && $an==1 && $ap!=1 && $are==1 && $vtt!=1 && $pie!=1 && $es!=1  )
                                        <th  class="text-center">{{($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)}}</th>
                                        <?php $total_estimado4+=($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2); ?>
                                        @endif



                                          {{--opc --}}

                                          @if ($l==1 && $an==1 && $ap!=1 && $are!=1 && $vtt!=1 && $pie==1 && $es==1  )
                                          {{$total=($dato->hombro_derecho2-$dato->hombro_derecho1)*(($dato->ancho1+$dato->ancho2)/2)*($dato->espesor)}}
                                            <th class="text-center"><?php  echo number_format($total, 2, '.', ','); ?></th>
                                            <?php $est+=$total ?>
                                          @endif
  
                                    
  
                         

                                       <th class="text-center  d-flex justify-content-around">

                                        <a href="{{route('Avance.edit',$dato->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                        <form action="{{route('Avance.destroy',$dato->id)}}"   method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                          </form>
                                       </th>
                                      

                                </tr>
                                @endforeach
                                @if ($l!=1 && $pie==1  )

      

                                @endif
                                 <tr>
                                    <td colspan="10" class="text-center bg-success"><strong>Hombro Izquierdo</strong><td>
                                </tr>
                                <th  class="text-center bg-info">Posicion</th>

                                <tbody>
                                   
                                    @foreach ($datosD as $key=>  $dato)
                                    <td class="text-center bg-info">{{$key}}</td>
                                    @if ($l==1)
                                        
                                    <td class="d-flex">
                                     <div class="col text-center">{{$dato->hombro_izquierdo1}}</div>
                                     <div class="col text-center">{{$dato->hombro_izquierdo2}}</div>
                                    <td class=" text-center" style="background-color: rgb(190, 191, 192)">{{$dato->hombro_izquierdo2-$dato->hombro_izquierdo1}}</td>
                                     @endif  
                                 </td>


                                  {{-- Opcion cuando se tiene la longitud  --}}
                                  @if ( $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 && $ap!=1 && $an!=1  && $al!=1 && $ap!=1)  
                                  <td class="text-center">{{$dato->hombro_izquierdo2-$dato->hombro_izquierdo1}}</td>
                                  <?php  $total_estimado2+= $dato->hombro_izquierdo2-$dato->hombro_izquierdo1;?>
                                  @endif
                                  

                                  @if ($an==1)
                                  <td class="text-center">{{$dato->ancho1}}</td>
                                    <td class="text-center">{{$dato->ancho2}}</td>
                                    <td class="text-center"  style="background-color: rgb(190, 191, 192)">{{($dato->ancho1+$dato->ancho2)/2}}</td>
                                  @endif

                                    {{-- pieza --}}

                                 @if ($pie==1)
                                 <td class=" text-center" style="background-color: rgb(190, 191, 192)">{{$dato->pieza}}</td>
                                 
                             @endif
                                  @if ($are==1)
                                  <td class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                  @endif
                                  
                                     {{-- El total cuando solo se tiene el ancho promedio --}}
                                     @if ($an==1 && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1  )
                                     <td  class="text-center">{{($dato->ancho1+$dato->ancho2)/2}}</td>
                                     <?php $total_estimado3+=($dato->ancho1+$dato->ancho2)/2?>
                                     @endif

                  
                                 
                                 @if ($ap==1)
                                 <td  class="text-center">{{$dato->anchot}}</td>
                                 @endif

                                 @if ($al==1)
                                 <td  class="text-center">{{$dato->altura}}</td>
                                 @endif

                                 @if ($vtt==1 && $al==1)
                                 <td  class="text-center" style="background-color: rgb(190, 191, 192)">{{(($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)*$dato->altura)}}</td>
                                 <?php $vt+=(($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)*$dato->altura); ?>
                                 @endif


                                 @if ($vtt==1 && $al!=1)
                                 <td  class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                 <?php $vta+=($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2); ?>
                                 @endif


                                 @if ($es==1)
                                 <td  class="text-center" style="background-color: rgb(190, 191, 192)">{{$dato->espesor}}</td>
                                 @endif



                                   {{-- Total cuando existe solamente una localizacion altura un achoPromedio --}}
                                   @if ($ap==1 && $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 && $al==1 )  
                                   <td class="text-center">{{(($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*($dato->altura)*($dato->anchot))}}</td>
                                   <?php  $total_estimado1+= (($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*($dato->altura)*($dato->anchot)); ?>
                                   @endif


                                 {{-- Opcion cuando se tiene la longitud y ancho total --}}
                                 @if ($ap==1 && $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 &&  $al!=1)  
                                 <td class="text-center">{{( $dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*$dato->anchot}}</td>
                                 <?php  $total_estimado+= ( $dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*$dato->anchot; ?>

                                 @endif
                                 

                          


                                    
                                      
                                  {{-- Cunado solo se tiene la pieza  --}}

                                  @if ($pie==1 && $l!=1 && $es!=1  )
                                   <td class="text-center " >{{ $dato->pieza}}</td>
                                   <?php $total_pieza1+= $dato->pieza;?>
                               
                                  
                                  @endif
                                    

                                    {{-- Cunado se tiene longitud y pieza --}}
                                    @if ($pie==1 && $l==1 && $es!=1   && $an!=1  )
                                    <td class="text-center">{{$dato->pieza}}</td>
                                    <?php $total_pieza+= $dato->pieza;?>
                                    @endif


                                      {{-- Cunado se tiene longitud y pieza y ancho promerdio --}}
                                        {{--ss  --}}
                                        @if ($pie==1 && $l==1 && $es!=1 && $an==1 && $are!=1  )
                                        <td class="text-center ">{{($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                        <?php $totalp+=($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2); ?>
                                   
                                        @endif

                                    
                                     


                                     {{-- El total cuando se tiene longitud ancho promedio area --}}

                                     @if ($l==1 && $an==1 && $ap!=1 && $are==1 && $vtt!=1 && $pie!=1 && $es!=1  )
                                     <th  class="text-center">{{($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)}}</th>
                                     <?php $total_estimado4+=($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2); ?>
                                     @endif



                                       {{--opc --}}

                                       @if ($l==1 && $an==1 && $ap!=1 && $are!=1 && $vtt!=1 && $pie==1 && $es==1  )
                                       {{$total=($dato->hombro_izquierdo2-$dato->hombro_izquierdo1)*(($dato->ancho1+$dato->ancho2)/2)*($dato->espesor)}}
                                         <th class="text-center"><?php  echo number_format($total, 2, '.', ','); ?></th>
                                         <?php $est+=$total ?>
                                         @endif
                                 
                                    <th class="text-center  d-flex justify-content-around">

                                     <a href="{{route('editar.izquierdo',$dato->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                     <form action="{{route('Avance.destroy',$dato->id)}}"   method="post">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                       </form>
                                    </th>
                                   
                                   
                                    {{-- inicio --}}

                             </tr>
                             @endforeach
                             @if ($ap==1 && $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 &&  $al!=1) 
                             <tr>

                                <td class="text-center" colspan="4"><strong>Total Estimado: </strong></td>
                                <td class="bg-info text-white text-center" ><?php echo $total_estimado?></td>
                             </tr>
                             <tr>
                              <td class="text-center" colspan="4"><strong>Volumen Contratado: </strong></td>
                              <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                           </tr>
                              <tr>
                                <td class="text-center" colspan="4"><strong>Volumen Excedente: </strong></td>
                                <td class="bg-info text-white text-center" ><?php if($total_estimado>$concepto->cantidad){ echo  $total_estimado-$concepto->cantidad;}else{echo 0;}  ?></td>
                            </tr>
                            <tr>
                              <td class="text-center" colspan="4"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                              <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                          </tr>
                          {{-- fin --}}

                          {{-- inicio  longitud anchototal y altura--}}
                             @endif
                             @if ($ap==1 && $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 && $al==1 )  
                             <tr>

                                <td class="text-center" colspan="5"><strong>Total Estimado: </strong></td>
                                <td class="bg-info text-white text-center" ><?php echo number_format( $total_estimado1, 2, '.', ',');  ?></td>
                          
                             </tr>

                             <tr>
                              <td class="text-center" colspan="5"><strong>Volumen Contratado: </strong></td>
                              <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                           </tr>
                              <tr>
                                <td class="text-center" colspan="5"><strong>Volumen Excedente: </strong></td>
                                <td class="bg-info text-white text-center" ><?php if($total_estimado1>$concepto->cantidad){ echo number_format($total_estimado1-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                            </tr>
                            <tr>
                              <td class="text-center" colspan="5"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                              <td class="bg-info text-white text-center" ><?php if($total_estimado1>$concepto->cantidad){echo number_format($concepto->cantidad,2,'.','.');}else{echo number_format( $total_estimado1, 2, '.', ','); }?></td>
                          </tr>
                             @endif

                             {{-- fin --}}

                             
                             {{-- Total cuando se tiene solo la longitud --}}
                             @if ( $l==1  && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1 && $ap!=1 && $an!=1  && $al!=1 && $ap!=1)  
                             <tr>

                                <td class="text-center" colspan="3"><strong>Total Estimado: </strong></td>
                                <td class="bg-info text-white text-center" ><?php echo number_format( $total_estimado2, 2, '.', ',');  ?></td>
                          
                             </tr>
                             <tr>
                              <td class="text-center" colspan="3"><strong>Volumen Contratado: </strong></td>
                              <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                              </tr>
                              <tr>
                                <td class="text-center" colspan="3"><strong>Volumen Excedente: </strong></td>
                                <td class="bg-info text-white text-center" ><?php if($total_estimado2>$concepto->cantidad){ echo number_format($total_estimado2-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                               </tr>
                               <tr>
                              <td class="text-center" colspan="3"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                              <td class="bg-info text-white text-center" ><?php echo number_format( $total_estimado2, 2, '.', ',');?></td>
                              </tr>
                             @endif

                              {{-- Total cuando se tiene solo la pieza y longitud  --}}
                              
                              
                              @if ( $pie==1 && $l==1 && $es!=1 && $an!=1  )   
                              <tr>
 
                                 <td class="text-center" colspan="4"><strong>Total Estimado: </strong></td>
                                 <td class="bg-info text-white text-center" ><?php echo number_format( $total_pieza, 0, '.', ',');  ?></td>
                           
                              </tr>

                              <tr>
                                <td class="text-center" colspan="4"><strong>Volumen Contratado: </strong></td>
                                <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                              </tr>
                              <tr>
                                  <td class="text-center" colspan="4"><strong>Volumen Excedente: </strong></td>
                                  <td class="bg-info text-white text-center" ><?php if($total_pieza>$concepto->cantidad){ echo number_format($total_pieza-$concepto->cantidad,0,'.','.');}else{echo 0;}  ?></td>
                               </tr>
                               <tr>
                                  <td class="text-center" colspan="4"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                                  <td class="bg-info text-white text-center" ><?php if($total_pieza>$concepto->cantidad){echo $concepto->cantidad;}else{echo $total_pieza;} ?></td>
                              </tr>
                              @endif
                      {{--fin  --}}

                              

                                {{-- Total cuando se tiene solo la pieza --}}
                                @if ( $pie==1 && $l!=1 && $es!=1  )   
                                <tr>
   
                                   <td class="text-center" colspan="2"><strong>Total Estimado: </strong></td>
                                   <td class="bg-info text-white text-center" ><?php echo number_format( $total_pieza1, 0, '.', ',');  ?></td>
                             
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="2"><strong>Volumen Contratado: </strong></td>
                                    <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                                  </tr>
                                  <tr>
                                      <td class="text-center" colspan="2"><strong>Volumen Excedente: </strong></td>
                                      <td class="bg-info text-white text-center" ><?php if($total_pieza1>$concepto->cantidad){ echo number_format($total_pieza1-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                                   </tr>
                                   <tr>
                                      <td class="text-center" colspan="2"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                                      <td class="bg-info text-white text-center" ><?php if($total_pieza1>$concepto->cantidad){echo $concepto->cantidad;}else{echo $total_pieza1;} ?></td>
                                  </tr>
                                @endif

                                 {{-- Total cuando se tiene el ancho promedio modificado--}}
                                 @if ( $l!=1 && $ap==1 &&  $an==1 && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1)   
                                 <tr>
    
                                    <td class="text-center" colspan="4"><strong>Total Estimado: </strong></td>
                                    <td class="bg-info text-white text-center" ><?php echo number_format( $total_estimado3*10, 2, '.', ',');  ?></td>
                              
                                 </tr>
                                 @endif


                                      {{-- El total cuando se tiene longitud ancho promedio area --}}
                                  @if ( $l==1 && $an==1 && $ap!=1 && $are==1 && $vtt!=1 && $pie!=1 && $es!=1  )   
                                  <tr>
     
                                     <td class="text-center" colspan="7"><strong>Total Estimado: </strong></td>
                                     <td class="bg-info text-white text-center" ><?php echo number_format( $total_estimado4, 2, '.', ',');  ?></td>
                               
                                  </tr>

                                  <tr>
                                    <td class="text-center" colspan="7"><strong>Volumen Contratado: </strong></td>
                                    <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                                 </tr>
                                    <tr>
                                      <td class="text-center" colspan="7"><strong>Volumen Excedente: </strong></td>
                                      <td class="bg-info text-white text-center" ><?php if($total_estimado4>$concepto->cantidad){ echo number_format($total_estimado4-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                                  </tr>
                                  <tr>
                                    <td class="text-center" colspan="7"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                                    <td class="bg-info text-white text-center" ><?php if($total_estimado4>$concepto->cantidad){echo number_format($concepto->cantidad,2,'.','.');}else{echo number_format( $total_estimado4, 2, '.', ','); }?></td>
                                </tr>
                                  @endif

                                  {{-- fin --}}

                                        {{-- El total cuando se tiene volumen total--}}
                                        @if ( $l==1 && $an==1 && $ap!=1 && $are==1 && $vtt==1 &&$al==1 && $pie!=1 && $es!=1  )   
                                        <tr>
           
                                           <td class="text-center" colspan="8"><strong>Total Estimado: </strong></td>
                                           <td class="bg-info text-white text-center" ><?php echo number_format( $vt, 2, '.', ',');  ?></td>
                                     
                                        </tr>
                                        <tr>
                                          <td class="text-center" colspan="8"><strong>Volumen Contratado: </strong></td>
                                          <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                                       </tr>
                                          <tr>
                                            <td class="text-center" colspan="8"><strong>Volumen Excedente: </strong></td>
                                            <td class="bg-info text-white text-center" ><?php if($vt>$concepto->cantidad){ echo number_format($vt-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                                        </tr>
                                        <tr>
                                          <td class="text-center" colspan="8"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                                          <td class="bg-info text-white text-center" ><?php if($vt>$concepto->cantidad){echo number_format($concepto->cantidad,2,'.','.');}else{echo number_format( $vt, 2, '.', ','); }?></td>
                                      </tr>



                                        @endif
                                  
                                        {{-- El total cuando se tiene volumen total y area no altura--}}
                                       @if ( $l==1 && $an==1 && $ap!=1 && $are==1 && $vtt==1 &&$al!=1 && $pie!=1 && $es!=1  )   
                                         <tr>
                                  
                                     <td class="text-center" colspan="7"><strong>Total Estimado: </strong></td>
                                       <td class="bg-info text-white text-center" ><?php echo number_format( $vta, 2, '.', ',');  ?></td>
                                                            
                                       </tr>

                                       <tr>
                                        <td class="text-center" colspan="7"><strong>Volumen Contratado: </strong></td>
                                        <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                                     </tr>
                                        <tr>
                                          <td class="text-center" colspan="7"><strong>Volumen Excedente: </strong></td>
                                          <td class="bg-info text-white text-center" ><?php if($vta>$concepto->cantidad){ echo number_format($vt-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                                      </tr>
                                      <tr>
                                        <td class="text-center" colspan="7"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                                        <td class="bg-info text-white text-center" ><?php if($vta>$concepto->cantidad){echo number_format($concepto->cantidad,2,'.','.');}else{echo number_format( $vta, 2, '.', ','); }?></td>
                                    </tr>

                                      @endif 


                                           
                                        {{-- El total cuando se tiene espesor y pieza--}}
                                        @if ($l==1 && $an==1 && $ap!=1 && $are!=1 && $vt!=1 && $pie==1 && $es==1 )
                                        <tr>
                                 
                                    <td class="text-center" colspan="8"><strong>Total Estimado: </strong></td>
                                      <td class="bg-info text-white text-center" ><?php echo number_format( $est, 2, '.', ',');  ?></td>
                                                           
                                      </tr>


                                     <tr>
                                      <td class="text-center" colspan="8"><strong>Volumen Contratado: </strong></td>
                                      <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                                   </tr>
                                      <tr>
                                        <td class="text-center" colspan="8"><strong>Volumen Excedente: </strong></td>
                                        <td class="bg-info text-white text-center" ><?php if($est>$concepto->cantidad){ echo number_format($est-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-center" colspan="8"><strong>Volumen Normal por cobrar en esta estimacion: </strong></td>
                                      <td class="bg-info text-white text-center" ><?php if($est>$concepto->cantidad){echo number_format($concepto->cantidad,2,'.','.');}else{echo number_format( $est, 2, '.', ','); }?></td>
                                  </tr>

                                     @endif 

                                
                                     {{-- el total cuando se tiene longitud y ancho promedio --}}
                                     @if ( $l==1 && $ap!=1&& $an==1 && $are!=1 && $vtt!=1 && $pie!=1 && $es!=1)   
                                     <tr>
        
                                        <td class="text-center" colspan="6"><strong>Total Estimado: </strong></td>
                                        <td class="bg-info text-white text-center" ><?php echo number_format( $total_estimado3*10, 2, '.', ',');  ?></td>
                                  
                                     </tr>

                                     <tr>
                                      <td class="text-center" colspan="6"><strong>Volumen Contratado: </strong></td>
                                      <td class="bg-info text-white text-center" >{{$concepto->cantidad}}</td>
                                   </tr>
                                      <tr>
                                        <td class="text-center" colspan="6"><strong>Volumen Excedente: </strong></td>
                                        <td class="bg-info text-white text-center" ><?php if($total_estimado3*10>$concepto->cantidad){ echo number_format($total_estimado3*10-$concepto->cantidad,2,'.','.');}else{echo 0;}  ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-center" colspan="6"><strong>Volumen Normal por cobrar en esta estimación: </strong></td>
                                      <td class="bg-info text-white text-center" ><?php if($total_estimado3*10>$concepto->cantidad){echo number_format($concepto->cantidad,2,'.','.');}else{echo number_format( $total_estimado3*10, 2, '.', ','); }?></td>
                                  </tr>
                                     @endif

                                    {{-- fin --}}

                                     {{-- Total cuando se tiene solo la pieza  longitud y ancho promedio  --}}
                              
                                        @if ( $pie==1 && $l==1 && $es!=1 && $an==1  )   
                                        <tr>
          
                                          <td class="text-center" colspan="7"><strong>Total Estimado: </strong></td>
                                          <td class="bg-info text-white text-center" ><?php echo number_format( $totalp, 2, '.', ',');  ?></td>
                                    
                                        </tr>
                                        @endif

                                       

                                        

                       
                            </tbody>

                                   
                                </table>
                            </div>
                        </div>
                    </div>  


                  


                  


                    </div>

                </div>
            </div>
        </div>

       
    </div>


</div>


@endsection

@section('scripts')
    <script src="{{ asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

    <script src="{{ asset('bundles/mainscripts.bundle.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js')}}"></script>
@endsection
