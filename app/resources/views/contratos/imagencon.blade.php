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
    .container-input {
    text-align: center;
    background: #f0f0f0;
    border-top: 5px solid #dd5e89;
    padding: 50px 0;
    border-radius: 6px;
    width: 580px;
    height: 250px;
    margin: 0 auto;
    margin-bottom: 20px;
}

.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    max-width: 80%;
    font-size: 1.25rem;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    margin-right: 0.25em;
}

.iborrainputfile {
	font-size:16px; 
	font-weight:normal;
	font-family: 'Lato';
}

    
.inputfile-5 + label {
    color: #dd5e89;
}

.inputfile-5:focus + label,
.inputfile-5.has-focus + label,
.inputfile-5 + label:hover {
    color: #dd5e89;
}

.inputfile-5 + label figure {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #dd5e89;
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile-5:focus + label figure,
.inputfile-5.has-focus + label figure,
.inputfile-5 + label:hover figure {
    background-color: #dd5e89;
}

.inputfile-5 + label svg {
    width: 100%;
    height: 100%;
    fill: #fff;
}

    
</style>
@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Subir imagenes de contrato</h2>
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
                                <form action="{{ route('contratos.guardar') }}" method="POST" file="true" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="id_contrato" value="{{ $id }}">
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <img id="imagenSeleccionada" style="max-height: 200px;">
                                </div>
                                <br>
                                <br>
                                <div class="container-input">
                                    <input type="file" name="imagen" id="file-5" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados"  />
                                    <label for="file-5">
                                    <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                    </figure>
                                    <span class="iborrainputfile">Seleccionar archivo</span>
                                    </label>
                                    </div>
                                {{-- <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                                    <input type="file" name="photo[]" multiple id="photo" accept="image/*" />

                                </div> --}}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <div class="form-line">
                                        <textarea  style="height: 100px" class="form-control"  id="descripcion" name="descripcion" placeholder="Descripcion" ></textarea>
                                    </div>
                                    </div>
                                </div>

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
@section('scripts')
    <script>
    $(document).ready(function(e){
        $('#file-5').change(function(){
            let reader= new FileReader();
            reader.onload=(e)=>{
                $('#imagenSeleccionada').attr('src',e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

    ;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;
		});
	});
}( document, window, 0 ));
    </script>
@endsection
