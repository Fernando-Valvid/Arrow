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
        <div class="d-sm-flex justify-content-between">
            <div>
                <h2>Información del perfil</h2>
                <small class="text-muted">Arrow</small>
            </div>
            <div>
                {{-- @can('editar-empresa') --}}
                <a href="{{route('perfil.edit', $usuario->id) }}" class="btn btn-raised btn-primary">Editar</a>
                {{-- @endcan --}}
            </div>



        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-5 col-md-12 col-sm-12 m-auto" >
            <div class="card text-center">
                <img src="{{asset('img/usuarios/'.Auth::user()->photo)}}" class="img-fluid" style="max-width: 100%, height: auto;  "  alt="" >
            </div>
            <div class="card">
                <div class="header">
                    <h2>Información personal</h2>
                </div>
                <div class="body">
                    <strong>Nombre:</strong>
                    <p>{{$usuario->name}}</p>
                    <strong>Rol</strong>
                    <p>{{$rol->name}}</p>
                    <strong>Email</strong>
                    <p>{{$usuario->email}}</p>

                    <hr>

                </div>
            </div>
        </div>

    </div>
</div>


@endsection


