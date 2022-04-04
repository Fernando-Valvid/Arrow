@extends('layouts.panel')
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Afianzadoras</h2>
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

            <div class="col-lg-12 col-md-12 col-sm-12">
               
                <div class="card">


                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped text-center" >
                            <thead >
                                <tr >

                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">RFC</th>
                                    <th class="text-center">Razón social</th>
                                    <th class="text-center">Domicilio</th>
                                    <th class="text-center">Teléfono</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($afianzadoras as $afianzadora)
                                    <tr>
                                        <td>{{ $afianzadora->nombre}}</td>
                                        <td>{{ $afianzadora->rfc}}</td>
                                        <td>{{ $afianzadora->razon_social}}</td>
                                        <td>{{ $afianzadora->domicilio}}</td>
                                        <td>{{ $afianzadora->telefono}}</td>


                                        <td class="d-flex justify-content-around">
                                            @can('editar-afianzadora')
                                                <a  href="{{ route('afianzadoras.edit', $afianzadora->id) }}"><i class="zmdi zmdi-edit text-warning"></i></a>
                                            @endcan
                                            @can('borrar-afianzadora')
                                                {!! Form::open(['method' => 'DELETE','route' => ['afianzadoras.destroy', $afianzadora->id], 'style'=>'display:inline']) !!}
                
                                                <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                                {!! Form::close() !!}
                                            @endcan


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {!! $afianzadoras->links() !!}
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
