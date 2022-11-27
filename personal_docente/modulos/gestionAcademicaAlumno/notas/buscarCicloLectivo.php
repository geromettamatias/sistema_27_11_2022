
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Ciclo Lectivo</h3>

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
                  $cat="";


                 
                  $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                    if ($edicion=='SI') {
                      $cat.="<option value='".$ciclo."'>".$ciclo."</option>";
                    }

                     


                  }

?>



             <select class="form-control" id="cicloLectivoFina">
              <option>Seleccione un año lectivo</option>
              <?php echo $cat;  ?>
            </select>

  




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







    <div id="buscarAsignaturas"></div>
    <script type="text/javascript">
      $('#imagenProceso').hide();
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



      $('#imagenProceso').show();

      cicloLectivoFina= $('#cicloLectivoFina').val();

      if (cicloLectivoFina=='Seleccione un año lectivo') {
        $('#tablaInstitucional').html('');
         $('#contenidoAyuda').html(''); 
           
            $('#buscarAsignaturas').html('');    
                $('#buscarTablaInstitucional').show();

                $('#imagenProceso').hide();

                  $.unblockUI();

      }else{
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

      
      
       $.ajax({
          type:"post",
          data:'cicloLectivoFina=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaAlumno/notas/elementos/seccionCiclo.php',
          success:function(r){
          
            $('#contenidoAyuda').html(''); 
           
            $('#buscarAsignaturas').load('modulos/gestionAcademicaAlumno/notas/buscarlibrebretaDigital.php');    
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                toastr.warning('Recuerde que la planilla de notas de los alumnos se ajusta al D.J. Inst. (si usted posee una suplencia y caduco, también va a caducar en el sistema y no podrá cargar notas… en ese caso deberá concurrir a la institución)');





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

