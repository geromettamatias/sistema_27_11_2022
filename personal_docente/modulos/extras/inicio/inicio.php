                 

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




          <div id="dj_imprimir_do" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span  class="info-box-text">D.J. Inst.</span>
                <span class="info-box-number">Imprimir</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>






 <?php 
    
      if ($_SESSION["d_j_pregunta"] != 'NO') {   ?>

          <!-- /.col -->
          <div onclick="dj_do()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas  fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">D.J.</span>
                <span class="info-box-number">Gestión</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


 <?php 
            }
    
 
          
    
      if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>
          <!-- /.col -->
                 <!-- /.col -->
          <div onclick="libretaDigitalDocenteEstrella()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-wrench"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Notas</span>
         
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


 <?php 
            }
    
        ?>










            <?php if ($_SESSION["inscrpcion_pregunta"] != 'NO') {   ?>
       <!-- Cierre Ajuste -->

                   <!-- /.col -->
                 <!-- /.col -->
          <div onclick="actas()" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-edit"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Actas</span>
         
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

            <?php }   ?>
             






<script type="text/javascript">



$("#dj_imprimir_do").click(function(){
        
       

       asignacionDocented();
   
        
    });



function asignacionDocented() {




   $.ajax({
          type:"post",
          data:{},
          url:'modulos/extras/inicio/elementos/cicloLectivo.php',
          success:function(r){ 


              ret=`<select class="form-control" id="cicloLectivoInicio">
               
                `+r+`
                </select></div>`;
     

                  Swal.fire({
                          title: 'AÑO LECTIVO',
                          html:ret, 
                          focusConfirm: false,
                          showCancelButton: true,                         
                          }).then((result) => {
                            if (result.value) {                                             
                              cicloLectivoInicio = document.getElementById('cicloLectivoInicio').value;
                          
                              asignacionDocenteFinalD(cicloLectivoInicio);
                                             
                            }
                    });

 
            
      


      }
        });

}





function asignacionDocenteFinalD(cicloLectivoInicio) {

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
          data:'cicloLectivoInicio=' + cicloLectivoInicio,
          url:'modulos/extras/inicio/elementos/seccionDocente.php',
          success:function(r){ 

              $.unblockUI();

            if (r==1) {
               window.open('modulos/extras/inicio/imprimir_dj.php', '_blank');           
          
            }else{
              alert('Error de Servidor');
            }
           


      }
        });

}









<?php 
    
      if ($_SESSION["d_j_pregunta"] != 'NO') {   ?>


function dj_do(){
  
   $("#collapseOne").collapse('hide');


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



     


                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )



                  $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
       
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/dj/buscar.php');
        $('#tablaInstitucional').html('');

             

   
        
    }



<?php 
    
      }  ?>


 <?php 
          
    
      if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>

     function libretaDigitalDocenteEstrella(){
           $("#collapseOne").collapse('hide');


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





                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/notas/buscarCicloLectivo.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )


              

        

    }


 <?php 
          
    
     }   ?>












<?php 
          
    
      if ($_SESSION["inscrpcion_pregunta"] != 'NO') {   ?>

     function actas(){
           $("#collapseOne").collapse('hide');


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





                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actasBuscar.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )


              

        

    }


 <?php 
          
    
     }   ?>









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

