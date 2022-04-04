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
            <h2>Agregar nueva Unidad</h2>
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
                            {!! Form::open(array('route' => 'unidades.store','method' => 'POST', 'file' => true, 'enctype' => 'multipart/form-data' )) !!}
                                @csrf
                              

                                <div class="row clearfix m-2 d-flex justify-content-center">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea  style="height: 100px" class="form-control"  id="descripcion" name="descripcion" placeholder="Descripción" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <br/>
                                <br/>
                                
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2" style="display:inline-block" id="boton">Guardar</button>
                                    <a href="{{ route('unidades.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>

    {{-- <script>
    let $rol,$empresas,boton;

    $(function(){
        $('#rol').change(()=>{
            $rol=$("#rol").val();
            console.log($rol);

            $empresas=$("#em").val();
        
            if($rol=='Responsable de empresa' &&  $empresas !== null){
                document.getElementById('empresa').style.display = 'block';
                document.getElementById('boton').style.display = 'inline-block'; 
                // document.getElementById('em').val();             
            }

            else{
                document.getElementById('empresa').style.display = 'none';
                document.getElementById('boton').style.display = 'none';
                document.getElementById('alerta').style.display = 'block';
            }

            if($rol !='Responsable de empresa'){
                document.getElementById('boton').style.display = 'inline-block';
                document.getElementById('alerta').style.display = 'none';
                // document.getElementById("em").value = '0';
            }
        });
    });


    </script> --}}
    
@endsection