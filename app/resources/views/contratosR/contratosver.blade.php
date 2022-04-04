@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')


<div class="container-fluid">
    <div class="block-header">

        <h2>Detalle Contrato</h2>
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
                <div class="header">
                    <h2>Información</h2>

                </div>
                <div class="body">
                    <div class="clearfix">
                        <div class="float-left">


                        </div>
                        <div class="float-right">
                            <h4>Contrato # <br>
                                <strong>{{$contratoUnion->contrato}}</strong>
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="float-left mt-20  text-center">
                                <address>
                                  <strong>Ubicación:</strong><br>
                                  {{$contratoUnion->ubicacion}}<br>

                                  </address>
                                  <address>
                                    <strong>Responsable de obra:</strong><br>
                                    {{$contratoUnion->name}}<br>

                                    </address>

                                    <address>
                                        <strong>Asistente de obra:</strong><br>
                                        {{$asistente->asistente_name}}<br>

                                        </address>
                            </div>
                            <br>





                            <div class="float-right mt-20">
                                <p><strong>Fecha de alta contrato: </strong>{{$contratoUnion->fecha_alta}}</p>
                                <p><strong>Fecha de inicio: </strong>{{$contratoUnion->fecha_inicio}}</p>
                                <p><strong>Fecha de termino: </strong>{{$contratoUnion->fecha_termino}}</p>

                                @if ($contratoUnion->estatus !=1)
                                <p class="m-t-10"><strong>Status: </strong> <span class="badge bg-green">Activo</span></p>
                                @else
                                <p class="m-t-10"><strong>Status: </strong> <span class="badge bg-red">Inactivo</span></p>

                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="mt-40"></div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr><th>Nombre de la obra</th>
                                        <th>Descripción</th>
                                        <th>Plazo dias</th>
                                        <th>Amortización</th>
                                        <th>Importe</th>
                                        <th>Cliente</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$contratoUnion->nombre_obra}}</td>
                                            <td>{{$contratoUnion->descripcion}}</td>
                                            <td>{{$contratoUnion->plazo_dias}}</td>
                                            <td>{{$contratoUnion->amortizacion}}</td>
                                            <td>{{$contratoUnion->importe}}</td>
                                            <td>{{$contratoUnion->nombre_cliente}}</td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 text-center">

                            <hr>
                            <a href="{{route('contratosR.index')}}" class="btn btn-raised btn-success">Regresar</a>
                        </div>
                    </div>


                    <br>
                 
                    <br><br>
                    <div class="row clearfix">

                        @foreach($imagenes as $imagen )
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="thumbnail card">
                                <div class="caption  body text-center">
                                <h3 class=""><img src="{{asset('img/usuarios/'.$imagen->imagen)}}" width="140" alt="velonic"></h3>
                                <p><strong>Descripción: <strong> {{ $imagen->descripcion }}</p>
                                    <a href="{{route('contratos.editarimagen',$imagen->id)}}" class="text-center btn btn-raised btn-sm btn-warning " >Editar</a>

                            <form action="" class=""  method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-sm btn-raised btn-danger">Eliminar</button>
                              </form>
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
