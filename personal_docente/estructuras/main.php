
<script type="text/javascript">

$(document).ready(function(){

    $('#iconosInicio').load('modulos/extras/inicio/inicio.php');

     $('#tablaInstitucional').load('modulos/extras/inicio/elementos.php');



     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');


    $('#imagenProceso').hide();

    cargaDatoPagina();

    cargaDatoPagina_Login();


   
    

<?php

$actualizar_datos=$_SESSION["actualizar_datos"];

if ($actualizar_datos=='SI') {


 ?>


setTimeout(function(){
    actualizar_final();
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












   

    
    function sacarSelect() {

           $("#collapseOne").collapse('hide');

      
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


      $("#circularProfe").removeClass("nav-link active");
      $("#circularProfe").addClass("nav-link");

    }



  <?php 
        
    
      if ($_SESSION["d_j_pregunta"] != 'NO') {   ?>

 $("#dj").click(function(){


             
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
        sacarSelect();
                    $("#dj").removeClass("nav-link");
                    $("#dj").addClass("nav-link active");
             

        
    });



 <?php 
        
    
      }  ?>








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














    $("#usuarioTexto").click(function(){

 
      toastr.success('Es el nivel de usuario que está actualmente designado, dentro del sistema');

   
    });


   $("#autoGestionTitulo").click(function(){

      toastr.success('Sistema de Gestión escolar donde administra toda la información institucional');


   
    });



    $("#cerrarSession").click(function(){
      $('#imagenProceso').show();


    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
    
    $('#imagenProceso').hide();


  }); 












function actualizar_final(){

                 
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



                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/extras/ajustes/ajustes.php');
                $('#tablaInstitucional').html('');
               


           
                  sacarSelect();
             




}




 $("#ajustesFinal").click(function(){



    actualizar_final();
        
            
   
        
    });







   <?php 
        
    
      if ($_SESSION["libreta_pregunta"] != 'NO') {   ?>

     $("#libretaDigitalDocente").click(function(){



            
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


                  sacarSelect();
                    $("#libretaDigitalDocente").removeClass("nav-link");
                    $("#libretaDigitalDocente").addClass("nav-link active");
                    
           

    });


   <?php 
            }
    
        ?>







<?php 
    
      if ($_SESSION["inscrpcion_pregunta"] != 'NO') {   ?>


     $("#actaExamen").click(function(){


            
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


                  sacarSelect();
                    $("#actaExamen").removeClass("nav-link");
                    $("#actaExamen").addClass("nav-link active");
                    
        
    });


<?php 
    
      }  ?>



        $("#circularProfe").click(function(){

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
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/circulares/circulares.php');

        sacarSelect();
                    $("#circularProfe").removeClass("nav-link");
                    $("#circularProfe").addClass("nav-link active");
                    
   
        
    });



























      



});





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




function cargaDatoPagina_Login() {
  

        $.ajax({
        url: "estructuras/bd/crud_datos.php",
        type: "POST",
        data: {},
        success: function(res){  
        


       if (res!=0) {
          $('#usuarioNombreDNI').html(res);


          }else{

             window.location.href = "../login/";
          }
 
                     
              
        }        
    });

}

function datosPersonal() {


  
        $.ajax({
        url: "estructuras/bd/datosDocente.php",
        type: "POST",
        dataType: "json",
        data: {},
         success: function(data){  
            

            idDocente = data[0].idDocente;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            domicilio = data[0].domicilio;
            email = data[0].email;
            telefono = data[0].telefono;
            titulo = data[0].titulo;


            $("#infoPersonal").html('<b>USUARIO: </b>'+nombre+'<br><b>DNI: </b>'+dni+'<br><b>Correo: </b>'+email+'<br><b>Telefono: </b>'+telefono+'<br><b>Titulo: </b>'+titulo+'<br><b>Domicilio: </b>'+domicilio);
            

                  
        }        
    });
}


</script>
