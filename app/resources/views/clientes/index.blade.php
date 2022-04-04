@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Clientes</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                <a href="{{ route('clientes.create') }}" class="btn btn-raised btn-success">Agregar cliente</a>
            </div>
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
            @foreach ($clientes as $cliente)
            
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card all-patients">
                    <div class="body">
                            <div class="col-lg-12 col-md-12 m-b-0 text-center">
                                <h5 class="">{{$cliente->nombre}}  </h5>
                                <address class="">
                                    Correo:   {{$cliente->email}} <br>
                                    <abbr title="Phone">Teléfono:</abbr>  {{$cliente->telefono}}
                                </address>
                         
                            <div class="col-lg-12 col-md-12">
                                <a href="{{route('clientes.edit', $cliente->id )}}" class="edit ml-2"><i class="zmdi zmdi-edit text-warning"></i></a>
                                {!! Form::open(['method' => 'DELETE','route' => ['clientes.destroy', $cliente->id], 'style'=>'display:inline']) !!}
                                {{-- {{ Form::button('<i class="material-icons mb-1">delete_forever</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm text-center'] ) }} --}}
                                <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
