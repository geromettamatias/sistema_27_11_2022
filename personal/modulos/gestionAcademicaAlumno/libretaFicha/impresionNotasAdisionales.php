<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$idIns=$_SESSION['idIns'];

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$cursoSe=$_SESSION['cursoSe'];

$operacion=$_SESSION["operacion"];

$idAsigF_array=$_SESSION["idAsigF_array"];
$idAsig_array=array();
$nombre_asig_array=array();
$nombreColumnas_array=$_SESSION["nombreColumnas_array"];

foreach ($idAsigF_array as $idAsigF_ar) {

$consulta_2 = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan`, `cantidadHoraCatedra` FROM `plan_datos_asignaturas` WHERE `idAsig`='$idAsigF_ar'";
    $resultado_2 = $conexion->prepare($consulta_2);
    $resultado_2->execute();
    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
    foreach($data_2 as $dat_2) {
        $idAsig=$dat_2['idAsig'];
        $nombre_ASIG=$dat_2['nombre'];
        array_push($idAsig_array, $idAsig);
        array_push($nombre_asig_array, $nombre_ASIG);
    }
 }

    $c2onsulta = "SELECT `datosalumnos`.`idAlumnos`,`datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";
    $r2esultado = $conexion->prepare($c2onsulta);
    $r2esultado->execute();
    $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

    foreach($d2ata as $d2at) {
        $idAlumnos=$d2at['idAlumnos'];
        $nombreAlumnos=$d2at['nombreAlumnos'];
        $dniAlumnos=$d2at['dniAlumnos'];
        $nombreCurso=$d2at['nombre'];
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


// $cicloLectivo= $cicloFF[0]; 
// $edicion= $cicloFF[1]; 

// $cursoSe=$_SESSION['cursoSe'];

// $operacion=$_SESSION["operacion"];

// $idAsigF_array=$_SESSION["idAsigF_array"];
 // $idAsig_array=array();
// $nombre_asig_array=array();
// $nombreColumnas_array=$_SESSION["nombreColumnas_array"];





foreach ($nombre_asig_array as $key => $nombre_asig_) {



$idAsig=$idAsig_array[$key];


$nombre_seccion_array=array();

 

$consulta = "SELECT `id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs`, `id_curso` FROM `nombres_secciones_asig_$cicloLectivo` WHERE `id_curso`='$cursoSe'";
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

                foreach ($asignatura_array as $id_asignatura) {
                    
                    if ($idAsig==$id_asignatura) {

                      array_push($nombre_seccion_array, $nombre_seccion);
                    }


                }

     } 


$encabezados= array();
$encabezados_dos= array();

$pregunta=0;
foreach ($nombre_seccion_array as $nombre_sec) {
  
  $cabezera=$idAsig.'_'.$cursoSe.'_'.$nombre_sec;
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
Estudiante: <?php echo $nombreAlumnos.' -- DNI: '.$dniAlumnos; ?></h2>
                      

<?php

$con=0;


foreach ($nombreColumnas_array as $key => $nombreColumnas_a) {
    

$pregunta=0;

$c2onsulta = "SELECT `id_nota_seccion`, `id_alumno` FROM `secciones_asignaturas_$cicloLectivo` WHERE `id_alumno`='$idAlumnos' AND `columnar`='$nombreColumnas_a'";
$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
$d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

foreach($d2ata as $d2at) {
    $pregunta=1;
 } 




$pregu_asi_no_1=0;
$pregu_asi_no_2=0;




$c2onsulta = "SELECT * FROM `secciones_asignaturas_$cicloLectivo` WHERE `id_alumno`='$idAlumnos' AND `columnar`='$nombreColumnas_a'";
$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
$d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

foreach($d2ata as $d2at) {

foreach ($encabezados as $encabeza) {  

  $nota=$d2at[''.$encabeza.''];
  $pregu_asi_no_1++;

  if (($nota=='') || ($nota=='')) {
    $pregu_asi_no_2++;
  }


}
}






if (($pregunta==1) && ($pregu_asi_no_1!=$pregu_asi_no_2)) {
    // code...

?>

<h2><?php echo $nombre_asig_; ?><br>
Periodo (Cuatrimestre): <?php echo $nombreColumnas_a; ?></h2>


                                    
                                <table id="customers">
                                      <thead>
                                    <tr>
                                 
                                        <?php foreach ($encabezados_dos as $encabezados_do) {  ?>
                                             <th><?php echo $encabezados_do;  ?></th>
                                          <?php }  ?> 

                                        
                                    </tr>

                              

                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                           
                                 
                                        <tr>



          <?php 

          $pregu=0;

          $c2onsulta = "SELECT * FROM `secciones_asignaturas_$cicloLectivo` WHERE `id_alumno`='$idAlumnos' AND `columnar`='$nombreColumnas_a'";
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
                               


                                </tbody>

                               

                               </table>                    
                         
                        
                         <hr>       
        
        
 <?php
}else{
  $con=1;
} }



if ($con==1) {
  echo '<h2>SIN NOTAS</h2>';
}
?>            
   

</div>





<?php  }}


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