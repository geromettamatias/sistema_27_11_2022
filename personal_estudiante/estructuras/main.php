


<script type="text/javascript">

<?php

$actualizar_datos=$_SESSION["actualizar_datos"];

if ($actualizar_datos=='SI') {


 ?>


setTimeout(function(){
    actualizar_datos();
}, 3000);


function actualizar_datos(){

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


                toastr.warning('Actualice sus datos antes de continuar');

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/extras/ajustes/ajustes.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();
                
}




<?php } ?>


 cargaDatoPagina();
$(document).ready(function(){

    $('#iconos').load('modulos/extras/inicio/inicio.php');
    $('#tablaInstitucional').load('modulos/extras/inicio/datos.php');



     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');


    $('#imagenProceso').hide();

   


    function sacarSelect() {


         $("#collapseOne").collapse('hide');

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


  $("#usuarioTexto").click(function(){

 
      toastr.success('Es el nivel de usuario que está actualmente designado, dentro del sistema');

   
    });


   $("#autoGestionTitulo").click(function(){

      toastr.success('Sistema de Gestión escolar donde administra toda la información institucional');


   
    });

  

$("#calendario").click(function(){


             
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
       
        $('#buscarTablaInstitucional').load('modulos/extras/calendarioEscolar/calendario.php');
        $('#tablaInstitucional').html('');
        sacarSelect();
     
        
    });





    $("#cerrarSession").click(function(){
      $('#imagenProceso').show();


    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
    
    $('#imagenProceso').hide();


  }); 




 <?php if ($_SESSION["ajustes_pregunta"] != 'NO') {   ?>

     $("#ajustesFinal").click(function(){


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
                $('#buscarTablaInstitucional').load('modulos/extras/ajustes/ajustes.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

   
   
        
    });

 <?php  }   ?>


 <?php  if ($_SESSION["analitico_pregunta"] != 'NO') {   ?>

      

    $("#analiticoAlumno").click(function(){


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
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/analitico.php');
           


         sacarSelect();

      $("#analiticoAlumno").removeClass("nav-link");
      $("#analiticoAlumno").addClass("nav-link active");
         
        
    });


<?php  }   ?>



 <?php  if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>

     $("#libretaDigitalAlumno").click(function(){


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
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/libreta/buscarLibretaDigital.php');
        

         


       sacarSelect();

      $("#libretaDigitalAlumno").removeClass("nav-link");
      $("#libretaDigitalAlumno").addClass("nav-link active");
        
    });

 <?php  }   ?>


      $("#visualizarNotaMesa").click(function(){



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
                $('#tablaInstitucional').html('');
               $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/visualizacion_Mesa/buscar_ciclo.php');
               
          

         



       sacarSelect();

      $("#visualizarNotaMesa").removeClass("nav-link");
      $("#visualizarNotaMesa").addClass("nav-link active");
        
        
      });
    
      



  <?php  if ($_SESSION["inasistencia_pregunta"] != 'NO') {   ?>


        $("#inasistencia").click(function(){



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

    

                    ret=`<select class="form-control" id="cicloLectivo_INA">
                              
                                
                                `+r+`
                                </select></div>`;
                     

                      Swal.fire({
                              title: 'AÑO LECTIVO',
                              html:ret, 
                              focusConfirm: false,
                              showCancelButton: true,                         
                              }).then((result) => {
                                if (result.value) {                                             
                                  cicloLectivo_INA = document.getElementById('cicloLectivo_INA').value;
                              
                       

                                  inasistenciaIrAluw(cicloLectivo_INA);
                                                  
                                }
                        });




                   }        
                      });




            
       sacarSelect();

      $("#inasistencia").removeClass("nav-link");
      $("#inasistencia").addClass("nav-link active");
        
        
        
    });


<?php }  ?>



});


 <?php  if ($_SESSION["inasistencia_pregunta"] != 'NO') {   ?>


 function inasistenciaIrAluw(cicloLectivo_INA){



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
       
        data: {cicloLectivo_INA:cicloLectivo_INA},
        success: function(data){  
            

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/inasistencia/inasistencia.php');
           
        }        
    });
}

 <?php  }  ?>

function cargaDatoPagina() {
    
  

        $.ajax({
        url: "estructuras/bd/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
       
            tituloS = data.titulo;
            tituloMenuS = data.tituloMenu;
            url = data.url;
            
      

            $('#logoImagenF').val('<img src="../elementos/'+url+'"   style="width: 40%;" class="mx-auto d-block">');

        

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = "../elementos/"+url+"";



                  var imagenPrevisualizacionFFF = document.querySelector("#mostrarimagenLoFFF");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacionFFF.src = "../elementos/"+url+"";    







         
            //  verificamos que sea PDF
           
               imagenPrevisualizacion.src = "../elementos/"+url+"";

        $('#tituloMenuURL').val(url);

          $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
              
        }        
    });

}





</script>
