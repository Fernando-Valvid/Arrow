@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
          
            <h2>Codigo de la obra</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
          
        </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card mt-4">
                        <div class="header text-center mt-3">
                            <h2 class="mt-4">Editar Codigo principal de la obra</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-more-vert"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
        
                            <div class="row clearfix">
                                <div class="col-md-8 col-sm-12  ">
                                    {{-- <form action="{{route('codigos.store')}}" method="POST"> --}}
                                        {{-- {!! Form::open(array('route' => ['codigos.update',$concepto->id], 'method' => 'POST', 'file' => true, 'enctype' => 'multipart/form-data' )) !!}
                                         --}}
                                        {!! Form::model($concepto, ['method' => 'PUT',  'file' => true, 'enctype' => 'multipart/form-data',  'route'=>  ['codigos.update',$concepto->id]]) !!}
                                        {{-- 'route'=> ['contratos.actualizarimagen',$imagen->id]]) --}}
                                        
                                        @csrf

                                        <div class="col-sm-6">
                                            <select class="form-control show-tick" id="empresa" name="id_contrato"  required>
                                                <option value="{{$contrato->id}}" selected>{{$contrato->contrato}}</option>
                                            </select>
                                        </div>

                                    <div class="form-group p-3">
                                        <div class="form-line ">
                                            <input type="text" class="form-control" name="codigo" value="{{$concepto->codigo}}" placeholder="Codigo">
                                          
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 p-3">
                                    <div class="form-group p-3">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="concepto" placeholder="Descripcion">{{$concepto->concepto}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3  mr-5 text-center">
                                <label class="text-center">Imagen Actual del croquis</label><br>
                                <img class="m-auto" src="{{asset('img/usuarios/'.$concepto->imagen)}}"  style="width: 230px; height:220px;"  alt="" >
                            </div>

                            <div class="col-lg-5 col-md-4 col-sm-12 m-2">
                                    <label class="mb-3"><strong>Imagen  del croquis</strong></label><br>
                                <input type="file" name="croquis"   accept="image/*" />
       
                        </div>
                            
                            <div class="row clearfix">
                               
                                <div class="col-sm-12  d-flex justify-content-center">
                                    <button type="submit" class="btn btn-raised g-bg-blush2">Guardar</button>
                                    <button type="submit" class="btn btn-raised btn-default">Cancelar</button>
                                </div>
                                {!! Form::close() !!}
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
