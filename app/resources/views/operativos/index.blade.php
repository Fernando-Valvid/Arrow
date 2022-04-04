@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Usuarios</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            <div>
                <a href="{{route('operativos.create')}}" class="btn btn-raised btn-success">Agregar usuario</a>
                <a class="btn btn-sm btn-raised btn-primary" href="{{ route('operativos.createPDF') }}">Exportar a PDF <i class="material-icons" style=" margin-bottom: 8px;">file_download</i> </a>
                 
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

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id}}</td>
                                        <td>{{ $usuario->name}}</td>
                                        <td>{{ $usuario->email}}</td>
                                        <td>{{ $usuario->rol}}</td>

                                         <td class="d-flex justify-content-around">
                                 
                                            @if ($usuario->estatus ==1)
                                            <a class="btn btn-raised bg-info btn-sm text-center"  href="{{route('operativos.show',$usuario->id)}}"><i class="material-icons text-white">visibility</i></a>
                                            <p ><span class="badge bg-red mt-4" style="font-size: 13px; margin:auto">Inactivo</span></p>
                                            @else
                                            <a class="btn btn-raised bg-amber btn-sm text-center " href="{{route('operativos.edit',$usuario->id)}}">
                                                <i class="material-icons mb-1">create</i>
                                            </a>

                                            <a class="btn btn-raised bg-info btn-sm text-center"  href="{{route('operativos.show',$usuario->id)}}"><i class="material-icons text-white">visibility</i></a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['operativos.destroy', $usuario->id], 'style'=>'display:inline']) !!}
                                                {{ Form::button('<i class="material-icons mb-1">delete_forever</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-raised  btn-sm text-center'] )  }}
                                            {!! Form::close() !!}
                                            @endif

                                           
                                        </td>



                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {{-- {!! $usuarios->links() !!} --}}
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
