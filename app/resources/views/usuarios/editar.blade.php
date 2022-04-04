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
                                {!! Form::model($usuario, ['method' => 'PUT', 'file' => true, 'enctype' => 'multipart/form-data', 'route'=> ['usuarios.update',$usuario->id]]) !!}
                                @csrf

                                <div class="col-12 text-right">
                        
                                        <img src="{{asset('img/usuarios/'.$usuario->photo)}}"  class="rounded-circle img-" width="140px" height="120px"><br>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!! Form::text('email', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="datepicker form-control" placeholder="Contraseña" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm-password" name="confirm-password" class="datepicker form-control" placeholder="Confirmar password">
                                        </div>
                                    </div>
                                </div>

                                
                                {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                                   
                                    <input type="file" name="photo" id="photo" accept="image/*" />       
                                </div> --}}

                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <img id="imagenSeleccionada" style="max-height: 200px;">
                                    </div>
                                    
                                        {{-- <input type="file" name="photo" id="photo" accept="image/*" /> --}}
               
                                        <div class="container-input">
                                            <input type="file"  name="photo" accept="image/*" id="file-5" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados"  />
                                            <label for="file-5">
                                            <figure>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                            </figure>
                                            <span class="iborrainputfile">Seleccionar archivo</span>
                                            </label>
                                            </div>
                                </div>

                                

                                {{-- <div class="col-sm-6 ">
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control show-tick')) !!}
                                </div> --}}
                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group drop-custum">
                                      
                                    <select class="form-control" id="rol" name="roles" required>
                                      @foreach ($roles as $rol) 
                                      <option value="{{$rol->name}}"@if ( $rol->name === $rolSelect->name ) selected @endif>{{$rol->name}}</option> 
                                      @endforeach    
                                    </select>
                                    </div>
                                </div>
                           
                        
                                  <div class="col-md-6 col-sm-12 " id="empresa" style="display:none">
                                    <div class="form-group drop-custum">
                                    <select class="form-control show-tick "  name="empresa" id="em">
                                        <option value="" selected>--Seleccione una empresa--</option>
                                     @foreach ($empresas as $empresa)
                                     <option value="{{$empresa->id}}" @if ( $empresa->nombre === $empresaS->nombre ) selected  @endif >{{$empresa->nombre}}</option>
                                     @endforeach   
                                    </select>
                                    </div>
                                </div>

                           
                                 <div class="col-sm-12 col-md-6">
                                    <div class="alert bg-pink alert-dismissible" id="alerta" style="display: none" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       No existen empresas registradas
                                    </div>
                                </div> 

                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2" id="boton">Guardar</button>
                                    <a href="{{ route('usuarios.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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

    <script>
    let $rol,$empresas,boton;


    $(document).ready(function(){
    
        $rol=$('#rol').val();
        console.log($rol);

        if($rol=='Responsable de empresa'){
            console.log("soy responsable");
            document.getElementById('empresa').style.display = 'block';

        }

    });

    $(function(){
        $('#rol').change(()=>{
            $rol=$("#rol").val();
            console.log($rol);

            $empresas=$("#em").val();
        
            if($rol=='Responsable de empresa' &&  $empresas !== null){
                document.getElementById('empresa').style.display = 'block';
                document.getElementById('boton').style.display = 'inline-block';   
                $rt=document.getElementById('em').val();   
                console.log($rt);
            }

            else if($rol=='Usuario'){
                document.getElementById('boton').style.display = 'inline-block'; 
                document.getElementById('empresa').style.display = 'none';
               $emr=document.getElementById("em").value = '0';
                console.log($emr);

               
            }else{
                document.getElementById('empresa').style.display = 'block';
            }

        
        });
    });

 
        
  


    </script>

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

