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
            <h2>Editar usuario</h2>
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
                                <form action="{{route('operativos.update',$usuario->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')                                                               
                          
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"  id="name" name="name" placeholder="Nombre"   value="{{$usuario->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo"  value="{{$usuario->email}}" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="datepicker form-control" placeholder="Contraseña">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm-password" name="confirm-password" class="datepicker form-control" placeholder="Confirmar password" >
                                        </div>
                                    </div>
                                </div>
                            

                                {{-- <div class="col-sm-6 ">
                                    {!! Form::select('roles[]->id', $roles,[],array('class' => 'form-control show-tick' ) ) !!}
                                </div> --}}
                                @if ($contrato>0)

                                <div class="col-md-6 col-sm-12">
                                    <p style="color:red; font-size: 14px;">Cuentas con contratos activos no puedes cambiar el Rol de este usuario</p>
                                    <div class="form-group drop-custum" >
                                    <select class="form-control show-tick" id="rol" name="roles" required>
                                   
                                     <option value="{{$rolus->name}}" selected >{{$rolus->name}}</option>
                                  
                                    </select>
                                    </div>
                                </div>
                                
                                    
                                @else
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group drop-custum">
                                    <select class="form-control show-tick" id="rol" name="roles" required>
                                    <option value="0" selected>--Seleccione un rol--</option>

                                     @foreach ($roles as $rol)
                                
                                     <option value="{{$rol->name}}" @if($rol->name == $rolus->name) selected @endif >{{$rol->name}}</option>
                                  
                                     @endforeach   
                                    </select>
                                    </div>
                                </div>
                                                               
                                @endif
                                

                                <div class="col-md-6 col-sm-12 " id="empresa" style="display:inline-block">
                                    <div class="form-group drop-custum">
                                    <select class="form-control show-tick "  name="empresa" id="em">
                                  
                                     <option value="{{$empresa->id}}" value="{{old('name')}}" selected>{{$empresa->nombre}}</option>
                                   
                                    </select>
                                    </div>
                                </div>

                         
                                
                                <br/>
                                <br/>
                                
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2" style="display:inline-block" id="boton">Guardar</button>
                                    <a href="{{ route('operativos.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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