

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Periodo de intensificación de los aprendizajes- ACTAS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">





<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['s_usuarioEstudiante'])){
$s_usuarioEstudiante=$_SESSION['s_usuarioEstudiante'];

$cicloLectivo=$_SESSION['cicloLectivoFina'];
  
        $c9onsulta = "SELECT idAlumnos FROM datosalumnos WHERE dniAlumnos = '$s_usuarioEstudiante'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $idAlumnos=$d9at['idAlumnos'];
           
         }



?>

                  

                
                       <div class="table-responsive">        
                        <table id="tabla_actaFina" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Equipo Pedagógico</th>
                                <th>Tipo</th>
                                <th>Asignatura</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Nota Esc</th> 
                                <th>Nota Oral</th> 
                                <th>Prom N°</th>
                                <th>Prom L.</th>
                         

                     
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                              $colorFinal='';

                            $contadorColores=0;  



                            $consulta = "SELECT `acta_examen_inscrip_$cicloLectivo`.`idInscripcion`, `actas_examen_datos_$cicloLectivo`.`tipo`, `plan_datos_asignaturas`.ciclo, `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `plan_datos_asignaturas`.`idPlan`, `actas_examen_datos_$cicloLectivo`.`precentacion`, `actas_examen_datos_$cicloLectivo`.`finalizacion`, `acta_examen_inscrip_$cicloLectivo`.`notaEsc`, `acta_examen_inscrip_$cicloLectivo`.`notaOral`, `acta_examen_inscrip_$cicloLectivo`.`promNumérico`, `acta_examen_inscrip_$cicloLectivo`.`promLetra`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo` FROM `acta_examen_inscrip_$cicloLectivo` INNER JOIN `actas_examen_datos_$cicloLectivo` ON `actas_examen_datos_$cicloLectivo`.`idActa` = `acta_examen_inscrip_$cicloLectivo`.`idActa` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `acta_examen_inscrip_$cicloLectivo`.`idAlumno` = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($d1ata as $d1at) { 

                              

                            $titulo=$d1at['titulo'];
                            $tipo=$d1at['tipo'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];
                            $finalizacion=$d1at['finalizacion'];


                            $notaEsc=$d1at['notaEsc'];
                            $notaOral=$d1at['notaOral'];
                            $promNumérico=$d1at['promNumérico'];
                            $promLetra=$d1at['promLetra'];


                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                                          if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='primary';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                            $colorFinal='info';
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='success';
                             }




                         
                            ?>
                            <tr class="table-<?php echo $colorFinal; ?>">
                             
                                <td><?php echo $titulo ?></td>
                                <td><?php echo $tipo ?></td>
                               
                                <td><?php echo $idPlan.'--'.$ciclo.'--'.$nombreAsignatura; ?></td>
                                <td><?php

                                $date = date_create($precentacion);
                                $cadena_fecha_actual = date_format($date, 'd-m-Y');


                                 echo $cadena_fecha_actual; ?></td>

                                 <td><?php

                                $date_finalizacion = date_create($finalizacion);
                                $cadena_fecha_actual_finalizacion = date_format($date_finalizacion, 'd-m-Y');


                                 echo $cadena_fecha_actual_finalizacion; ?></td>

                                  <td><?php echo $notaEsc ?></td>
                                  <td><?php echo $notaOral ?></td>
                                  <td><?php echo $promNumérico ?></td>
                                  <td><?php echo $promLetra ?></td>
                                
                       

                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>

                    <script type="text/javascript">
$(document).ready(function(){
    $('#imagenProceso').hide();

 
    
    var tabla_actaFina = $('#tabla_actaFina').DataTable({ 

          
                "destroy":true,  
              

                    "language": {
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "zeroRecords": "No se encontraron resultados",
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sSearch": "Buscar:",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast":"Último",
                                "sNext":"Siguiente",
                                "sPrevious": "Anterior"
                             },
                             "sProcessing":"Procesando...",
                        },
                        //para usar los botones   
                        responsive: "true",
                        dom: 'Bfrtilp',       
                        buttons:[ 
                      {
                        extend:    'excelHtml5',
                        text:      '<i class="fas fa-file-excel"></i> ',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success',
                        title:'Periodo de intensificación de los aprendizajes'
                      },
                      {
                        extend:    'pdfHtml5',
                        text:      '<i class="fas fa-file-pdf"></i> ',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        title:'Periodo de intensificación de los aprendizajes'
                      },
                      {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info',
                        title:'<h1>Periodo de intensificación de los aprendizajes</h1>'
                      },
                    ]         
                    });




 
});



 function remover(){

            $("#collapseOne").collapse('show');
           $('#buscarTablaInstitucional').html('');
            $('#tablaInstitucional').html('');
             $('#contenidoAyuda').html('');


             
    <?php  if ($_SESSION["analitico_pregunta"] != 'NO') {   ?>

      
      $("#analiticoAlumno").removeClass("nav-link active");
      $("#analiticoAlumno").addClass("nav-link");

     <?php  }   ?>


      <?php  if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>


      $("#libretaDigitalAlumno").removeClass("nav-link active");
      $("#libretaDigitalAlumno").addClass("nav-link");

       <?php  }   ?>


      <?php  if ($_SESSION["inasistencia_pregunta"] != 'NO') {   ?>


      $("#inasistencia").removeClass("nav-link active");
      $("#inasistencia").addClass("nav-link");

       <?php  }   ?>


      $("#mensajeAdministrador").removeClass("nav-link active");
      $("#mensajeAdministrador").addClass("nav-link");

     <?php  if ($_SESSION["inscrpcion_pregunta"] != 'NO') {   ?>


      $("#actaExamen").removeClass("nav-link active");
      $("#actaExamen").addClass("nav-link");

      <?php  }   ?>


      <?php  if ($_SESSION["inscrpcion_pregunta"] != 'NO') {   ?>


      $("#inscrpMesasExamen").removeClass("nav-link active");
      $("#inscrpMesasExamen").addClass("nav-link");


      <?php  }else{   ?>

      $("#visualizarNotaMesa").removeClass("nav-link active");
      $("#visualizarNotaMesa").addClass("nav-link");

      <?php  }   ?>


}

 $.unblockUI();

</script>  



<?php } ?> 


                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

