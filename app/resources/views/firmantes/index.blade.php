@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">

            <h2>Firmantes de contratos</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
            @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
              {{session('mensaje')}}
            </div>
            @endif
            <div>
                <a href="firmantes/create" class="btn btn-raised btn-success">Agregar firmante</a>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">

                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                   
                                    <th class="text-center">Nombre de firmante</th>
                                    <th class="text-center">Cargo</th>
                                    <th class="text-center">Contrato</th>


                                    <th class="text-center">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                 @foreach ($contratos as $contrato)


                                <tr>
                                    
                                    <td class="text-center">{{$contrato->nombre.' '.$contrato->paterno.' '.$contrato->materno}}</td>
                                    <td class="text-center">{{$contrato->cargo}}</td>
                                    <td class="text-center">{{$contrato->contrato}}</td>
                                    <td class="d-flex justify-content-around">

                                        <a href="{{route('firmantes.edit',$contrato->id)}}" class="edit"><i class="zmdi zmdi-edit text-warning"></i></a>
                                       
                                      
    
                                       <form action="{{route('firmantes.destroy',$contrato->id)}}"   method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="cursor: pointer; background: transparent; border:0px;"><i class="material-icons text-danger">delete</i></button>
                                      </form>
    
                               
                                    </td>
                                
                                  
                                </tr>
                                @endforeach 

                            </tbody>
                        </table>
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
