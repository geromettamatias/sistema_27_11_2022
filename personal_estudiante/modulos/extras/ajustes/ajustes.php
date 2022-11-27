<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-primary">
              
              <div class="card-header">
                <h3 class="card-title">EDITAR DATOS PERSONALES DE USUARIO</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button  type="button" class="btn btn-tool" data-card-widget="remove">
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


$s_usuarioEstudiante=$_SESSION["s_usuarioEstudiante"];



$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass`, `estado` FROM `datosalumnos` WHERE `dniAlumnos`='$s_usuarioEstudiante'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {
        
        $nombreAlumnos=$dat['nombreAlumnos'];
        $dniAlumnos=$dat['dniAlumnos'];
         $cuilAlumnos=$dat['cuilAlumnos'];
        $domicilioAlumnos=$dat['domicilioAlumnos'];
        $telefonoAlumnos=$dat['telefonoAlumnos'];
        $discapasidadAlumnos=$dat['discapasidadAlumnos'];
        $nombreTutor=$dat['nombreTutor'];
        $dniTutor=$dat['dniTutor'];
        $TelefonoTutor=$dat['TelefonoTutor'];
   
       
        $fechaNa=$dat['fechaNa'];
        $nacido=$dat['nacido'];
        $procedencia=$dat['procedencia'];
        $nacionalidadTutor=$dat['nacionalidadTutor'];
        $emailAlumnos=$dat['emailAlumnos'];
       
}

if ($nombreAlumnos=='') {
    $nombreAlumnos='SIN-DATOS';
    $dniAlumnos='SIN-DATOS';
    $domicilioAlumnos='SIN-DATOS';
    $telefonoAlumnos='SIN-DATOS';
    $discapasidadAlumnos='SIN-DATOS';
    $nombreTutor='SIN-DATOS';
    $dniTutor='SIN-DATOS';
    $TelefonoTutor='SIN-DATOS';
   
    
    $fechaNa='SIN-DATOS';
    $nacido='SIN-DATOS';
    $procedencia='SIN-DATOS';
    $nacionalidadTutor='SIN-DATOS';
    $emailAlumnos='SIN-DATOS';
       
}


 ?>


<button class="btn btn-danger" title="EDITAR" onclick="editar_datos()">EDITAR LOS DATOS <i class="fas fa-cog fa-spin"></i></button>

<button class="btn btn-warning" title="EDITAR CONTRASEÑA" onclick="editar_contraseña()">EDITAR LA CONTRASEÑA <i class="fas fa-cog fa-spin"></i></button>



<hr>
    <table id="tabla_correoSer" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>CONCEPTO</th>
             <th>DATOS</th>
                
        </tr>
    </thead>
     <tbody>

        <tr>
            <td>NOMBRE Y APELLIDO DEL ALUMNO</td>
            <td id="nombreAlumnos_1"><?php echo $nombreAlumnos; ?></td>
        </tr>

        <tr>
            <td>DNI DEL ALUMNO</td>
            <td id="dniAlumnos_1"><?php echo $dniAlumnos; ?></td>
        </tr>

        <tr>
            <td>CUIL DEL ALUMNO</td>
            <td id="cuilAlumnos_1"><?php echo $cuilAlumnos; ?></td>
        </tr>

   
         <tr>
            <td>FECHA DE NACIMIENTO DEL ALUMNO</td>
            <td id="fechaNa_1"><?php echo $fechaNa; ?></td>
        </tr>

        <tr>
            <td>EMAIL DEL ALUMNO</td>
            <td id="emailAlumnos_1"><?php echo $emailAlumnos; ?></td>
        </tr>

        <tr>
            <td>DOMICILIO</td>
            <td id="domicilioAlumnos_1"><?php echo $domicilioAlumnos; ?></td>
        </tr>

        <tr>
            <td>NACIONALIDAD</td>
            <td id="nacido_1"><?php echo $nacido; ?></td>
        </tr>

        <tr>
            <td>PROCEDENCIA</td>
            <td id="procedencia_1"><?php echo $procedencia; ?></td>
        </tr>

         <tr>
            <td>TELE-ALUMNO</td>
            <td id="telefonoAlumnos_1"><?php echo $telefonoAlumnos; ?></td>
        </tr>
         <tr>
            <td>CAPACIDADES DIFERENTES</td>
            <td id="discapasidadAlumnos_1"><?php echo $discapasidadAlumnos; ?></td>
        </tr>
        <tr>
            <td>DNI DEL TUTOR</td>
            <td id="dniTutor_1"><?php echo $dniTutor; ?></td>
        </tr>
        <tr>
            <td>APELLIDO Y NOMBRE DEL TUTOR</td>
            <td id="nombreTutor_1"><?php echo $nombreTutor; ?></td>
        </tr>
        <tr>
            <td>TEL. DEL TUTOR</td>
            <td id="TelefonoTutor_1"><?php echo $TelefonoTutor; ?></td>
        </tr>

        <tr>
            <td>NACIONALIDAD DEL TUTOR</td>
            <td id="nacionalidadTutor_1"><?php echo $nacionalidadTutor; ?></td>
        </tr>
        
       
    </tbody>        
    <tfoot>
        <tr>
             <th>CONCEPTO</th>
             <th>DATOS</th>
        </tr>
    </tfoot>
</table>





<div class="modal fade bd-example-modal-xl" id="modale_datos_Alumnos" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      
                         
           <div id="cont" class="modal-body">
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-md-4">
                                
                                <label for="nombreAlumnos" class="col-form-label">ALUMNO/A:</label>
                                 <input type="text" class="form-control" id="nombreAlumnos">

                            </div>

                             <div class="col-md-4">

                                 <label for="dniAlumnos" class="col-form-label">DNI ALUMNO/A:</label>

                                    <div class="input-group mb-3">
                                      <input id="dniAlumnos" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
                                      <div class="input-group-append"></div>

                                    </div>
                            </div>

                            <div class="col-md-4">

                                 <label for="cuilAlumnos" class="col-form-label">CUIL ALUMNO/A:</label>

                                    <div class="input-group mb-3">
                                      <input id="cuilAlumnos" type="text" class="form-control" data-inputmask='"mask": "99-99999999-9"' data-mask>
                                      <div class="input-group-append"></div>

                                    </div>
                            </div>
                        </div>
                        

                        

                        <div class="row">
                            <div class="col-md-12">
                                
                                <label for="discapasidadAlumnos" class="form-label">Discapacidad</label>
                                 <textarea class="form-control" id="discapasidadAlumnos" rows="3"></textarea>
                            </div>

            
                        </div>


                           <div class="row">

                            <div class="col-md-4">
                                
                                <label for="domicilioAlumnos" class="col-form-label">Domicilio:</label>
                                 <input type="text" class="form-control" id="domicilioAlumnos">

                            </div>


                            <div class="col-md-4">

                                <label for="fechaNa" class="col-form-label">Fecha Nacimiento:</label>
                                
                                  <div class="input-group mb-3">
                                     <input id="fechaNa" type="text" class="form-control" data-inputmask='"mask": "99-99-9999"' data-mask>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-address-card"></span>
                                        </div>
                                      </div>
                                    </div>

                            </div>

                          

                            <div class="col-md-4">
                   
                                <label for="emailAlumnos" class="col-form-label">Email:<div id="tex"></div></label>
                              
                                 <input id="emailAlumnos" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">

                            </div>
                          
                        </div>
                        <hr>

                   


                           <div class="row">
               

                            <div class="col-md-6">
                                
                                <label for="nacido" class="col-form-label">Nacido:</label>
                                <input type="text" class="form-control" id="nacido">

                            </div>

                            <div class="col-md-6">
                                
                                <label for="procedencia" class="col-form-label">Procedencia:</label>
                                 <input type="text" class="form-control" id="procedencia">

                            </div>
                          
                        </div>

                        <hr>
                        <hr>

                            <div class="row">
                            
                            <div class="col-md-6">

                                 <label for="dniTutor" class="col-form-label">DNI/TUTOR:</label>

                                    <div class="input-group mb-3">
                                      <input id="dniTutor" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
                                      <div class="input-group-append"></div>

                                    </div>
                            </div>
                            <div class="col-md-6">
                                
                                <label for="nombreTutor" class="col-form-label">TUTOR:</label>
                                <input type="text" class="form-control" id="nombreTutor">

                            </div>

                          
                          
                        </div>                 
                  


                                      <hr>
                        <div class="row">

                              <div class="col-md-3">
                                
                                 <label for="TelefonoTutor" class="col-form-label">TEL/TUTOR:</label>

                                    <div class="input-group mb-3">
                                      <input id="TelefonoTutor" type="text" class="form-control" data-inputmask='"mask": "9999-15-999999"' data-mask>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-address-card"></span>
                                        </div>
                                      </div>
                                    </div>

                            </div>

                      
                            



                            <div class="col-md-3">
                                
                                 <label for="telefonoAlumnos" class="col-form-label">TEL/ALUMNO:</label>

                                    <div class="input-group mb-3">
                                      <input id="telefonoAlumnos" type="text" class="form-control" data-inputmask='"mask": "9999-15-999999"' data-mask>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-address-card"></span>
                                        </div>
                                      </div>
                                    </div>

                            </div>

                            <div class="col-md-3">
                                
                                 <label for="nacionalidadTutor" class="col-form-label">Nacionalidad/TUTOR:</label>
                                <input type="text" class="form-control" id="nacionalidadTutor">

                            </div>
                          
                        </div>           
                           
                     
 </div>

           

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="editar_final_datos_alumnos ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>






<div class="modal fade bd-example-modal-xl" id="modal_contras" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      
                         
           <div id="cont" class="modal-body">
                    <div class="container-fluid">

                        <div class="row">

                             <div class="col-md-4">

                                  <div class="input-group mb-3">
                                      <div class="input-group-append claveVer_actual">
                                        <div  class="input-group-text">
                                          <span class="fa fa-eye icon cambio_actual"></span>
                                        </div>
                                      </div>
                                      <input id="pass_actual" type="password" class="form-control" placeholder="Contraseña actual" required>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-lock"></span>
                                        </div>
                                      </div>
                                    </div>
                            </div>


                             
                             <div class="col-md-4">

                                  <div class="input-group mb-3">
                                      <div class="input-group-append claveVer_nueva">
                                        <div  class="input-group-text">
                                          <span class="fa fa-eye icon cambio_nueva"></span>
                                        </div>
                                      </div>
                                      <input id="pass_nueva" type="password" class="form-control" placeholder="Contraseña nueva" required>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-lock"></span>
                                        </div>
                                      </div>
                                    </div>
                            </div>

                            
                             <div class="col-md-4">

                                  <div class="input-group mb-3">
                                      <div class="input-group-append claveVer_nueva_repetir">
                                        <div  class="input-group-text">
                                          <span class="fa fa-eye icon cambio_nueva_repetir"></span>
                                        </div>
                                      </div>
                                      <input id="pass_nueva_repetir" type="password" class="form-control" placeholder="Repetir contraseña nueva" required>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-lock"></span>
                                        </div>
                                      </div>
                                    </div>
                            </div>
                        </div>
                        

                      
                     
 </div>

           

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="editar_final_contra ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>

 
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();

$('[data-mask]').inputmask()







 var verificacionEmail ='1';

document.getElementById('emailAlumnos').addEventListener('input', function() {
    campo = event.target;
   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {

      $('#tex').html('<span style="color:#2471A3";>El correo es Válido</span>');
      verificacionEmail=1;
    } else {
      verificacionEmail=0; 
      $('#tex').html('<span style="color:#FF0000";>El correo es Incorrecto</span>'); 
    
    }
});


















 function mostrarContrasena_nueva(){
      var tipo = document.getElementById("pass_nueva");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

$( ".claveVer_nueva" ).mouseup(function() {

    $(".cambio_nueva").removeClass("fa fa-eye-slash icon");
    $(".cambio_nueva").addClass("fa fa-eye icon");
    mostrarContrasena_nueva();
  }).mousedown(function() {
    $(".cambio_nueva").removeClass("fa fa-eye icon");
    $(".cambio_nueva").addClass("fa fa-eye-slash icon");
    mostrarContrasena_nueva();
  });





function mostrarContrasena_actual(){
      var tipo = document.getElementById("pass_actual");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

$( ".claveVer_actual" ).mouseup(function() {

    $(".cambio_actual").removeClass("fa fa-eye-slash icon");
    $(".cambio_actual").addClass("fa fa-eye icon");
    mostrarContrasena_actual();
  }).mousedown(function() {
    $(".cambio_actual").removeClass("fa fa-eye icon");
    $(".cambio_actual").addClass("fa fa-eye-slash icon");
    mostrarContrasena_actual();
  });




      function mostrarContrasena_nueva_repetir(){
      var tipo = document.getElementById("pass_nueva_repetir");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

$( ".claveVer_nueva_repetir" ).mouseup(function() {

    $(".cambio_nueva_repetir").removeClass("fa fa-eye-slash icon");
    $(".cambio_nueva_repetir").addClass("fa fa-eye icon");
    mostrarContrasena_nueva_repetir();
  }).mousedown(function() {
    $(".cambio_nueva_repetir").removeClass("fa fa-eye icon");
    $(".cambio_nueva_repetir").addClass("fa fa-eye-slash icon");
    mostrarContrasena_nueva_repetir();
  });












    var myTable = $('#tabla_correoSer').DataTable({
        "destroy":true, 
           "pageLength" : 25,   
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
            className: 'btn btn-success'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'
          },
        ]         
        });




function remover () {

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




function editar_datos () {


      cuilAlumnos_1=$("#cuilAlumnos_1").html();
    $("#cuilAlumnos").val(cuilAlumnos_1);

     nombreAlumnos_1=$("#nombreAlumnos_1").html();
    $("#nombreAlumnos").val(nombreAlumnos_1);

    dniAlumnos_1=$("#dniAlumnos_1").html();
    $("#dniAlumnos").val(dniAlumnos_1);

    domicilioAlumnos_1=$("#domicilioAlumnos_1").html();
    $("#domicilioAlumnos").val(domicilioAlumnos_1);

    nacido_1=$("#nacido_1").html();
    $("#nacido").val(nacido_1);

    procedencia_1=$("#procedencia_1").html();
    $("#procedencia").val(procedencia_1);

    telefonoAlumnos_1=$("#telefonoAlumnos_1").html();
    $("#telefonoAlumnos").val(telefonoAlumnos_1);

    discapasidadAlumnos_1=$("#discapasidadAlumnos_1").html();
    $("#discapasidadAlumnos").val(discapasidadAlumnos_1);

     dniTutor_1=$("#dniTutor_1").html();
    $("#dniTutor").val(dniTutor_1);

     nombreTutor_1=$("#nombreTutor_1").html();
    $("#nombreTutor").val(nombreTutor_1);

     TelefonoTutor_1=$("#TelefonoTutor_1").html();
    $("#TelefonoTutor").val(TelefonoTutor_1);


     nacionalidadTutor_1=$("#nacionalidadTutor_1").html();
    $("#nacionalidadTutor").val(nacionalidadTutor_1);


     emailAlumnos_1=$("#emailAlumnos_1").html();
    $("#emailAlumnos").val(emailAlumnos_1);



    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modale_datos_Alumnos").modal("show");  


}

function editar_contraseña(){

   $(".modal-header").css("background-color", "#D433FF");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar la contraseña");            
    $("#modal_contras").modal("show");  


}


editar_final_contra


function editar_final_contra () {
            

           
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


   
    pass_actual=$("#pass_actual").val();
    pass_nueva=$("#pass_nueva").val();
    pass_nueva_repetir=$("#pass_nueva_repetir").val();

  
 
     if ((pass_actual=='') || (pass_nueva=='') || (pass_nueva_repetir=='')) {
        toastr.error('Uno de los campos de contraseña esta vacío');
          $.unblockUI();  
        return false;
    }
   

    if (pass_nueva!=pass_nueva_repetir) {
        toastr.error('La nueva contraseña, no son iguales a repetir la contraseña');
          $.unblockUI();  
        return false;
    }
 


    

    dataFila=[];
   
    dataFila.push(pass_actual);
    dataFila.push(pass_nueva);
 


    $.ajax({
        url: "modulos/extras/ajustes/elementos/datosAlumno_contra.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){ 

            if (data==1) {
                toastr.success('Excelente, contraseña editada !!');
                $.unblockUI();
                $("#modal_contras").modal("hide");  
            }else if (data==2) {
                toastr.warning('La contraseña actual no es la correcta !!');
                $.unblockUI(); 
            }else{
                toastr.error('Error de servidor, Comuniquese con la institución !!');
                $.unblockUI();
                $("#modal_contras").modal("hide"); 
            } 
    
            
              
        }        
    });

}










function editar_final_datos_alumnos () {
            

           
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


   
    nombreAlumnos=$("#nombreAlumnos").val();
    dniAlumnos=$("#dniAlumnos").val();
    cuilAlumnos=$("#cuilAlumnos").val();
    fechaNa=$("#fechaNa").val();  
    domicilioAlumnos=$("#domicilioAlumnos").val();
    nacido=$("#nacido").val();
    procedencia=$("#procedencia").val();
    telefonoAlumnos=$("#telefonoAlumnos").val();
    discapasidadAlumnos=$("#discapasidadAlumnos").val();
    dniTutor=$("#dniTutor").val();
    nombreTutor=$("#nombreTutor").val();
    TelefonoTutor=$("#TelefonoTutor").val();
    nacionalidadTutor=$("#nacionalidadTutor").val();
    emailAlumnos=$("#emailAlumnos").val();


    datos_1=cuilAlumnos.split('_');
  

    if (!(datos_1.length==1)) {
        toastr.error('El CUIL del Alumno esta incompleto o debe completar con ceros');
          $.unblockUI();  
        return false;
    }


    datos_2=dniAlumnos.split('_');
   

     if (!(datos_2.length==1)) {
        toastr.error('El DNI del Alumno esta incompleto o debe completar con ceros');
          $.unblockUI();  
        return false;
    }
   
    datos_3=dniTutor.split('_');
   
    if (!(datos_3.length==1)) {
        toastr.error('El DNI del Tutor esta incompleto o debe completar con ceros');
          $.unblockUI();  
        return false;
    }

    if (verificacionEmail==0) {
         toastr.error('El Correo Electronico del Alumno esta incompleto');
          $.unblockUI();  
        return false;
    }



    $("#modale_datos_Alumnos").modal("hide"); 

    dataFila=[];
   
    dataFila.push(fechaNa);
    dataFila.push(domicilioAlumnos);
    dataFila.push(nacido);
    dataFila.push(procedencia);
    dataFila.push(telefonoAlumnos);
    dataFila.push(discapasidadAlumnos);
    dataFila.push(dniTutor);
    dataFila.push(nombreTutor);
    dataFila.push(TelefonoTutor);
    dataFila.push(nacionalidadTutor);
    dataFila.push(emailAlumnos);
    dataFila.push(dniAlumnos);
    dataFila.push(nombreAlumnos);
    dataFila.push(cuilAlumnos);


    $.ajax({
        url: "modulos/extras/ajustes/elementos/datosAlumno.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
        

            domicilioAlumnos = data[0].domicilioAlumnos;            
            emailAlumnos = data[0].emailAlumnos;
            telefonoAlumnos = data[0].telefonoAlumnos;
            discapasidadAlumnos = data[0].discapasidadAlumnos;
            nombreTutor = data[0].nombreTutor;
            dniTutor = data[0].dniTutor;
            TelefonoTutor = data[0].TelefonoTutor;
     
            fechaNa = data[0].fechaNa;
            nacido = data[0].nacido;
            procedencia = data[0].procedencia;
            nacionalidadTutor = data[0].nacionalidadTutor;
            nombre = data[0].nombre;

            nombreAlumnos = data[0].nombreAlumnos;
            dniAlumnos = data[0].dniAlumnos;
             cuilAlumnos = data[0].cuilAlumnos;
          

            $("#cuilAlumnos_1").html(cuilAlumnos);    
            $("#dniAlumnos_1").html(dniAlumnos);
            $("#nombreAlumnos_1").html(nombreAlumnos);

            $("#fechaNa_1").html(fechaNa);  
            $("#domicilioAlumnos_1").html(domicilioAlumnos);
            $("#nacido_1").html(nacido);
            $("#procedencia_1").html(procedencia);
            $("#telefonoAlumnos_1").html(telefonoAlumnos);
            $("#discapasidadAlumnos_1").html(discapasidadAlumnos);
            $("#dniTutor_1").html(dniTutor);
            $("#nombreTutor_1").html(nombreTutor);
            $("#TelefonoTutor_1").html(TelefonoTutor);
            $("#nacionalidadTutor_1").html(nacionalidadTutor);
            $("#emailAlumnos_1").html(emailAlumnos);

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

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






