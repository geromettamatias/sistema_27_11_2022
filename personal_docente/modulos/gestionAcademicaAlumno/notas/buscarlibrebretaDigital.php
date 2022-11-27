

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-info">
              
              <div class="card-header">
                <h3 class="card-title">

                  <?php
       include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

        if  (isset($_SESSION['idUsuario'])){



          $cicloLectivoFina=$_SESSION['cicloLectivoFina'];
          $idUsuario=$_SESSION["idUsuario"];

          
?>




                 Curso  <?php $fechaActual_cabesado = date('d-m-Y');
                  echo $fechaActual_cabesado; ?> (Los Asignaturas que finalizaron, no podrás seleccionar, deberas concurrir al establecimiento)
                </h3>

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
                  

                  <select class="form-control" id="cursoSeProfesor">
<option value="0">Seleccione Curso-Asignatura</option>
<?php
      
  
          $consulta = "SELECT `curso_2022`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre`, `asignacion_asignatura_docente_2022`.`idAsig`, `asignacion_asignatura_docente_2022`.`desde`, `asignacion_asignatura_docente_2022`.`hasta` FROM `asignacion_asignatura_docente_2022` INNER JOIN `curso_2022` ON `curso_2022`.`idCurso` = `asignacion_asignatura_docente_2022`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asignacion_asignatura_docente_2022`.`idAsignatura` WHERE `asignacion_asignatura_docente_2022`.`idDocente` = '$idUsuario'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
          foreach($dat1a as $da1t) { 
            $nombreCurso=$da1t['nombreCurso'];
            $nombreAsig=$da1t['nombre'];
            $idAsig=$da1t['idAsig'];

            $desde=$da1t['desde'];
            $hasta=$da1t['hasta'];

            $fechaActual = date('Y-m-d');
            $fechaActual_final=explode("-",$fechaActual);
            $fechaActual_final_imp=$fechaActual_final[0]."-".$fechaActual_final[1]."-".$fechaActual_final[2];

       

            if ($hasta=='') {

              echo '<option value="'.$idAsig.'">'.$nombreCurso.'--'.$nombreAsig.'// Sin datos (complete la D.J. Inst)</option>';
              
            }else{

                $desde_final=explode("-",$desde);
                $hasta_final=explode("-",$hasta);

                $desde_final_imp_usuario=$desde_final[2]."-".$desde_final[1]."-".$desde_final[0];
                $hasta_final_imp_usuario=$hasta_final[2]."-".$hasta_final[1]."-".$hasta_final[0];


                $desde_final_imp=$desde_final[2]."-".$desde_final[1]."-".$desde_final[0];
                $hasta_final_imp=$hasta_final[2]."-".$hasta_final[1]."-".$hasta_final[0];

                // 


                $desde_final_imp_Data = new DateTime($desde_final_imp);

                $hasta_final_imp_Data = new DateTime($hasta_final_imp);
               
                $fechaActual_final_imp_Data = new DateTime($fechaActual_final_imp);






                    $comprobar_desde_resul= $desde_final_imp_Data <= $fechaActual_final_imp_Data;

                    $comprobar_hasta_resul= $hasta_final_imp_Data >= $fechaActual_final_imp_Data;


                    if (($comprobar_hasta_resul==true) && ($comprobar_desde_resul==true)){
               

                        echo '<option value="'.$idAsig.'">'.$nombreCurso.'--'.$nombreAsig.'// Desde: '.$desde_final_imp_usuario.'; Hasta: '.$hasta_final_imp_usuario.'</option>'; 

                    }else{

                          echo '<option disabled="disabled" value="'.$idAsig.'">'.$nombreCurso.'--'.$nombreAsig.'// Desde: '.$desde_final_imp_usuario.'; Hasta: '.$hasta_final_imp_usuario.'</option>'; 
                    }

             }




             } ?>

        </select>
  



    <script type="text/javascript">
      $('#imagenProceso').hide();

       
    $("#cursoSeProfesor").change(function(){


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



      $('#imagenProceso').show();

      cursoSeProfesor= $('#cursoSeProfesor').val();

      if (cursoSeProfesor=='0') {
        $('#tablaInstitucional').html('');
        $('#imagenProceso').hide();

        $.unblockUI();
      }else{
      
        
    
       $.ajax({
          type:"post",
          data:'cursoSeProfesor=' + cursoSeProfesor,
          url:'modulos/gestionAcademicaAlumno/notas/elementos/seccionAsignatura.php',
          success:function(r){
          
            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/notas/librebretaDigital.php');

            
          }
        });

      }

      });


    
function remover(){

           
           $('#buscarTablaInstitucional').html('');
            $('#tablaInstitucional').html('');
             $('#contenidoAyuda').html('');


             
  
           $("#collapseOne").collapse('show');

      
      $("#circularesP").removeClass("nav-link active");
      $("#circularesP").addClass("nav-link");

      

     <?php 

      if ($_SESSION["inscrpcion_pregunta"] != 'NO') {   ?>

      $("#actaExamen").removeClass("nav-link active");
      $("#actaExamen").addClass("nav-link");


        <?php 
            }
    
      if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>

      $("#libretaDigitalDocente").removeClass("nav-link active");
      $("#libretaDigitalDocente").addClass("nav-link");

          <?php 
            }
    
      if ($_SESSION["d_j_pregunta"] != 'NO') {   ?>

      $("#dj").removeClass("nav-link active");
      $("#dj").addClass("nav-link");

       <?php 
            }
      ?>

      $("#generarPedido").removeClass("nav-link active");
      $("#generarPedido").addClass("nav-link");

    


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










