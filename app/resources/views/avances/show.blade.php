@extends('layouts.panel')
@section('estilos')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <style type="text/css">
        #mapa {
          height: 50vh;
        }
      </style>
       
@endsection
@section('contenido')


<div class="container-fluid">
    <div class="block-header">

        <h2>Avance</h2>
        <small class="text-muted">Bienvenido a la aplicación ARROW</small>
        @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
          {{session('mensaje')}}
        </div>
        @endif
        <div>

        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="card">
             
                                             
                {{--Cabecera  --}}
                <div class="header clearfix d-flex justify-content-center">
                    <a href="{{route('conceptosec.show',$p)}}" class="btn btn-raised btn-light  " ><i class="material-icons">arrow_back</i></a>
                   
                    <h2 class="m-auto">Información</h2>
                  
                   <a class="btn btn-sm btn-raised btn-primary" href="{{ route('concepto.createPDF',$avancef->id) }}">Imprimir Reporte Concepto<i class="material-icons" style=" margin-bottom: 8px;">file_download</i> </a>
                    

                </div>
                
                <div class="body">
                    <div class="clearfix ">
                        <div class="row ">
                           
                        
                            <div class="col-4 ">
                                <img class="img-fluid" src="{{asset('img/usuarios/'. $imgco[0]->imagen)}}" alt="cargando"  width="200px" height="250px" >
                               
                            </div>

                            <div class="col-4  d-flex align-items-center justify-content-center">
                                <p style="font-size: 14px; text-transform: uppercase"><strong>{{$avance->nombre_cliente}}</strong></p>
                            </div>

                            <div class="col-4 ">
                                <img class="img-fluid" src="{{asset('img/usuarios/'. $imgco[1]->imagen)}}" alt="cargando"  width="200px" height="250px" >
                               
                             
                            </div>
                          

                        </div>
                         

                    </div>





                    <hr>
                    <div class="row ">
                        <div class="col-3  m-auto text-center">
                            <strong>Concepto:</strong>
                            <hr><br>
                            <strong>{{$avance->codigo}}</strong>
                        </div>

                        <div class="col-9  ">
                           <p>{{$avance->nom_concepto}}</p>
                        </div>
                  
                    </div> <br><hr>

                    <div class="col text-center">

                         @if($dato==0) 
                        <a href="{{route('registrar.datos',$avancef->id)}}" class="btn btn-raised btn-info m-auto">Datos</a><br><br>   
                         @endif 


                        <a href="{{route('ver.avance',$avancef->id)}}" class="btn btn-raised btn-warning m-auto">Ver el registro avance</a>                          
                        <a href="{{route('avances.agregarimagenubi',$avancef->id)}}" class="btn btn-raised btn-success m-auto"> Imagenes de avance</a>                          
                        <a href="{{ route('avancespdf.createPDFAvance',$avancef->id) }}" class="btn btn-raised g-bg-blush2 mt-4"> Imprimir avance</a> 

                        <br><br>
                        <p>Imagenes de avances</p>
                        
                        @foreach ($imagenesavances as $imgavance )
                        <img class="img-fluid" src="{{asset('img/usuarios/'.$imgavance->imagen)}}" alt="cargando"  width="200px" height="250px" >
                        <p> <strong>Ubicación de la foto tomada</strong> <br>
                            <span>País:  {{$imgavance->country}}</span><br>
                            <span>Código de la región:  {{$imgavance->regioncode}}</span><br>
                            <span>Nombre de la ciudad:  {{$imgavance->cityname}}</span><br>
                            <span>Descripción:  {{$imgavance->descripcion}}</span>
                        </p>
                        <a href="{{route('avances.editarimagen',$imgavance->id)}}" class="text-center btn btn-raised btn-sm btn-warning " >Editar</a>

                        <form action="{{route('avances.eliminarimagen',$imgavance->id)}}" class=""  method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-sm btn-raised btn-danger">Eliminar</button>
                        </form>
                    
                        @endforeach
                        {{-- <br><br>
                        <p>Ubicaciones de las fotos</p>
                        <div id="mapa"></div> --}}
                    </div>

                    
                  
          
                     



                    {{-- <div class="mt-40"></div><br>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr><th>Localizacion</th>
                                        <th>Longitud</th>
                                        <th>Ancho </th>
                                        <th>Ancho </th>
                                        <th>Ancho Promedio</th>
                                        <th>Area</th>
                                        <th>Altura</th>
                                        <th>Volumen total</th>
                                        <th>PZA</th>
                                        <th>Total</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>   <td>d</td>
                                            <td>s</td></td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>3</td>
                                            <td>4</td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  --}}


                    {{-- <div class="row">
                        <div class="col-sm-12 text-center">

                            <hr>
                            <a href="javascript:window.print()" class="btn btn-raised btn-success"><i class="zmdi zmdi-print"></i></a>
                            <a href="{{route('contratos.edit',$contratoUnion->contrato_id)}}" class="btn btn-raised btn-warning">Editar</a>
                            <a href="#" class="btn btn-raised btn-danger">Eliminar</a>
                           
                            <a href="" class="btn btn-raised btn-success">Regresar</a>
                        </div>
                    </div> --}}


                    <br>
                    <div class="row">


                    </div>
                    <br><br>
                    <div class="container">
                        <div class="row">
                        {{-- @foreach($imagenes as $imagen )
                        
                            <div class="col-4">
                                <h3 class=""><img src="{{asset('img/usuarios/'.$imagen->imagen)}}" width="140px" height="100px" alt="velonic"></h3>
                                <p><strong>Descripción: <strong> {{ $imagen->descripcion }}</p>
                                    <a href="{{route('contratos.editarimagen',$imagen->id)}}" class="text-center btn btn-raised btn-sm btn-warning " >Editar</a>

                                <form action="{{route('contratos.eliminarimagen',$imagen->id)}}" class=""  method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="cursor: pointer; background: transparent; border:0px;" class="btn btn-sm btn-raised btn-danger">Eliminar</button>
                                </form>
                            </div>
                       

                        @endforeach --}}
                    </div>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 card ">
           <div class="row mt-2 p-1">
               <div class="col-12 text-center ">
                   <hr>
                   <p class="m-auto"><strong>Contratista: </strong>{{$avance->nom_empresa}} 
                    <span style="color:red"> Fecha: </span><?php echo $fechaActual = date('d-m-Y ');?></p>
                    <hr> 

                    <p class="m-auto text-center"><strong>Ubicación: </strong>{{$avance->ubicacion}} <p>
                        
                    <p class="m-auto"><strong>Contrato: </strong>{{$avance->nom_contrato}} <strong>Importe: </strong> ${{$avance->conimporte}}<p>
                    <hr>
               </div>

               <div class="col-12 ">
                   <div class="row  text-center">
                    <div class="col-6  text-center">
                        <p>Unidad:<br>
                      <strong>{{$unidad->unidad_nombre}}</strong>  </p>
                        
                    </div>
                    <div class="col-6 ">
                        <p>Periodo de ejecución</p>
                        <p>Inicio:</p>
                        <p>{{$avancef->inicio}}</p>
                     

                        <p>Fin:</p>
                        <p>{{$avancef->fin}}</p>
                      
                    </div>
                    <a href="{{route('crearf',$avance->idc)}}" class="btn btn-raised btn-success m-auto">Ejecucion</a>
                   </div>
             
                               
               </div>

               <div class="col-12  mt-3"><hr>
                   <p class="text-center"><strong>CROQUIS DE LOCALIZACIÓN</strong></p><br>
                <img class="img-fluid" src="{{asset('img/usuarios/'. $imgc->imagen)}}" alt="cargando"  width="auto" height="auto" >
                               
               </div>
              
           </div>
   

        </div>
    </div>


