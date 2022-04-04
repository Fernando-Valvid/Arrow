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
                                       
                                        @if ($l==1 && $an!=1 && $al!=1 && $ap!=1 && $are!=1 &&   $vt!==1)
                                        <th>Total</th>
                                        @endif
                                        
                                        @if ($an==1)
                                        <th  class="text-center">Ancho 1</th>
                                        <th class="text-center">Ancho 2</th>
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Ancho Promedio </th>
                                        @endif

                                        @if ($al==1)
                                        <th class="text-center">Altura</th>
                                        @endif

                                        @if ($ap==1)
                                         
                                        <th class="text-center">Ancho</th>
                                        @endif


                                        @if ($are==1)
                                         
                                        
                                        <th  class="text-center" style="background-color: rgb(190, 191, 192)">Area</th>
                                        @endif


                                       
                                        @if ($vt==1  && $are==1 && $an==1  && $l==1 && $ap!=1 && $al==1 )
                                         
                                        <th class="text-center" style="background-color: rgb(190, 191, 192)">Volumen Total</th>
                                        @endif


                                        @if ($vt==1  && $are=1 && $an==1  && $l==1 && $ap!=1 && $al!=1  )
                                         
                                        <th class="text-center" style="background-color: rgb(190, 191, 192)">Volumen  Total</th>
                                        @endif

                                       
                                        {{-- <th class="text-center">PZA</th> --}}
                                      

                                        @if ($l==1 && $an==1 && $are==1 && $vt!=1 && $ap!=1  )
                                      
                                        <th class="text-center "> Total</th>
                                        @endif

                                        @if ($an==1  && $are!=1 && $vt!=1 && $ap!=1 && $l=1  )
                                      
                                        <th class="text-center "> Total</th>
                                        @endif


                                        @if ($ap==1  && $al=1 && $l=1  )
                                      
                                        <th class="text-center "> Total</th>
                                        @endif

                                     
                                        {{-- <th class="text-center">Total</th> --}}

                                        <th class="text-center ">OPC</th>
                                      
                                    </tr></thead>
                                    <tbody>
                                        
                                        @foreach ($datosG as $key=> $dato)
                                          
                                      <td class="text-center bg-info">{{$key}}</td>
                                            
                                        @if ($l==1)
                                        
                                       <td class="d-flex">
                                        <div class="col text-center">{{$dato->hombro_derecho1}}</div>
                                        <div class="col text-center">{{$dato->hombro_derecho2}}</div>
                                       <td class=" text-center" style="background-color: rgb(190, 191, 192)">{{$dato->hombro_derecho2-$dato->hombro_derecho1}}</td>
                                        @endif  
                                    </td>

                                    @if ($l==1 && $an!=1 && $al!=1 && $ap!=1 && $are!=1 &&   $vt!==1)
                                    <th>{{$dato->hombro_derecho1+$dato->hombro_derecho2}}</th>
                                    @endif
                                    

                                    @if ($an==1)
                                  
                                       <td class="text-center">{{$dato->ancho1}}</td>
                                       <td class="text-center">{{$dato->ancho2}}</td>
                                     
                               
                                    
                                       <td class="text-center"  style="background-color: rgb(190, 191, 192)">{{($dato->ancho1+$dato->ancho2)/2}}</td>
                              
                                 
                                       @endif 
                                        
                                       @if ($al==1)
                                       <td class="text-center">{{$dato->altura}}</td>
                                       @endif  

                                       
                                       @if ($are==1)
                                       <td class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_derecho1+$dato->hombro_derecho2)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                       @endif


                                       @if ($ap==1)
                                         
                                       <td class="text-center">{{$dato->anchot}}</td>
                                       @endif  

                                       
                                       @if ($ap==1  && $al=1 && $l=1  )
                                      
                                       <th class="text-center ">{{($dato->hombro_derecho2-$dato->hombro_derecho1)*$dato->altura*$dato->anchot}}</th>
                                       @endif


                                       <th class="text-center  d-flex justify-content-around">

                                        <a href="{{route('Avance.edit',$dato->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                        <form action="{{route('Avance.destroy',$dato->id)}}"   method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                          </form>
                                       </th>
                                      

                                       @if ($vt==1  && $are==1 && $an==1  && $l==1 && $ap!=1 && $al==1)
                                         
                                       <td class="text-center" style="background-color: rgb(190, 191, 192)">{{(($dato->hombro_derecho1+$dato->hombro_derecho2)*$dato->anchot)*($dato->altura)}}</td>
                                       @endif

                                       @if ($vt==1 && $are!=1  && $ap!=1 )
                                         
                                       <td class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_derecho1+$dato->hombro_derecho2)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                       @endif


                                       @if ($vt=1 && $are!=1  && $ap!=1 )
                                         
                                       <td class="text-center" style="background-color: rgb(190, 191, 192)">{{(($dato->hombro_derecho1+$dato->hombro_derecho2)*(($dato->ancho1+$dato->ancho2)/2))*($dato->altura)}}</td>
                                       @endif

                                         

                                       @if ($vt==1  && $are=1 && $an==1  && $l==1 && $ap!=1 && $al!=1   )----
                                         
                                       <td class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_derecho1+$dato->hombro_derecho2)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                       @endif

                                       @if ($l==1 && $an==1 && $are==1 && $vt!=1 && $ap!=1 )
                                
                                       <td class="text-center" style="background-color: rgb(190, 191, 192)">{{($dato->hombro_derecho1+$dato->hombro_derecho2)*(($dato->ancho1+$dato->ancho2)/2)}}</td>
                                        @endif  
                                       
                                       @if ($an==1  && $are!=1 && $vt!=1 && $ap!=1 && $l=1  )
                                      
                                       <th class="text-center ">{{($dato->ancho1+$dato->ancho2)/2}} </th>
                                       @endif

                                       <td class="text-center">{{$dato->espesor}}</td>

                                     
                     
                                       
                                       @if ($l==1 &&  $al==1 && $ap=1 && $vt!=1 )
                                      
                                       <th class="text-center ">{{($dato->hombro_derecho1+$dato->hombro_derecho2)*($dato->altura*$dato->anchot)}}</th>
                                       @endif

                                       @if ( $l==1 && $an==1 && $are==1 && $vt!=1 && $ap!=1 )
                                      
                                       <th class="text-center ">{{(($dato->hombro_derecho1+$dato->hombro_derecho2)*$dato->anchot)*($dato->altura)}}</th>
                                       @endif


                                       @if ($ap==1 && $an!=1 && $are!=1 && $vt!=1 && $ap!=1 && $l!=1  )
                                      
                                        <th class="text-center ">{{($dato->ancho1+$dato->ancho2)/2}} </th>
                                        @endif


                                       



                                      

                                      
                                      

                                </tr>
                                @endforeach
                         

                                <tr>
                                    <td colspan="10" class="text-center bg-success"><strong>Hombre Izquierdo</strong><td>
                                </tr>
                                <th  class="text-center bg-info">Posicion</th>

                                <tbody>
                                   
                                    @foreach ($datosD as $key=>  $dato)
                                    <td class="text-center bg-info">{{$key}}</td>
                                    @if ($l==1)
                                  
                                   <td class="d-flex">
                                    <div class="col text-center">{{$dato->hombro_izquierdo1}}</div>
                                    <div class="col text-center">{{$dato->hombro_izquierdo2}}</div>
                                   <td class=" text-center">calculando</td>
                                    @endif  
                                </td>

                                @if ($an==1)
                                         
                                <td class="text-center">{{$dato->ancho1}}</td>
                                <td class="text-center">{{$dato->ancho2}}</td>
                                <td class="text-center">Ancho promedio</td>
                                @endif 

                                @if ($al==1)
                                <td class="text-center">{{$dato->altura}}</td>
                                @endif  

                                @if ($ap==1)
                                  
                                <td class="text-center">{{$dato->anchot}}</td>
                                @endif  


                                @if ($ap==1)
                                  
                                <td class="text-center">{{$dato->anchot}}</td>
                                @endif  

                            

                                
                              

                            </tr>
                            @endforeach
                                
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
