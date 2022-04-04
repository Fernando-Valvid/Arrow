@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Detalle de la fianza</h2>
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
                            
                            <div class="col-md-12 text-center">
                                <p class="font-bold col-pink">Actualmente no cuentas con ninguna afianzadora para este contrato. </p><br>
                             </div><br>          
                            <a href="{{route('fianza.crear',$id)}}" class="btn  m-auto btn-raised   btn-info waves-effect">Agregar</a>
                                
                            </div>

                        </div>
                    </div>
				</div>
			</div>
		</div>

    </div>


@endsection

