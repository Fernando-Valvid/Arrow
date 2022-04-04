@extends('layouts.panel')
@section('contenido')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Detalle de la fianza</h2>
            <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
                        @if (session('mensaje_error'))
                        <div class="alert alert-danger" role="alert">
                          {{session('mensaje_error')}}
                        </div>
                        @endif
					</div>
					<div class="body">
                        <div class="row clearfix">
                            @if ($errors->any())
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>!Revise los campos¡</strong>
                                            @foreach ($errors->all() as $error)
                                                <span >{{ $error }}</span>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                </div>
                            @endif
                           

                            {{-- <div class="row clearfix">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Fianza</h2>                        
                                        </div>
                                        <div class="body">
                                            <p>If you need help before, during or after your this is the place to be. Please usebelow contact details for all your pre-sale questions, contact questions.</p>
                                            <hr>
                                            <ul class="contact-details">
                                                <li><i class="zmdi zmdi-link"></i><a href="#">www.yoursite.com</a></li>
                                                <li><i class="zmdi zmdi-email"></i><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                                                <li><i class="zmdi zmdi-whatsapp"></i> +90 123 45 67</li>
                                                <li><i class="zmdi zmdi-phone"></i> +90 123 45 68</li>
                                                <li><i class="zmdi zmdi-pin"></i> Envato INC 22 Elizabeth St.</li>
                                            </ul>
                                            <hr>
                                            <ul class="social-icons">
                                                <li ><a href="#"><i class="zmdi zmdi-facebook-box"></i></a></li>
                                                <li ><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                                <li ><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                                <li ><a href="#"><i class="zmdi zmdi-linkedin-box"></i></a></li>
                                                <li ><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                                <li ><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                             
                            </div>      --}}
                       
                                    
                                    <div class="col-lg-10 col-md-12 col-sm-12  m-auto">
                                        <div class="card">
                                            <div class="body"> 
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs m-auto" role="tablist">
                                                    <li class="nav-item text-center"><a class="nav-link active" data-toggle="tab" href="#report">Fianza</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#timeline">Afinzadora</a></li>
                                                </ul>
                                                
                                                <div class="tab-content ">
                                                    <div role="tabpanel" class="tab-pane in active " id="report"><br>
                                                              
                                                          
                                                        <p class="text-center"><strong>Número de Contrato: </strong> {{$fianza->name}} </p>
                                                        <p class="text-center"><strong>Monto: $ </strong> {{$fianza->monto}} </p>
                                                        <p class="text-center"><strong>Fecha de alta:  </strong> {{$fianza->fecha}} </p>
                                                        <p class="text-center"><strong>Número de Fianza:  </strong> {{$fianza->num_fianza}} </p>
                                                       <div class="d-flex justify-content-center">
                                                        <a href="{{route('fianza.edit',$fianza->id)}}" class="btn  btn-raised btn-info waves-effect" role="button">Editar Fianza</a>
                                                    </div>
                                                     
                                                    </div><br>
                                                    <div role="tabpanel" class="tab-pane" id="timeline">
                                                        <p class="text-center"><strong>Nombre de la afianzadora: </strong> {{$fianza->nombre_afianzadora}} </p>
                                                        <p class="text-center"><strong>RFC: </strong> {{$fianza->rfc}} </p>
                                                        <p class="text-center"><strong>telefono: </strong> {{$fianza->tel}} </p>
                                                        <p class="text-center"><strong>Domicilio: </strong> {{$fianza->domicilio}} </p>
                                                      
                                                    </div>                            
                                                </div>
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                          
                                
                            </div>

                        </div>
                    </div>
				</div>
			</div>
		</div>

    </div>


@endsection

