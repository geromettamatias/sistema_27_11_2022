

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-danger">
              
              <div class="card-header">
                <h3 class="card-title">SELECCIONAR AÑO LECTIVO</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()"  type="button" class="btn btn-tool" data-card-widget="remove">
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
                  $cat="";


                 $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                
                     $cat.="<option value='".$ciclo."'>".$ciclo."</option>";


                  }


?>

  
                  <select class="form-control" id="cicloLectivoFina">
                    <option>Seleccione un año lectivo</option>
                    <?php echo $cat;  ?>
                  </select>




                   <script type="text/javascript">
      $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    $("#cicloLectivoFina").change(function(){


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








      cicloLectivoFina= $('#cicloLectivoFina').val();

      if (cicloLectivoFina=='Seleccione un año lectivo') {
        
                $('#contenidoAyuda').html(''); 
              
                $('#tablaInstitucional').html('');

                  $.unblockUI();
           

      }else{
      
      
       $.ajax({
          type:"post",
          data:'cicloLectivoFina=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaAlumno/libreta/elementos/seccionCiclo.php',
          success:function(r){
          
           
                $('#contenidoAyuda').html(''); 
                 $('#cargaCiclo').show();
              
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/libreta/libretaDigital.php');
           
          }
        });

      }

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


   
      $("#visualizarNotaMesa").removeClass("nav-link active");
      $("#visualizarNotaMesa").addClass("nav-link");

 


}


 

   $.unblockUI();
  </script>



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

