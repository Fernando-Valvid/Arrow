<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('/plugins/bootstrap/css/bootstrap.min.css')}}" />
    <title>Avance</title>

    <style type="text/css">

  
        body{border: 0.2px solid black; padding:0px}

        .clearfix{
            float: none;
            clear: both;
        }

      


        #padre{
           
            width: 100%;
            height: 140px;
            margin-top: 10px;
          
           
        }

        .hija{
          
            width: 30%;
            margin: 5px;
            height: auto;
            float: left;
           
          
        }

        .general1{
          
            height: 150px;
            /* background: red; */
            
        }

        .secundario{
           
            float: right;
          
           
        }  
        
        .tercero{
            background-color: rgb(71, 249, 255);
            
        }

        table, td{
            background: rgb(218, 214, 214);
            border: 10px solid black;
        }

        table, thead, tr, th{
         border:1px solid rgb(102, 100, 100);
         background: rgb(223, 208, 208);
         
          }
       

       

        
    </style>
    
  
</head>
<body>



    <div  id="padre">
        
        <div class="hija" >
            <img  src="{{asset('img/usuarios/'. $imgco[0]->imagen)}}" alt="cargando" style="margin-left: 60px; max-width: 120px;" > 
        </div>

        <div class="hija" style="margin-top: 50px; text-align: center">
            <p style="font-size: 14px; text-transform: uppercase"><strong>{{$contrato->nombre_cliente}}</strong></p>
        </div>

        <div class="hija">
            <img class="img-fluid" src="{{asset('img/usuarios/'. $imgco[1]->imagen)}}" alt="cargando" style="margin-left: 120px;  max-width: 150px;" >
                               
        </div>


       
    </div>

    <div style="margin-left: 20px">
        <span style="color:red"> Fecha: </span><?php echo $fechaActual = date('d-m-Y ');?></p>
           
    </div>

 
    <div class="general1" style="width: 100%; margin-top: 5px" >

        <div class="secundario " style="width: 30%; ">
         
           
           Importe del anticipo: <strong>$ 0.00</strong><br>
           
        </div>

        <div class="secundario " style="width: 30%; ">
      
           
            <p>Contrato:<strong> {{$contrato->contrato}}</strong><br>
                Fecha Inicio:<strong> {{$contrato->fecha_inicio}}</strong><br>
                Fecha Termino:<strong> {{$contrato->fecha_termino}}</strong><br>
                Improte sin IVA $ :<strong> {{$contrato->importe}}</strong>
                </p>
        </div>

        <div class="secundario" style="margin-right: 80px; width: 30%;">
         
            <p>Obra ó sevicio:<strong> {{$contrato->nom_obra}}</strong><br>
            Ubicación:<strong> {{$contrato->ubicacion}}</strong><br>
            Contratista:<strong> {{$contrato->nom_empresa}}</strong>
            </p>
        </div>

      



    </div>

    <div  style="width: 98%; margin: auto; ">
     

        <table class="table table-bordered " border="5">
            <thead>
              <tr>
              
                <th>Periodo de ejecucion</th>
                <th scope="col">Importe s/I.V.A</th>
                <th scope="col">I.V.A Contrato</th>
                <th scope="col">2% SERVICIOS EJECUCION</th>
                <th scope="col">0.20%I.C.I C</th>
                <th scope="col">0.50%C.I.C.E.M.</th>
                <th scope="col">Amortización</th>
                <th scope="col">Importe Liquido</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <?php $iva=($contrato->importe)*.016; $dos=($dos=$contrato->importe)*.02;
                $tres=($contrato->importe)*.002;$cuatro=($contrato->importe)*.005;
                $liquido=$contrato->importe+$iva+$dos+$tres+$cuatro; ?> 
              

             <td>{{$contrato->fecha_inicio}} <strong>-</strong> {{$contrato->fecha_termino}}</td>

                <td>$ {{$contrato->importe}}</td>
                <td><?php echo "$ ".number_format( $iva, 2, '.', ',');?>
                
                </td>

              
                <td><?php echo "$ ".number_format( $dos, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $tres, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $cuatro, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $contrato->amortizacion, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $liquido, 2, '.', ',');?></td>
              </tr>

              <tr>

                <td>Subtotal $ </td>
                <td>$ {{$contrato->importe}}</td>
                <td><?php echo "$ ".number_format( $iva, 2, '.', ',');?>
                
                </td>

              
                <td><?php echo "$ ".number_format( $dos, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $tres, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $cuatro, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $contrato->amortizacion, 2, '.', ',');?></td>
                <td><?php echo "$ ".number_format( $liquido, 2, '.', ',');?></td>
            </tr>

              <tr>
                  <td >Acumulado $:</td>
                  <td  colspan="2" style="text-align: center"> <?php echo "$ ".number_format( $contrato->importe+$iva, 2, '.', ',');?></td>
                  <td colspan="3" style="text-align: center">
                      <?php  echo "$ ".number_format ($dos+$tres+$cuatro, 2, '.', ',');?>
                  </td>
                  <td></td>
                  <td><?php echo "$ ".number_format( $liquido, 2, '.', ',');?></td>
              </tr>
             
            </tbody>
          </table>
     
      
    </div>    <br><br><br>


    <div class="" style="width: 100%; height: 300px;  ">
        <p class="text-center" style="margin-bottom: 45px;margin-top: 120px "><strong>FIRMANTES</strong></p>
        <div >
            @foreach ($firmantes as $firmante)
            <div style="width: 20%; float: left; text-align: center" >
                <p>Cargo: <strong>{{$firmante->cargo}}<strong></p><br><br>
                <hr style="height: 2px; width: 100%; background-color: black">
                <p>Nombre: <span style="text-transform: uppercase">{{$firmante->nombre}}</span></p>

            </div>
            @endforeach
            
        

        </div>
    </div><br><br>

 
  
   
</body>
</html>

