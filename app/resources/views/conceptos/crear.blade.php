@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')


    <div class="block-header">

        <div class="block-header">
            <h2>Agregar Concepto</h2>
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
      
        
    </div>
    <div class="row clearfix p-2">
        <div class="col-lg-12 col-md-12 col-sm-12">
           
            <div class="card">
                <div class="header text-center">
                    <h2>Descripcion del concepto </h2>
                </div>
                <div class="body">
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
                    <form action="{{route('conceptosec.store')}}" method="POST">
                    @csrf
                    <div class="row clearfix m-auto">
                
                        <div class="col-lg-12 col-md-12">
                           
                            <select class="form-control show-tick text-center" name="id_codigo"  required>
                                <option value="{{$concepto->id}}" selected><strong>{{$concepto->codigo}}</strong> {{$concepto->concepto}}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text"   class="form-control text-center" name="codigo"  value="{{old('codigo')}}" placeholder="Codigo del concepto">
                                </div>
                            </div>
                        </div>
    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea style="height: 100px" class="form-control no-resize" name="concepto" placeholder="Descripcion">{{old('concepto')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix m-auto">

                        <div class="col-sm-2 focused mt-3 mb-3" >
                            <label>Unidades</label>
                            <select class="form-control show-tick" name="id_unidad">
                                @foreach ($unidades as $unidad)
                                <option value="{{$unidad->id}}"> {{$unidad->nombre}}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="input-group icon  mt-5">

                                <div class="form-line">
                                    <input  min="0" step="0.01" type="number" step="any" name="cantidad"  value="{{old('punitario')}}"class="form-control money-dollar" placeholder="Cantidad">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4">
                            <div class="input-group icon  mt-5">
                                <span class="input-group-addon"> <i class="material-icons">attach_money</i> </span>
                                <div class="form-line">
                                    <input  min="0" step="0.01" type="number" step="any" name="punitario"  value="{{old('punitario')}}" placeholder="Precio Unitario Ex: 99.99 $" class="form-control money-dollar" placeholder="Cantidad Ex: 99.99 $">
                                </div>
                            </div>
                        </div>
                       
                       
                        
                    </div>
                    <div class="row clearfix m-auto">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="precio_letra" value="{{old('precio_letra')}}" placeholder="Precio con letra">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="importe" value="{{old('importe')}}" placeholder="Importe">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="porcentaje" value="{{old('porcentaje')}}" placeholder="porcentaje">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix mt-3">                            
                     
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-raised g-bg-blush2">Guardar</button>
                            <a href="{{ URL::previous() }}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
