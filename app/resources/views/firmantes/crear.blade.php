@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Agregar firmante a contrato</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
                        @if (session('mensaje_error'))
                        <div class="alert alert-danger" role="alert">
                          {{session('mensaje_error')}}
                        </div>
                        @endif
					</div>
					<div class="body">
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
                            <div class="col-md-12">
                            <form action="{{ route('firmantes.store') }}" method="POST">
                                @csrf






                                <div class="row m-2">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group drop-custum">
                                            <select class="form-control show-tick" id="id_empleado_cargo" name="id_empleado_cargo" required>
                                            <option value="0" selected>--Seleccione un firmante--</option>

                                              @foreach ($cargosasignados as $cargo)
                                              <option value="{{$cargo->id}}" >{{$cargo->nombre.' '. $cargo->paterno .' '. $cargo->materno}}</option>
                                             @endforeach
                                            </select>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group  drop-custum">
                                            <select class="form-control show-tick" id="id_contrato" name="id_contrato">
                                                <option value="0">-- Seleccione un contrato --</option>
                                                @foreach ($contratos as $contrato)
                                              <option value="{{$contrato->id}}" >{{$contrato->contrato}}</option>
                                             @endforeach
                                             
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    

                                </div>

                                <br/>
                                <br/>
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                    <a href="{{ route('firmantes.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
                                    </center>
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


    {{-- <script>
    let $empleado;

    $(function(){
        

            if($tipoe=='em'){
                document.getElementById('cliente').style.display = 'none';
                document.getElementById('empresa').style.display = 'inline-block';
                 document.getElementById("cliente").value = '0';





            }else if($tipoe=='cl'){
                document.getElementById('cliente').style.display = 'inline-block';
                document.getElementById('empresa').style.display = 'none';
                document.getElementById("empresa").value='0';

            }else{
                document.getElementById('cliente').style.display = 'none';
                document.getElementById('empresa').style.display = 'none';
            }

    
    });


    </script> --}}

@endsection