</div>


@endsection

@section('scripts')
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnGmrbJMv3UVC2f2Cds1vFfbM49pNBaDg&callback=geoloc"
type="text/javascript"></script>  --}}
{{-- <script type="text/javascript" src="http://maps.google.com/maps/apis/js?sensor=true"></script> --}}
    <script src="{{ asset('bundles/datatablescripts.bundle.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

    <script src="{{ asset('bundles/mainscripts.bundle.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js')}}"></script>

    {{-- <script src="https://maps.googleapis.com/maps/apis/js?key={{config('googlemap')['map_apikey']}}&callback=mapainicio" async defer></script> --}}
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnGmrbJMv3UVC2f2Cds1vFfbM49pNBaDg&callback=mapainicio"
type="text/javascript"></script>  --}}

{{-- <script async defer  src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script> --}}


    {{-- <script>
        function initMap(){

            var mapElement=document.getElementByID('mapa');



            function mapDisplay(datas){
                var options={
                    center: {lat:Number(datas[0].coords_lat), lng:Number(datas[0].coords_lng) },
                    zoom:10
                }

                var map=new google.maps.Map(mapElement, options);

                var markers = new Array();

                for(let index=0; index < datas.length; index++){
                    markers.push({
                        coords:{ lat: Number(datas[index].coords_lat,lng: Number(datas[index].coords_lng))},
                        content:`<div><h5>${data[index].location_title}</h5><p><i class="icon address-icon"></i>${data[index].addressline1}</p><p>${data[index].addressline2}</p>, ${datas[index].city}<p><small>${datas[index].location_email}</small></div>`
                    })
                }

                for(var i=0; i< markers.length; i++){
                    addMarker(markers[i]);

                }

                function addMarker(props){
                    var marker = new google.maps.Marker({
                        position:props.coords,
                        map: map
                    });
                    if(props.iconImage){
                        marker.setIcon(props.iconImage);
                    }

                    if(props.content){
                        var infoWindow= new google.maps.infoWindow({
                            content:props.content;
                        });

                        marker.addListener('click', function(){
                            infoWindow.open(map, marker);
                        })
                    }
                }
            }
        }
    </script> --}}

    <script>

    // function mapainicio(){
    //     if(!!navigator.geolocation){

    //         var map;
    //         var OpcionesMapa = {
    //         zoom: 16,
    //         mapTypeId: 'roadmap'
    //         };

    //         map = new google.maps.Map(document.getElementById('mapa'), {
    //           OpcionesMapa
    //          });

           // map = new google.maps.Map(document.getElementById('mapa'), OpcionesMapa);
            

            // navigator.geolocation.getCurrentPosition(function(position){
            //     var geolocate= new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                
            //     var infoVentana = new google.maps.InfoWindow({
            //         map: map,
            //         position: geolocate,
            //         content: '<h1>Está es tú ubicación con Geolocalización </h1>'+
            //         '<p>Latitud: '+position.coords.latitude+' </p>'+ 
            //         '<p>Longitud: '+position.coords.longitude+' </p>'
                    
            //     });

            //     map.setCenter(geolocate);
            // });


           
           


        
{{-- //   function initMap() {
    
 
//     var map;
//     //constructor

//           var marcadores={!! json_encode($imagenesavances) !!};

//           var ventanaInfo= {!! json_encode($imagenesavances) !!};

//           for(var i=0; i<marcadores.length; i++) {
//             var marker= new google.maps.Marker({
//                 position: new google.maps.LatLng(marcadores[i]['latitude'],marcadores[i]['longitude']),
//                 map: map,
//                 title: marcadores[i]['regionname'],
                
                
//                });
               
//                console.log(marcadores[i]['regionname'])
//             }

          
 
//               //var contentString = "<h1><span class='glyphicon glyphicon-asterisk' aria-hidden='true'></span>&#160marcadores[3]['country']""</h1><p><span class='glyphicon glyphicon-screenshot' aria-hidden='true'></span>&#160<b>Dirección</b><br> </p><p><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>&#160 </p>";
 
//             //   var infowindow = new google.maps.InfoWindow({
//             //     content: contentString
//             //   });
 
              
          
         


//       }

      
// window.onload = initMap; --}}

    

    </script>


@endsection
