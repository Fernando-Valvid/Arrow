
@extends('layouts.sesion')

@section('title',':: Registrate ::')
@section('contenido')

    <div class="container">
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
        <div class="card-top"></div>
        <div class="card">
            <h1 class="title"><span>Arrow</span>Registrate </h1>
            <div class="col-sm-12">
                <form action="{{ route('register') }}" method="POST">      
                    @csrf      
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="zmdi zmdi-account"></i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Nombre" required="" autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="zmdi zmdi-email"></i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required="">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="zmdi zmdi-lock"></i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required="">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="zmdi zmdi-lock"></i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="Confirma password" required="">
                    </div>
                </div>

                {{-- <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">vpn_key</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="llave" minlength="6" placeholder="Código de verificación" required="">
                    </div>
                </div> --}}
                <div class="form-group">
                    <input type="checkbox" name="terminos" id="terms" class="filled-in chk-col-pink">
                    <label for="terms">Acepto los <a href="">terminos y condiciones</a>.</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-raised g-bg-blush2 waves-effect" >Registrate</button>
                </div>
                <div class="m-t-10 m-b--5 align-center">
                    <a href="{{route('login') }}">Ya tienes una cuenta?</a>
                </div>
            </form>
            </div>
        </div>  
    </div>
@endsection
