<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


$cursoSeProfesor=$_SESSION['cursoSeProfesor'];
$cicloLectivo=$_SESSION['cicloLectivoFina'];
$idUsuario=$_SESSION["idUsuario"];


$idAlumnos=$_SESSION["idAlumnos"];
$colu_1=$_SESSION["colu"];

$colu_array = explode ('&&', $colu_1);
$colu=$colu_array[0];
$colu_editar=$colu_array[1];

$c2onsulta = "SELECT `nombreAlumnos`, `dniAlumnos` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";
    $r2esultado = $conexion->prepare($c2onsulta);
    $r2esultado->execute();
    $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

    foreach($d2ata as $d2at) {
        
        $nombreAlumnos=$d2at['nombreAlumnos'];
        $dniAlumnos=$d2at['dniAlumnos'];
      
     } 



$consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`, `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre` AS 'nombreAsignacion' FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idAsig` = '$cursoSeProfesor'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($dat1a as $da1t) { 
$idCurso=$da1t['idCurso'];
$idAsig=$da1t['idAsignatura'];

$nombreCurso=$da1t['nombreCurso'];
$nombre_ASIG=$da1t['nombreAsignacion'];
}

    


$nombre_seccion_array=array();

 

$consulta = "SELECT `id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs`, `id_curso` FROM `nombres_secciones_asig_$cicloLectivo` WHERE `id_curso`='$idCurso'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $dat) {
        $id_seccion=$dat['id_seccion'];
        
        $nombre_seccion=$dat['nombre_seccion'];
        $id_profesores=$dat['id_profesores'];
        $periodo=$dat['periodo'];
        $obs=$dat['obs'];
        $cursoSe=$dat['id_curso'];


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

<?php echo '<u><b>CICLO:</b></u> '.$cicloLectivo.' - <br><u><b>ASIGNATURA:</b></u> '.$nombre_ASIG.'<br><u><b>CURSO:</b></u> '.$nombreCurso.'<br><u><b>DNI:</b></u> '.$dniAlumnos.'<br><u><b>APELLIDO Y NOMBRE:</b></u> '.$nombreAlumnos.'<br><u><b>COLUMNA:</b></u> '.$colu.'<br><u><b>Editar:</b></u> '.$colu_editar; ?>

</h5>



<hr>

<?php 


if ($colu_editar=='SI') { ?>
<button class="btn btn-dark" onclick="grabar_notas()"> <i class='fas fa-save'></i> Guardar</button>
<?php } ?>

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

                $pre=0;

                if ($_SESSION['operacion'] !='Lectura y Escritura') {
                     $var.= ' disabled';

                     $pre=1;
                 }

                 if ($pre==0) {
                     if ($colu_editar =='NO') {
                     $var.= ' disabled';
                    }
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


                          $pre=0;

                            if ($_SESSION['operacion'] !='Lectura y Escritura') {
                                 $var.= ' disabled';

                                 $pre=1;
                             }

                             if ($pre==0) {
                                 if ($colu_editar =='NO') {
                                 $var.= ' disabled';
                                }
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



    <?php foreach ($encabezados as $encabeza) {  ?>

     nota=$('#<?php echo $encabeza;  ?>').val(); 

     dataFila_nombres.push('<?php echo $encabeza;  ?>');
     dataFila_notas.push(nota);
 
    <?php } ?>
        
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/notas/elementos/grabar_notas_pre.php",
            type: "POST",
            data: {dataFila_notas:dataFila_notas, dataFila_nombres:dataFila_nombres},
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