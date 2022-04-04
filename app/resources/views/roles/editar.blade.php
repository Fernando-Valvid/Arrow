@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar rol</h2>
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
                            {!! Form::model($role, ['method'=> 'PUT' , 'route'=>['roles.update',$role->id]])!!}
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!! Form::text('name', null, array('class' =>'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <label>Permisos por rol</label>
                                        <br><br>
        
                                        @foreach ($permission as $value)
                                    
                                            <input type="checkbox" class="form-control filled-in" id="{{ $value->id }}" name="permission[]" value = "{{ $value->id, null }}" @if(in_array($value->id, $rolesPermissions) == true) checked @endif>
                                            <label class="form-check-label" for="{{$value->id}}">{{$value->name}} </label>
                                            
                                            <br>
                                              
                                        @endforeach
                                        
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <br/>
                                <br/>
                                <div class="col-sm-12">
                                    <center>
                                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">Guardar</button>
                                    <a href="{{ route('roles.index')}}" class="btn btn-raised btn-default waves-effect">Cancelar</a>
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