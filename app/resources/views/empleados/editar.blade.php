@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar Empleado</h2>
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
                            <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                                @method('PUT');
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="{{$empleado->nombre}}"  id="nombre" name="nombre" placeholder="Nombre" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="{{$empleado->apellido_paterno}}"  id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"   value="{{$empleado->apellido_materno}}"  id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" >
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row m-2">
                                   
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control"  id="num_casa" name="num_casa" value="{{$empleado->num_casa}}" placeholder="Ingrese su número de casa*" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control"  id="num_cel" name="num_cel"  value="{{$empleado->num_cel}}" placeholder="Ingrese su número telefonico" >
                                            </div>
                                        </div>
                                    </div>

                                </div> 

                                <div class="col-sm-6">
                                    <select class="form-control show-tick" id="tipo_empleado" name="tipo_empleado">
                                        <option value="0">-- Seleccione tipo de empleado --</option>
                                        <option value="em" @if ($empleado->tipo_empleado=='em') selected  @endif >Empresa</option>
                                        <option value="cl" @if ($empleado->tipo_empleado=='cl') selected  @endif>Cliente</option>
                                     
                                    </select>
                                </div>



                                 <div class="col-md-6 col-sm-12">
                                    <div class="form-group drop-custum">
                                    <select class="form-control show-tick" id="cliente" name="id_cliente" required>
                                    <option value="0" selected>--Seleccione un cliente--</option>

                                     @foreach ($clientes as $cliente)
                                     <option value="{{$cliente->id}}" @if ($empleado->id_cliente == $cliente->id) selected  @endif   >{{$cliente->nombre}}</option>
                                     @endforeach   
                                    </select>
                                    </div>
                                </div> 

                             
                                <div class="col-sm-6">
                                    <select class="form-control show-tick" id="empresa" name="id_empresa"  required>
                                        <option value="0"  selected>--Seleccione una empresa--</option>
                                        <option value="{{$empresa->id}}"  @if ($empleado->id_empresa == $empresa->id) selected  @endif   id="opc">{{$empresa->nombre}}</option>
                                     
                                    </select>
                                </div>
 




                                <br/>
                                <br/>
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                    <a href="{{ route('empleados.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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
    

    <script>


$(document).ready(function(){
    
    $tipo=$('#tipo_empleado').val();
    console.log($tipo);

    if($tipo=='em'){
        document.getElementById('cliente').style.display = 'none';
                document.getElementById('empresa').style.display = 'inline-block';
                 document.getElementById("cliente").value = '0';

    }else{
        document.getElementById('cliente').style.display = 'inline-block';
                document.getElementById('empresa').style.display = 'none';
                document.getElementById("empresa").value='0';
    }

});




    let $empleado;

    $(function(){
        $('#tipo_empleado').change(()=>{
            $tipoe=$("#tipo_empleado").val();
            console.log($tipoe);

           

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

            // $empresas=$("#em").val();
        
            // if($rol=='Responsable de empresa' &&  $empresas !== null){
            //     document.getElementById('empresa').style.display = 'block';
            //     document.getElementById('boton').style.display = 'inline-block';           
            // }

            // else{
            //     document.getElementById('empresa').style.display = 'none';
            //     document.getElementById('boton').style.display = 'none';
            //     document.getElementById('alerta').style.display = 'block';
            // }

            // if($rol !='Responsable de empresa'){
            //     document.getElementById('boton').style.display = 'inline-block';
            //     document.getElementById('alerta').style.display = 'none';
            // }
        });
    });


    </script>
    
@endsection 
