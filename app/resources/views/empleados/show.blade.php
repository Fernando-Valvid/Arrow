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
                <h2>Información del Empleado</h2>
                <small class="text-muted">Arrow</small>
            </div>
            <div>
                
                <a href="{{route('empleados.index')}}" class="btn btn-raised btn-primary">Regresar</a>
                
            </div>


         
        </div>
    </div>        
    <div class="row clearfix">
        <div class="col-lg-9 col-md-12 col-sm-12 m-auto text-center" >
            
            <div class="card">
                <div class="header">
                    <h2>Información del Empleado</h2>
                </div>
                <div class="body">
                    <strong>Nombre:</strong>
                    <p>{{$empleado->nombre}}</p>
                    <strong>Apellido Paterno</strong>
                    <p>{{$empleado->apellido_paterno}}</p>
                    <strong>Apellido Materno</strong>
                    <p>{{$empleado->apellido_materno}}</p>

                    <strong>Tipo Empleado</strong>
                    @if ($empleado->tipo_empleado=='cl')

                    <p>Nombre del Cliente: <strong>{{$cliente->nombre}}</strong></p>

                    @else
                    <p>Empresa: <strong>{{$empresa->nombre}}</strong></p>
                    @endif


                    <strong>Numero de contacto 1</strong>
                    <p>{{$empleado->num_casa}}</p>

                    
                    <strong>Numero de contacto 2</strong>
                    <p>{{$empleado->num_cel}}</p>
               
                    <hr>



                    @if ($empleado->estatus==1)
                    <p>Estatus: <strong><span class="badge bg-danger">Inactivo</span></strong></p>
                     <a href="{{route('empleados.activar',$empleado->id)}}" class="btn  btn-raised btn-info waves-effect">Activar Empleado</i></a>
                     @else
                     <p>Estatus: <strong><span class="badge bg-success">Activo</span></strong></p>
                     @endif
                </div>
            </div>
        </div>
       
    </div>
</div>

    
@endsection

