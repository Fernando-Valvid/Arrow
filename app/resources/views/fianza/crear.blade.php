@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Agregar Fianza contrato: {{$contrato->contrato}}</h2>
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
                           

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="header">

                                    </div>
                                    <div class="body">
                                        <form action="{{route('fianza.store')}}" method="POST">
                                            @csrf
                                        <div class="row clearfix">
                                           
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Contrato</b>
                                                    <div class="form-line">
                                                    
                                                        <select class="form-control" name="id_contrato">
                                                            <option value="{{$contrato->id}}" selected>{{$contrato->contrato}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Numero de fianza</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  name="num_fianza" placeholder="Numero de fianza">
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row clearfix">
                                            
                                            <div class="col-lg-6 col-md-6">
                                                <b>Monto</b>
                                                <div class="input-group icon">
                                                    <span class="input-group-addon"> <i class="material-icons">attach_money</i> </span>
                                                    <div class="form-line">
                                                        <input  min="0" step="0.01" type="number" step="any" name="monto" class="form-control money-dollar" placeholder="Ex: 99,99 $">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <b>Fecha</b>
                                                <div class="input-group icon">
                                                    <span class="input-group-addon"> <i class="material-icons">date_range</i> </span>
                                                    <div class="form-line">
                                                        <input type="date" name="fecha" class="form-control datetime" min="<?=date('Y-m-d',strtotime('1 days'));?>" value="{{$contrato->fecha_alta}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row clearfix">
                                            <div class="col-sm-12 text-center">
                                                <b class="text-center">Seleccione afianzadora</b>
                                                <select class="form-control"  name="id_afianzadora">
                                                @foreach ($afianzadoras as $afianza)
                                                    <option value="{{$afianza->id}}">{{$afianza->nombre}}</option>
                                                @endforeach

                                                </select>
                                            </div>
                                        
                                           
                                        </div><br> <br>
                                        <div class="col-sm-12">
                                            <center>
                                            <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                            <a href="{{ route('contratos.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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
		</div>

    </div>


@endsection

@section('scripts')
    

    <script>
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
