<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$id_asignatura=$_SESSION['id_asignatura'];
$cicloLectivo=$_SESSION['cicloLectivo'];
$id_curso=$_SESSION['id_curso'];
$nombreAsignacion=$_SESSION['nombreAsignacion'];
$nombreCurso=$_SESSION['nombreCurso'];
$id_alumnos_array=$_SESSION['id_alumnos_array'];


$colu_1=$_SESSION['nombreColumnas_array'];

$colu_array = explode ('&&', $colu_1);
$nombreColumnas_array=$colu_array[0];
$colu_editar=$colu_array[1];




$nombreAlumnos_array=array();
$dniAlumnos_array=array();
       

foreach ($id_alumnos_array as $id_alumnos_ar) {

$c2onsulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos` FROM `datosalumnos` WHERE `idAlumnos`='$id_alumnos_ar'";
    $resultado_2 = $conexion->prepare($c2onsulta);
    $resultado_2->execute();
    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
    foreach($data_2 as $dat_2) {
        $nombreAlumnos=$dat_2['nombreAlumnos'];
        $dniAlumnos=$dat_2['dniAlumnos'];
        array_push($nombreAlumnos_array, $nombreAlumnos);
        array_push($dniAlumnos_array, $dniAlumnos);
    }
 }





?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E.E.T. N° 16</title>
<style type="text/css" >
 
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

  font-size:140%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}


.boton_personalizado{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }




.fechaTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

.fechaTable td, .fechaTable th {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}



.fechaTable th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  background-color: #134CA9;
  color: white;
  text-align: center;
}

h1 {
  text-align: left;
}


p {
  text-align: justify;
}



.tablaFinal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  text-align: center;
}

.tablaFinal td, .tablaFinal th {
  border: 1px solid #ddd;
  padding: 5px;
  text-align: center;

}



.tablaFinal th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  text-align: center;
}




</style>
 
</head>
<body>

<div id="ocultarBotonImpri" class="container ">
  <div class="row ">
    <div class="col-lg-12 p-4 ">
      <button class="boton_personalizado  print">Imprimir</button>
    </div>
  </div>
</div>


<div class="imprimir" id="imprimir">
        <!-- Compiled and minified CSS -->

                <style type="text/css" media="print">
   @media print {
 
    #sidebar {
        display:none;
    } 
    main {
        float:none;
    } 
}

@page{    
    size: legal;
    margin: 1cm;  /* this affects the margin in the printer settings */

    

}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
}


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:140%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #4CAF50;
  color: white;

}





.fechaTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

.fechaTable td, .fechaTable th {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;

}



.fechaTable th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  
  text-align: center;
}


.tablaFinal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  text-align: center;
}

.tablaFinal td, .tablaFinal th {
  border: 1px solid #ddd;
  padding: 5px;
  text-align: center;

}



.tablaFinal th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  

  text-align: center;
}




h1 {
  text-align: left;
}


p {
  text-align: justify;
}

</style>

 

 <?php


$nombre_seccion_array=array();
 

$consulta = "SELECT `id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs`, `id_curso` FROM `nombres_secciones_asig_$cicloLectivo` WHERE `id_curso`='$id_curso'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $dat) {
        $id_seccion=$dat['id_seccion'];
        
        $nombre_seccion=$dat['nombre_seccion'];
        $id_profesores=$dat['id_profesores'];
        $periodo=$dat['periodo'];
        $obs=$dat['obs'];
        $id_curso=$dat['id_curso'];


             $asignatura_array = explode(",", $dat['asignatura']);
                $imprimir='';

                foreach ($asignatura_array as $id_asignatura_dos) {
                    
                    if ($id_asignatura==$id_asignatura_dos) {

                      array_push($nombre_seccion_array, $nombre_seccion);
                    }


                }

     } 


$encabezados= array();
$encabezados_dos= array();

$pregunta=0;
foreach ($nombre_seccion_array as $nombre_sec) {
  
  $cabezera=$id_asignatura.'_'.$id_curso.'_'.$nombre_sec;
  array_push($encabezados, $cabezera);
   array_push($encabezados_dos, $nombre_sec);
  $pregunta=1;
}

 

if ($pregunta==1) {
        // code...
       

?>


<div style="page-break-before: always;">
<img src="../../../../elementos/cabesera.png">
<br><br><br><br><br>
<h2>E.E.T.N° 16  "1° DE MAYO"<br>
CURSO: <?php echo $nombreCurso; ?><br>
Asignatura: <?php echo $nombreAsignacion; ?></h2>
                      

<?php

$con=0;




?>


Periodo (Cuatrimestre): <?php echo $nombreColumnas_array; ?></h2>


                                    
                                <table id="customers">
                                      <thead>

                                    <tr>
                                 
                                       
                                            <th>APELLIDO Y NOMBRE</th>
                                            <th>DNI</th>

                                    
                                        <?php foreach ($encabezados as $key => $encabezad){



                                          ?>
                                             <th><?php echo $encabezados_dos[$key];  ?></th>
                                          <?php }  ?> 

                                        
                                    </tr>

                              

                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>



<?php  foreach ($id_alumnos_array as $key => $id_alumnos_arr) { ?>


                           
                                 
                                        <tr>
                                            <td><?php echo $nombreAlumnos_array[$key] ?></td>
                                            <td><?php echo $dniAlumnos_array[$key] ?></td>

          <?php 




          $pregu=0;

          $c2onsulta = "SELECT * FROM `secciones_asignaturas_$cicloLectivo` WHERE `id_alumno`='$id_alumnos_arr' AND `columnar`='$nombreColumnas_array'";

          $r2esultado = $conexion->prepare($c2onsulta);
          $r2esultado->execute();
          $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

          foreach($d2ata as $d2at) {
              
          $nota=0;




          foreach ($encabezados as $encabeza) {  

            $nota=$d2at[''.$encabeza.''];
          

              $var='';
               

                if ($nota=='undefined'){
                    $var= '---';
                }else{
                    $var= $nota;
                  
                } 



                  echo '<td>'.$var.'</td>';

                  $pregu=1;

               } 




                } 




                if ($pregu==0) {
                   
                   foreach ($encabezados as $encabeza) {  

          

                        $var='---';
                      
                            echo '<td>'.$var.'</td>';


                         } 
                }






                 ?>                
        </tr>
                               
       <?php } ?>

                                </tbody>

                               

                               </table>                    
                         
                        
                         <hr>       
        
          
   

</div>





<?php  }


?>






</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>










 <script type="text/javascript">
$(document).ready(function(){

  $(".print").click(function(e){
    e.preventDefault();
     window.print();
  });





});



</script>



</body>
</html>