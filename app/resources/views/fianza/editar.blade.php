@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar fianza</h2>
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
                                        <form action="{{route('fianza.update',$fianza->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                        <div class="row clearfix">
                                           
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Contrato</b>
                                                    <div class="form-line">
                                                    
                                                         <select class="form-control" name="id_contrato">
                                                            <option value="{{$fianza->id_contrato}}" selected>{{$fianza->name}}</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 m-auto">
                                                <div class="form-group">
                                                    <b>Numero de fianza</b>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  name="num_fianza" value="{{$fianza->num_fianza}}" placeholder="Numero de fianza">
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
                                                        <input  min="0" step="0.01" type="number" value="{{$fianza->monto}}" step="any" name="monto" class="form-control money-dollar" placeholder="Ex: 99,99 $">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <b>Fecha</b>
                                                <div class="input-group icon">
                                                    <span class="input-group-addon"> <i class="material-icons">date_range</i> </span>
                                                    <div class="form-line">
                                                        <input type="date" name="fecha" class="form-control datetime" min="<?=date('Y-m-d',strtotime('-5 day'));?>" value="{{$fianza->alta}}"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row clearfix">
                                            <div class="col-sm-12 text-center">
                                                <b class="text-center">Seleccione afianzadora</b>
                                                <select class="form-control"  name="id_afianzadora">
                                                @foreach ($afianzadoras as $afianza)
                                                    <option value="{{$afianza->id}}"   @if ($fianza->id_afianzadora == $afianza->id)  selected  @endif   >{{$afianza->nombre}}</option>
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
    

  
    
@endsection
