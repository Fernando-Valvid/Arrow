@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Concepto de contratos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                @can('crear-afianzadora')
                    <a href="{{ route('afianzadoras.create') }}" class="btn btn-raised btn-success">Agregar afianzadora</a>
                @endcan

                @if (session('mensaje_error'))
                <div class="alert alert-danger" role="alert">
                  {{session('mensaje_error')}}
                </div>
                @endif
               
            </div>
        </div>



        <!-- Exportable Table -->
        <div class="row clearfix"> 
            <!-- Colorful Panel Items With Icon -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header text-center p-2">
                      
        
                         @if ($codigo ==null)
                        <h2> Aun no agregas un codigo a la obra con el  contrato: <strong> {{$contrato->contrato}}</strong></h2>
                        <a href="{{route('codigo.crear',$contrato->id)}}" class="btn  btn-raised btn-info waves-effect">Generar codigo de la obra</a>
                     @else 
                   
                        <div class="row  d-flex flex-wrap">
                     <div class="col-lg-8  m-auto">
                        <strong class="mb-2"> {{$contrato->contrato}}</strong>
                        <h2 class="mt-2"> CONCEPTOS DE LA OBRA: <strong>{{$codigo->codigo}}, {{$codigo->concepto}}</strong></h2>
                    
                    </div>

                    <div class="col-3">
                        <a href="{{route('codigos.edit',$codigo)}}" class="btn  btn-raised btn-info waves-effect">Editar conceptos</a>
                    </div>
                </div>
                       
                        {{-- @foreach ($codigo as $cod)
                        <p><strong>{{$cod->codigo}} {{$cod->concepto}}</strong></p>
                        @endforeach
         --}}
                       
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                             
                                
                         
                                {{-- Boton lista de conceptos --}}
                                {{-- <a href="" class="btn btn-raised g-bg-blush2">Lista de conceptos Obra</a> --}}
                                <a href="{{route('conceptos.nuevo',$codigo->id)}}" class="btn btn-raised g-bg-blush2">Nuevo Concepto</a>

                           
                                @if ($conceptose !=0)
                                    <a href="{{route('concepto.eliminados',$codigo->id)}}" Class="btn btn-raised g-bg-blush2">Conceptos Eliminados</a>
                                
                                @endif
                               
                               
                             
                              
                            </div>
                            @foreach ($conceptos as $concepto)
                            <div class="col-xs-4 ol-sm-8 col-md-8 col-lg-8">
                              
                                {{-- @foreach ($conceptos as $concepto) --}}
                                <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-grey">
                                        <div class="panel-heading" role="tab" id="headingOne_17">
                                            <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#{{$concepto->codigo}}" 
                                                aria-expanded="true" aria-controls="collapseOne_17"> <i class="material-icons">perm_contact_calendar</i> 
                                           {{ $concepto->concepto}} </a> </h4>
                                        </div>
                                        <div id="{{$concepto->codigo}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">
                                            <div class="panel-body d-flex flex-wrap justify-content-center "> 

                                                <a type="button" href="{{route('concepto.create',$concepto->id)}}" class="btn  btn-raised btn-info waves-effect">Agregar Conceptos</a>    
                                                <a type="button" href="{{route('conceptosec.show',$concepto->id)}}"class="btn  btn-raised btn-success waves-effect">Lista de conceptos</a>  
                                                <a type="button" href="{{route('concepto.edit',$concepto->id)}}"class="btn  btn-raised btn-warning waves-effect">Editar Concepto</a>  
                         
        
                                                <form action="{{route('secundario.delete',$concepto->id)}}" class="m-auto text-center "  method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-raised btn-danger">Eliminar Concepto</button>
                                                  </form>
        
                                            </div>
                                        </div>
                                    </div>
                                   
                                   
                                </div>
                          
                         
                            </div>
                            
                            @endforeach
                            @endif
                            
                        </div>
                    </div>
                 
                </div>
            </div>
        
        </div>
        <!-- #END# Exportable Table -->
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
