
<br>


 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">


  <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        ICONOS
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      



                <div class="row">



                  <?php
 
session_start();

?>

 





<?php  if ($_SESSION["analitico_pregunta"] != 'NO') {   ?>

          <div onclick="analitico_icono()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span  class="info-box-text">ANALÍTICO</span>
                <span class="info-box-number">INGRESAR</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

<?php  }   ?>


<?php  if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>



          <!-- /.col -->
          <div onclick="libreta_icono()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas  fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">LIBRETA DIGITAL</span>
                <span class="info-box-number">INGRESAR</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

<?php  }   ?>




 <?php  if ($_SESSION["inasistencia_pregunta"] != 'NO') {   ?>



          <!-- /.col -->
          <div onclick="inasistencia_icono()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">INASISTENCIA</span>
                <span class="info-box-number">INGRESAR</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
<?php  }   ?>


<?php if ($_SESSION["ajustes_pregunta"] != 'NO') {   ?>




          <!-- /.col -->
                 <!-- /.col -->
          <div onclick="ajustes_icono()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-wrench"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">AJUSTES</span>
                <span class="info-box-number">INGRESAR</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


<?php }  ?>




   <!-- /.col -->
                 <!-- /.col -->
          <div onclick="visualizar()" class="col-md-12 col-sm-12 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-secondary"><i class="fas fa-clipboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PERIODO DE INTENSIFICACIÓN</span>
                <span class="info-box-number">INGRESAR</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

<script type="text/javascript">



  function visualizar(){
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



                $("#collapseOne").collapse('hide');


                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').html('');
               $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/visualizacion_Mesa/buscar_ciclo.php');
               
          
  }
 

<?php if ($_SESSION["ajustes_pregunta"] != 'NO') {   ?>


     function ajustes_icono(){


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



                $("#collapseOne").collapse('hide');

 
                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/extras/ajustes/ajustes.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

         
        
    }

<?php }   ?>

<?php  if ($_SESSION["analitico_pregunta"] != 'NO') {   ?>

    function analitico_icono(){



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




            $("#collapseOne").collapse('hide');

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/analitico.php');
           

          
         
        
    }

<?php  }   ?>


     <?php  if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>

     function libreta_icono(){


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




            $("#collapseOne").collapse('hide');

                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/libreta/buscarLibretaDigital.php');
        

    }

 <?php  }   ?>
      
   <?php  if ($_SESSION["inasistencia_pregunta"] != 'NO') {   ?>



        function inasistencia_icono(){




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




      

                 $.unblockUI();

                 $.ajax({
                          url: "modulos/gestionAcademicaAlumno/inasistencia/elementos/cicloAlumno.php",
                          type: "POST",
                          data: '',
                          success: function(r){  

    

                    ret=`<select class="form-control" id="cicloLectivo_DOS">
                              
                                
                                `+r+`
                                </select></div>`;
                     

                      Swal.fire({
                              title: 'AÑO LECTIVO',
                              html:ret, 
                              focusConfirm: false,
                              showCancelButton: true,                         
                              }).then((result) => {
                                if (result.value) {                                             
                                  cicloLectivo_DOS = document.getElementById('cicloLectivo_DOS').value;
                              
                       

                                  inasistenciaIrAluw_DOS(cicloLectivo_DOS);
                                                  
                                }
                        });




                   }        
                      });




 
      $("#inasistencia").removeClass("nav-link");
      $("#inasistencia").addClass("nav-link active");
   
        
        
    }






 function inasistenciaIrAluw_DOS(cicloLectivo){



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
        url: "modulos/gestionAcademicaAlumno/inasistencia/elementos/alumnoCicloFinal.php",
        type: "POST",
       
        data: {cicloLectivo_INA:cicloLectivo_DOS},
        success: function(data){  
            
                $("#collapseOne").collapse('hide');


                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/inasistencia/inasistencia.php');
           
        }        
    });
}

 <?php  }   ?>






</script>







      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
</section>

<hr>


