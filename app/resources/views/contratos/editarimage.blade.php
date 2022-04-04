@extends('layouts.panel')

@section('estilos')
<link href="{{asset('plugins/dropzone/dropzone.css')}}" rel="stylesheet">
<style>
    #dropzoneDragArea{
        background-color: #f2f2f2;
        border: 1px dashed #c0ccda;
        border-radius:6px;
        padding: 60px;
        text-align: center;
        margin-bottom: 15px;
        cursor:pointer;
    }
    .dropzone{
        box-shadow: 0px 2px 20px 0px #f2f2f2;
        border-radius: 10px;
    }

    #demoform{
        background-color: white !important;
    }
</style>
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar imagen de contrato</h2>
            <small class="text-muted"> ARROW</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">

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
                                <form method="POST" action="{{ route('contratos.actualizarimagen',$imagen->id) }}" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <img src="{{asset('img/usuarios/'.$imagen->imagen)}}" width="140" alt="velonic">
                                </div>
                                <br>
                                <br>
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                                    <input type="file" name="imagen" id="imagen" accept="image/*" />

                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <div class="form-line">
                                        <textarea  style="height: 100px" class="form-control"  id="descripcion" name="descripcion" placeholder="Descripcion" >{{ $imagen->descripcion }}</textarea>
                                    </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id_contrato" value="{{ $imagen->id_contrato }}">

                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2" style="display:inline-block" id="boton">Guardar</button>
                                    <a href="{{ route('contratos.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
                                    </center>
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
