@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Usuario operativo</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            
        </div>

        @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
          {{session('mensaje')}}
        </div>
        @endif

        @if (session('mensaje_error'))
        <div class="alert alert-danger" role="alert">
          {{session('mensaje_error')}}
        </div>
        @endif
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center" > <strong>Información del usuario operativo </strong></h2>
                    </div>
                    <div class="body text-center " style="font-size:18px;"> 
                        <img class="img-fluid mb-3" src="{{asset('img/usuarios/'.$usuario->photo)}}" style="margin: auto; width: auto; height: auto;"><br>
                        <br> <strong>Nombre:</strong>
                        {{$usuario->name}}</p>
                        <strong>Email: </strong>{{$usuario->email}}</p>
                        <strong>Rol: </strong>{{$rol->name}}</p>
                        @if ($usuario->estatus !=1)
                        <p class="m-t-10"><strong>Estado: </strong> <span class="badge bg-green">Activo</span></p>
                        @else
                        <p class="m-t-10"><strong>Estado: </strong> <span class="badge bg-red">Inactivo</span></p>
                        <a href="{{route('operativo.activar',$usuario->id)}}" class="btn btn-raised btn-success m-auto" >Activar Usuario</a>
                        @endif
                    </div>
                </div>
              
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body"> 
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#mypost">Contratos Activos</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#timeline">Contratos Inactivos</a></li>
                           
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane in active" id="mypost">
                                <div class="wrap-reset">
                                   @foreach ($contratosA as $contrato)
                                       
                                 
                                    <div class="mypost-list">
                                       
                                            <div class="post-img"><img src="assets/images/puppy-1.jpg" class="img-fluid" alt /></div>
                                            <div>
                                                <h4 class="text-center">{{$contrato->contrato}}</h4>
                                                <div class="post-box text-center mb-4"> <span class="text-muted text-small mb-3">Fecha de inicio: {{$contrato->fecha_inicio}}
                                                Fecha Fin:{{$contrato->fecha_termino}}</span>
                                                <br><p class=" mt-3 mb-2" style="font-size: 16px"><strong>Nombre de la Obra:</strong> {{$contrato->nombre_obra}} </p>
                                                <p class="mb-2" style="font-size: 16px"><strong>Descripcion:</strong> {{$contrato->descripcion}} </p>
                                                <p class="mb-2" style="font-size: 16px"> <strong>Ubicación:</strong> {{$contrato->ubicacion}} </p>
                                                <p ><strong>Estado del contrato: </strong> <span class="badge bg-green">Activo</span></p>
                                                <hr>
                                               
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach


                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="timeline">
                                <div class="wrap-reset">
                                    @foreach ($contratosI as $contrato)
                                        
                                  
                                     <div class="mypost-list">
                                        
                                             <div class="post-img"><img src="assets/images/puppy-1.jpg" class="img-fluid" alt /></div>
                                             <div>
                                                 <h4 class="text-center">{{$contrato->contrato}}</h4>
                                                 <div class="post-box text-center mb-4"> <span class="text-muted text-small mb-3">Fecha de inicio: {{$contrato->fecha_inicio}}
                                                 Fecha Fin:{{$contrato->fecha_termino}}</span>
                                                 <br><p class=" mt-3 mb-2" style="font-size: 16px"><strong>Nombre de la Obra:</strong> {{$contrato->nombre_obra}} </p>
                                                 <p class="mb-2" style="font-size: 16px"><strong>Descripcion:</strong> {{$contrato->descripcion}} </p>
                                                 <p class="mb-2" style="font-size: 16px"> <strong>Ubicación:</strong> {{$contrato->ubicacion}} </p>
                                                 <p class="m-t-10"><strong>Estado del contrato: </strong> <span class="badge bg-red">Inactivo</span></p>
                                                 <hr>
                                                
                                             </div>
                                         </div>
                                     </div>
 
                                     @endforeach
 
 
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
