<?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


                  $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $idPlan=$da1t['idPlan'];
                    $nombre=$da1t['nombre'];

                     $cat.="<option value='".$idPlan."'>".$nombre."</option>";


                  }

?>






  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Plan de Estudio</h3>

                <div class="card-tools">

                   <button onclick="regresar()" type="button" class="btn btn-tool"  title="Regresar lista de Alumno del curso">
                    <i class='fas fa-reply-all'></i>
                  </button>


                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                 <select class="form-control" id="plan_estudio">
                  <option>Seleccione un Plan de Estudio</option>
                   <?php echo $cat;  ?>
                </select><br>
                

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




    <script type="text/javascript">
    $('#imagenProceso').hide();

    $("#plan_estudio").change(function(){


       $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } });

      

      plan_estudio= $('#plan_estudio').val();
     


      if (plan_estudio!='Seleccione un Plan de Estudio') {
     
           $.ajax({

          type:"post",
          data:'plan_estudio=' + plan_estudio,
          url:'modulos/cargaDatos/datosAlumno/elementos/seccion_plan.php',
          success:function(r){

                if (r==1) {

                      $('#contenidoCursos').html('');     
                      
                      $('#contenidoAyuda').html(''); 
                      $('#tablaInstitucional').load('modulos/cargaDatos/datosAlumno/cargaAlumnoExel.php');
                      $('#imagenProceso').hide();



                }else{


                  toastr.error('Error del Servidor, Comuniquese con el Administrador');
                   $.unblockUI();
                }
          
                

          }
        });

      }else{


        $('#tablaInstitucional').html('');
          $('#imagenProceso').hide();

              $.unblockUI();
      }

      });


    

function regresar() {
       $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } });




        $('#contenidoCursos').html('');     
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAlumno/alumnos.php');
        $('#imagenProceso').hide();
}


function remover(){


   $('#contenidoCursos').html('');     
   $('#buscarTablaInstitucional').html('');
    $('#contenidoAyuda').html(''); 
    $('#tablaInstitucional').html(''); 
    $('#imagenProceso').hide();

}

  

 $.unblockUI();
  </script>

