

@extends('layouts.sesion')

@section('title',':: ARROW Inicio de sesión ::')
    

@section('contenido')
<div class="container">

    @if (session('notification')) 
    <div class="alert alert-success alert-dismissible fade show" role="alert">
     
        {{ session('notification') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif 

        
    
    <div class="card-top">
        
    </div>
    <div class="card">
    
        <h1 class="title"><span class="">Arrow</span>Inicio sesión</h1>
        <div class="col-sm-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                </div>
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
                       
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-raised waves-effect g-bg-blush2">
                        {{ __('Iniciar sesión') }}
                    </button>

                    <a href="{{route('register') }}" class="btn btn-raised waves-effect" >Registrate</a>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

          
                  
                </div>
               
            </form>
        </div>
    </div>    
</div>


    
@endsection