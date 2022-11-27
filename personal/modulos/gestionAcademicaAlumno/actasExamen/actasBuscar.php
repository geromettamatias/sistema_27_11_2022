<?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


                  $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo` DESC";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                     $cat.="<option value='".$ciclo."||".$edicion."'>".$ciclo."- Editar: ".$edicion."</option>";


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
                <h3 class="card-title">CICLO LECTIVO Y TIPO DE ACTA</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover4()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div id="cont_dos" class="card-body">
                <div class="chart">

                <select class="form-control" id="cicloLectivo">
                <option>Seleccione un año lectivo</option>
                  <?php echo $cat;  ?>
                </select>


                  
                <hr>
                
                   <select class="form-control" id="buscarTipo">
                      <option>Seleccione el tipo de ACTAS</option>
                      <option>ACTAS- PARA REGULAR</option>
                      <option>ACTAS- PARA LIBRE</option>
                      <option>ACTAS- PARA EQUIVALENCIA</option>
                      <option>ACTAS- PARA TERMINAL</option>
                
                  </select>

                  

<script type="text/javascript">


$('#buscarTipo').select2({
    dropdownParent: "#cont_dos",
    theme: "classic", 

  });

$('#cicloLectivo').select2({
    dropdownParent: "#cont_dos",
    theme: "classic", 

  });



$('#imagenProceso').hide();

    $("#buscarTipo").change(function(){


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

      cicloLectivo= $('#cicloLectivo').val();
      buscarTipo= $('#buscarTipo').val();


  

      if (cicloLectivo=='Seleccione un año lectivo') {
        toastr.warning('No hay ninguna Año lectivo seleccionado');
        $('#tablaInstitucional').html('');
         $.unblockUI();
         return false;
      }

      if (buscarTipo=='Seleccione el tipo de ACTAS') {
        toastr.warning('No hay ninguna Acta seleccionado');
        $('#tablaInstitucional').html('');
         $.unblockUI();
         return false;
      }
      
      
       $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivo+'&buscarTipo=' + buscarTipo,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/seccionACTA.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){


              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();
          }
        });

      

      });




    $("#cicloLectivo").change(function(){


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

      cicloLectivo= $('#cicloLectivo').val();
      buscarTipo= $('#buscarTipo').val();



      

      if (cicloLectivo=='Seleccione un año lectivo') {
        toastr.warning('No hay ninguna Año lectivo seleccionado');
        $('#tablaInstitucional').html('');
         $.unblockUI();
         return false;
      }

      if (buscarTipo=='Seleccione el tipo de ACTAS') {
        toastr.warning('No hay ninguna Acta seleccionado');
        $('#tablaInstitucional').html('');
         $.unblockUI();
         return false;
      }
      
      
       $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivo+'&buscarTipo=' + buscarTipo,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/seccionACTA.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){

            
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();
          }
        });

      

      });

 $.unblockUI();






function remover4 () {

  
        
       $("#planillaDocente").removeClass("nav-link active");
      $("#planillaDocente").addClass("nav-link");

      $("#ciclo").removeClass("nav-link active");
      $("#ciclo").addClass("nav-link");

      $("#encabesados").removeClass("nav-link active");
      $("#encabesados").addClass("nav-link");
      $("#informes").removeClass("nav-link active");
      $("#informes").addClass("nav-link");

    

      $("#usuarioOtro").removeClass("nav-link active");
      $("#usuarioOtro").addClass("nav-link");

      $("#posteo").removeClass("nav-link active");
      $("#posteo").addClass("nav-link");


      $("#modeloDos").removeClass("nav-link active");
      $("#modeloDos").addClass("nav-link");

      $("#modeloUno").removeClass("nav-link active");
      $("#modeloUno").addClass("nav-link");


      $("#datosSitio").removeClass("nav-link active");
      $("#datosSitio").addClass("nav-link");

      $("#datos_Institucion").removeClass("nav-link active");
      $("#datos_Institucion").addClass("nav-link");

      $("#datosPlanEstudios").removeClass("nav-link active");
      $("#datosPlanEstudios").addClass("nav-link");


      $("#asignaturas").removeClass("nav-link active");
      $("#asignaturas").addClass("nav-link");

      $("#anuncioAlumnoCantidadEstadistica").removeClass("nav-link active");
      $("#anuncioAlumnoCantidadEstadistica").addClass("nav-link");


      $("#usuariosEstadistica").removeClass("nav-link active");
      $("#usuariosEstadistica").addClass("nav-link");

      $("#cursos").removeClass("nav-link active");
      $("#cursos").addClass("nav-link");

      $("#cargaAlumno").removeClass("nav-link active");
      $("#cargaAlumno").addClass("nav-link");

      $("#cargaAlumnoPre").removeClass("nav-link active");
      $("#cargaAlumnoPre").addClass("nav-link");

$("#habilitarDocente").removeClass("nav-link active");
      $("#habilitarDocente").addClass("nav-link");


      $("#cargaDocente").removeClass("nav-link active");
      $("#cargaDocente").addClass("nav-link");

      $("#inscripNota").removeClass("nav-link active");
      $("#inscripNota").addClass("nav-link");

      $("#libretaDigital").removeClass("nav-link active");
      $("#libretaDigital").addClass("nav-link");

      $("#planillaCentralizadora").removeClass("nav-link active");
      $("#planillaCentralizadora").addClass("nav-link");

      $("#analiticos").removeClass("nav-link active");
      $("#analiticos").addClass("nav-link");

      $("#asistenciaAlumno").removeClass("nav-link active");
      $("#asistenciaAlumno").addClass("nav-link");

      $("#actas").removeClass("nav-link active");
      $("#actas").addClass("nav-link");

    

     
      $("#circularProfe").removeClass("nav-link active");
      $("#circularProfe").addClass("nav-link");

    

      $("#novedades").removeClass("nav-link active");
      $("#novedades").addClass("nav-link");

      $("#directivoDatos").removeClass("nav-link active");
      $("#directivoDatos").addClass("nav-link");

      $("#historia").removeClass("nav-link active");
      $("#historia").addClass("nav-link");

      $("#anuncioAlumno").removeClass("nav-link active");
      $("#anuncioAlumno").addClass("nav-link");

      $("#anuncioProfe").removeClass("nav-link active");
      $("#anuncioProfe").addClass("nav-link");

      $("#estadisticaApro").removeClass("nav-link active");
      $("#estadisticaApro").addClass("nav-link");

      $("#planillaNotas").removeClass("nav-link active");
      $("#planillaNotas").addClass("nav-link");

      


     
         $("#generarPedidoAdmin").removeClass("nav-link active");
      $("#generarPedidoAdmin").addClass("nav-link");

          $("#generarPedido").removeClass("nav-link active");
      $("#generarPedido").addClass("nav-link");

           $("#correos").removeClass("nav-link active");
      $("#correos").addClass("nav-link");

           $("#correosSER").removeClass("nav-link active");
      $("#correosSER").addClass("nav-link");


            $("#notificacion").removeClass("nav-link active");
      $("#notificacion").addClass("nav-link");

     $("#ingresoSistema").removeClass("nav-link active");
      $("#ingresoSistema").addClass("nav-link");


        $("#collapseOne").collapse('show');
  
 
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html(''); 



}









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




