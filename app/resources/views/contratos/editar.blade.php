@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('contenido')
<div class="container-fluid">
        <div class="block-header">
            <h2>Agregar usuario</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>

        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
                       

                        @if (session('mensaje'))
                        <div class="alert alert-danger" role="alert">
                          {{session('mensaje')}}
                        </div>
                        @endif

                        @if (session('mensaje_error'))
                        <div class="alert alert-danger" role="alert">
                          {{session('mensaje_error')}}
                        </div>
                        @endif
                        <div id="error_fecha" class="alert alert-danger" style="display: none">
                            <strong>Alerta!</strong> Porfavor seleccione una fecha valida en inicio y termino
                        </div>
					</div>
					<div class="body">                        
                        <div class="row clearfix">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>!Revise los campos¡</strong>
                                        @foreach ($errors->all() as $error)
                                            <span >{{ $error }}</span>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                            @endif
                            <div class="col-md-12">                                                                          
                            <form action="{{route('contratos.update',$contrato->id)}}" method="POST">
                                @csrf
                                @method('PUT')
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="contrato" class="form-control" value="{{$contrato->contrato}}" placeholder="Contrato">
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="nombre_obra" class="form-control" value="{{$contrato->nombre_obra}}" placeholder="Nombre de la obra">
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
        <div class="form-line">
            <textarea  style="height: 100px" class="form-control"  id="descripcion" name="descripcion"  placeholder="Descripcion" >{{$contrato->descripcion}}</textarea>
        </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="form-line">
            <label for="start">Fecha alta</label>
                <input type="Date"   name="fecha_alta" value="{{$contrato->fecha_alta}}" class="form-control"  placeholder="Fecha de inicio">
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
             <div class="form-line">
                <textarea  style="height: 100px" class="form-control"  id="ubicacion" name="ubicacion" placeholder="Ubicación" >{{$contrato->ubicacion}}</textarea>
             </div>
         </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
            <label for="start">Fecha inicio</label>
            <input type="Date"  value="{{$contrato->fecha_inicio}}" name="fecha_inicio" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de alta">
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
            <label for="start">Fecha termino</label>
            <input type="Date"  value="{{$contrato->fecha_termino}}" id="fecha_termino" name="fecha_termino" class="form-control" placeholder="Fecha de termino">
            </div>
        </div>
    </div>
    <!--<div class="col-md-6 col-sm-12">
        <div class="form-group drop-custum">
            <select class="form-control show-tick">
                <option value="">--Seleccionar encargado de obra--</option>
                <option value="1">Bryan</option>
                <option value="2">Isaac</option>
                <option value="3">Oscar</option>
            </select>
        </div>    
    </div> -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="number" name="plazo_dias"  value="{{$contrato->plazo_dias}}" class="form-control" placeholder="Plazo de dias">
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="number" name="importe" class="form-control"  value="{{$contrato->importe}}" placeholder="$ Importe">
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <input type="number" name="amortizacion"  value="{{$contrato->amortizacion}}" class="form-control" placeholder="Amortización">
            </div>
        </div>
    </div>
                <div class="col-sm-6 focused mt-3">
                                <select class="form-control show-tick" name="id_empresa">
                                    <option value="{{$contrato->id_empresa}}" selected>{{$contrato->nombre_empresa}}</option>
                                </select>
                            </div>
                            <div class="col-sm-6 focused mt-3 mb-3" >
                                <select class="form-control show-tick" name="id_cliente">
                                    <option value="">-- Cliente --</option>
                                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}"  @if ($contrato->id_cliente == $cliente->id)  selected  @endif  >{{$cliente->nombre}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-sm-6 focused mt-3">
                                <select class="form-control show-tick" name="id_responsable">
                                    <option value="0">-- Responsable de Obra --</option>
                                    @foreach ($responsables as $responsable)
                        <option value="{{$responsable->id}}"   @if ($contrato->id_user == $responsable->id)  selected  @endif  >{{$responsable->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-sm-6 focused mt-3 mb-3">
                                <select class="form-control show-tick" name="id_asistente">
                                    <option value="0">-- Asistente de Obra --</option>
                                    @foreach ($asistentes as $asis)
                        <option value="{{$asis->id}}" @if ($asistente->asistente_id == $asis->id)  selected  @endif >{{$asis->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        <br>
                        <br>
                    
    <div class="col-sm-12 mt-4 d-flex justify-content-center">
        <button type="submit" class="btn btn-raised g-bg-blush2">Editar</button>
        <button type="submit" class="btn btn-raised btn-default">Cancelar</button>
    </div>   
</div>
</form>
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

    <script>

$(function(){
    var today = new Date();
    // $('#fecha_inicio').val();
    $('#fecha_inicio').change(()=>{
        $inicio=$("#fecha_inicio").val();
        console.log($inicio);   
        $termino=$("#fecha_termino").val();
        console.log($termino); 

    if($inicio>$termino){
        // alert("revisa las fechas");
        document.getElementById("error_fecha").style.display='block';
 
        // error_fecha
    }else{
        document.getElementById("error_fecha").style.display = 'none';
    }

    

    //  document.getElementById("fecha_termino").max=today;
        // $("#fecha_termino").setAttribute("max",today);

        
    });

    $('#fecha_termino').change(()=>{
        $termino=$("#fecha_termino").val();
        console.log($inicio);   
        $inicio=$("#fecha_inicio").val();
        console.log($termino); 

    if($termino>$inicio){
        // alert("revisa las fechas");
      
        document.getElementById("error_fecha").style.display = 'none';
 
        // error_fecha
    }else{
        document.getElementById("error_fecha").style.display='block';
    }

    

    //  document.getElementById("fecha_termino").max=today;
        // $("#fecha_termino").setAttribute("max",today);

        
    });
});

    </script>
@endsection
