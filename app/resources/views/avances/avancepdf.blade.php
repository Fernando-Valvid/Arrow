<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('/plugins/bootstrap/css/bootstrap.min.css')}}" />
    <title>Avance</title>

    <style type="text/css">

  
        body{border: 0.4px solid black; padding: 2px}

        .clearfix{
            float: none;
            clear: both;
        }


        #padre{
           
            width: 100%;
            height: 140px;
          
           
        }

        .hija{
          
            width: 30%;
            margin: 5px;
            height: auto;
            float: left;
           
          
        }

        .general1{
          
            height: 180px;
            /* background: red; */
            
        }

        .secundario{
           
            float: right;
          
           
        }  
        
        .tercero{
            background-color: rgb(71, 249, 255);
            
        }
       

       

        
    </style>
    
  
</head>
<body>

  
    
    <div  id="padre" >
        
        <div class="hija" >
            <img  src="{{asset('img/usuarios/'. $imgco[0]->imagen)}}" alt="cargando" style="margin-top: 4px; margin-left: 60px; max-width: 120px;" > 
        </div>

        <div class="hija" style="margin-top: 50px; text-align: center">
            <p style="font-size: 14px; text-transform: uppercase"><strong>{{$avance->nombre_cliente}}</strong></p>
        </div>

        <div class="hija">
            <img class="img-fluid" src="{{asset('img/usuarios/'. $imgco[1]->imagen)}}" alt="cargando" style="margin-top: 4px; margin-left: 60px;  max-width: 120px;" >
                               
        </div>


       
    </div>
 

    <div class="general1" style="width: 100%;" >

        <div class="secundario " style="width: 50%; ">
          
            <p class="text-center"><strong>Contratista: </strong>{{$avance->nom_empresa}} 
             <span style="color:red"> Fecha: </span><?php echo $fechaActual = date('d-m-Y ');?></p>
             <hr> 

             <p class="m-auto text-center"><strong>Ubicación: </strong>{{$avance->ubicacion}} <p>
                 
             <p class="m-auto text-center"><strong>Contrato: </strong>{{$avance->nom_contrato}}<br> <strong>Importe: </strong> ${{$avance->conimporte}}<p>
            
        </div>

        <div class="secundario" style="width: 50%;  display: inline-block ">
            
            <div class="codigo" style="width:20%; display:inline-block; margin-top: 20px" >
                <strong>{{$avance->codigo}}</strong>
       </div>
       <div class="descripcion " style="width:75%; float: right;">
           <p>{{$avance->nom_concepto}}</p>
       </div>
                
            
        </div>



    </div>

 
        <div class="ejecucionp" style="width: 100%; height: 80px; margin: auto;"  >

            <div class="ejecucion" style="width: 30%;  float: left; margin-left: 30px;">Unidad: <strong>{{$unidad->unidad_nombre}}</strong>  </div>
            <div class="ejecucion" style="width: 60%;  float: left;">Periodo de ejecucion: <span style="color:red"> Inicio: </span>{{$avancef->inicio}} <span style="color:red"> Fin: </span>{{$avancef->fin}}</div>
          
      
           
         </div>

         <div class="ejecucionp" style="width: 100%; height: 80px; margin: auto;"  >

            <p class="text-center" style="margin-bottom: 10px; "><strong>Album fotográfico por concepto de obra </strong></p>
            <hr>


            <div class="" style="width: 100%; height: 140px; ">
                @foreach($imagenesavances as  $imgavance)
                <div style="width: 25%; float: left;">
                    
                    <img class="img-fluid" src="{{asset('img/usuarios/'. $imgavance->imagen)}}" alt="Plano 1" style="width: 100%; height: 100%" >
                    <p> <strong>Ubicación: </strong> <br>
                        
                        <span>Código de la región:  {{$imgavance->regioncode}}</span><br>
                        
                        <span>Descripción:  {{$imgavance->descripcion}}</span>
                    </p>
           
                </div>
                @endforeach
                
            </div>
           
         </div>

         <br><br>
        

         <div class="" style="width: 100%; height: 80px; margin-top:100px;">
            <p class="text-center" style="margin-bottom: 5px; "></p>
           
            
            <div >
                <p style="text-align: center; margin-right: 320px"><strong>FIRMANTES</strong></p>
                <hr>
                @foreach ($firmantes as $firmante)
                <div style="width: 25%; float: left; margin-left: 15px; text-align: center" >
                    <p>Cargo: <strong>{{$firmante->cargo}}<strong></p><br>
                    <hr style="height: 2px; width: 100%; background-color: black">
                    <p>Nombre: <span style="text-transform: uppercase">{{$firmante->nombre}} {{$firmante->paterno}}</span></p>
    
                </div>
                @endforeach
                
            
    
            </div>
        </div><br><br>
         
  
                    

    


   
    
   

    

    
   
    
   
</body>
</html>

<script type="text/php">
    if (isset($pdf))
      {
        
      }
  </script>