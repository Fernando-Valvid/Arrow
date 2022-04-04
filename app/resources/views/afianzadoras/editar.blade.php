@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar afianzadora</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">

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
                            <form action="{{ route('afianzadoras.update',$afianzadora->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  value="{{ $afianzadora->nombre }}"  id="nombre" name="nombre" placeholder="Nombre" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="{{ $afianzadora->rfc }}"  id="rfc" name="rfc" placeholder="RFC" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="razon_social" value="{{ $afianzadora->razon_social }}"  name="razon_social" placeholder="Razon Social" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea  style="height: 100px" class="form-control"   id="domicilio" name="domicilio" placeholder="Domicilio" >{{ $afianzadora->domicilio }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  value="{{ $afianzadora->telefono }}"  id="telefono" name="telefono" placeholder="Télefono" >
                                        </div>
                                    </div>
                                </div>






                                <br/>
                                <br/>
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Modificar</button>
                                    <a href="{{ route('afianzadoras.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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
