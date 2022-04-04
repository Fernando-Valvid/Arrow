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
                    <div class="row clearfix">
                        @if ($errors->any())
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>!Revise los campos¡</strong>
                                        @foreach ($errors->all() as $error)
                                            <span >{{ $error }}</span>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            </div>
                        @endif
                    <div class="card mt-4">
                        <div class="header text-center mt-3">
                            <h2 class="mt-4">Codigo principal de la obra</h2>
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
                            <form action="{{route('secundario.crear')}}" method="POST">
                                @csrf
                            <div class="row clearfix ">
                           
                                <div class="col-sm-4 m-auto">
                                    <label class="m-2">Codigo principal del contrato:</label>
                                    <select class="form-control show-tick text-center" name="id_codigo"  required>
                                        <option value="{{$concepto->id}}" selected>{{$concepto->codigo}}</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-10 col-sm-12 p-2 m-4">       
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo Ej:">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12 p-2 m-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="concepto" placeholder="Descripcion"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                               
                                <div class="col-sm-12  d-flex justify-content-center">
                                    <button type="submit" class="btn btn-raised g-bg-blush2">Guardar</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
                                </div>
                           
                            </div>
                        </form>
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
