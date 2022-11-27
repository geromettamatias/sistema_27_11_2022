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
$idAsig=$_SESSION["idAsig"];

$colu=$_SESSION["colu"];



$consulta_2 = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan`, `cantidadHoraCatedra` FROM `plan_datos_asignaturas` WHERE `idAsig`='$idAsig'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                       
                        $nombre_ASIG=$dat_2['nombre'];
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

$pregunta=0;
foreach ($nombre_seccion_array as $nombre_sec) {
  
  $cabezera=$idAsig.'_'.$cursoSe.'_'.$nombre_sec;
  array_push($encabezados, $cabezera);
  $pregunta=1;
}

 

if ($pregunta==1) {


?>

<h5> 

<?php echo '<u><b>CICLO:</b></u> '.$cicloLectivo.' - <br><u><b>ASIGNATURA:</b></u> '.$nombre_ASIG.'<br><u><b>CURSO:</b></u> '.$nombreCurso.'<br><u><b>DNI:</b></u> '.$dniAlumnos.'<br><u><b>APELLIDO Y NOMBRE:</b></u> '.$nombreAlumnos.'<br><u><b>COLUMNA:</b></u> '.$colu; ?>

</h5>



<hr>


<button class="btn btn-dark" onclick="grabar_notas()"> <i class='fas fa-save'></i> Guardar</button>


<hr>
  <div class="table-responsive">
    <table id="tabla_not" class="table table-bordered" style="width:100%">
    <thead>
        <tr>

          <?php foreach ($encabezados as $encabeza) {  ?>
             <th><?php echo $encabeza;  ?></th>
          <?php }  ?>                
        </tr>
    </thead>
     <tbody>
      
        <tr>



          <?php 

          $pregu=0;

          $c2onsulta = "SELECT * FROM `secciones_asignaturas_$cicloLectivo` WHERE `id_alumno`='$idAlumnos' AND `columnar`='$colu'";
          $r2esultado = $conexion->prepare($c2onsulta);
          $r2esultado->execute();
          $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

          foreach($d2ata as $d2at) {
              
          $nota=0;




          foreach ($encabezados as $encabeza) {  

            $nota=$d2at[''.$encabeza.''];
          

          

              $var='';
               

               $var='<td><input type="number"  min="3" max="10" class="form-control bg-dark-x border-0 cls" id="'.$encabeza.'"';

                if ($nota=='undefined'){
                    $var.= 'value=""';
                }else{
                    $var.= 'value="'.$nota.'"';
                  
                } 

                if ($_SESSION['operacion'] !='Lectura y Escritura') {
                     $var.= ' disabled';
                 }

                  $var.= '></td>';


                  echo $var;

                  $pregu=1;

               } 




                } 




                if ($pregu==0) {
                   
                   foreach ($encabezados as $encabeza) {  

          

                        $var='';
                         

                         $var='<td><input type="number"  min="3" max="10" class="form-control bg-dark-x border-0 cls" id="'.$encabeza.'"';


                          if ($_SESSION['operacion'] !='Lectura y Escritura') {
                               $var.= ' disabled';
                           }

                            $var.= '></td>';


                            echo $var;


                         } 
                }






                 ?>                
        </tr>
       
    </tbody>        
    
</table>

</div>





<script type="text/javascript">
  
  function grabar_notas(){

                   $.blockUI({ 
                        message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                        css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } }); 
   

        
     dataFila_notas=[];
     dataFila_nombres=[];

     idAlumnos=<?php echo $idAlumnos;  ?>;

    <?php foreach ($encabezados as $encabeza) {  ?>

     nota=$('#<?php echo $encabeza;  ?>').val(); 

     dataFila_nombres.push('<?php echo $encabeza;  ?>');
     dataFila_notas.push(nota);
 
    <?php } ?>
        
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/grabar_notas_pre.php",
            type: "POST",
            data: {dataFila_notas:dataFila_notas, dataFila_nombres:dataFila_nombres, idAlumnos:idAlumnos},
            success: function(r){

              console.log(r)

              $.unblockUI(); 
            
                if (r==1) {
                    
                    toastr.info('Excelente !!');
                   
                }else{
                     toastr.error('Problema con el servidor');
                    
                }
               
            }
        });


  }


</script>






<?php }else{
  echo '<h5>NO posee notas, secciones registrado en el sistema </h5>';
} ?>





<script type="text/javascript">
  $.unblockUI(); 
</script>