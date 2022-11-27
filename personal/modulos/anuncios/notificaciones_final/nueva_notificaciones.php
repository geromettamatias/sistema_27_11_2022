<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$id_notificaciones=$_SESSION["id_notificaciones"];
$persona_origen=$_SESSION["persona_origen"];
$id_persona_origen=$_SESSION["id_persona_origen"];
$persona_destino=$_SESSION["persona_destino"];
$id_persona_destino=$_SESSION["id_persona_destino"];
$asunto=$_SESSION["asunto"];
$texto=$_SESSION["texto"];
$id_usuarios_confirmacion=$_SESSION["id_usuarios_confirmacion"];
$opcion=$_SESSION["opcion"];




?>

 <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Notificación</h3>

         

            <div class="card-tools">

              <button onclick="regresar()" type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-reply"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Usuario Destino</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                    </div>
                    <select class="form-select" id="persona_destino" >
                          
                          <option>Seleccione el Usuario</option>

                          <?php  if ($persona_destino=='Docentes'){  ?> 
                            <option selected>Docentes</option>
                          <?php }else{  ?> 
                            <option>Docentes</option>
                          <?php }  ?>


                          <?php  if ($persona_destino=='Personales'){  ?> 
                            <option selected>Personales</option>
                          <?php }else{  ?> 
                            <option>Personales</option>
                          <?php }  ?>

                          <?php  if ($persona_destino=='Estudiantes'){  ?> 
                            <option selected>Estudiantes</option>
                          <?php }else{  ?> 
                            <option>Estudiantes</option>
                          <?php }  ?>

                        </select>
                  </div>
                  <!-- /.input group -->

                </div>
             
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
         
            </div>


             <div class="row">

              <div class="col-md-12">

                <div class="form-group">
        
          
                     

               
                      <div id="usuario_id_carga"> </div>
          
             
                <!-- /.form-group -->
 
            </div>
            </div>
            </div>

            <div class="row">
           
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  
                  <label>ASUNTO</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                    </div>
                    <input id="asunto_data" type="text" class="form-control" value="<?php echo $asunto ?>">
                  </div>
                </div>
              </div>


            </div>

            <div class="row">
           
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  
                  <label>Mensaje</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <textarea id="test_data" class="form-control" rows="10" cols="40"><?php echo $texto ?></textarea>
                  </div>
                </div>
              </div>


        



            </div>
           


            <div class="row">
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <button onclick="guardar_final()" class="btn btn-outline-success btn-block">Register</button>
                    </div>
                  </div>
            </div>
            <hr>
       

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Los datos son confidenciales, solo la institución podrá visualizarlo por motivos administrativos. 
          </div>
        </div>
        </div>


</section>




<script type="text/javascript">
$.unblockUI();



cargar_usuarios();


   
function regresar(){

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


        
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/anuncios/notificaciones_final/notificaciones.php');
         
          $('#contenidoAyuda').html(''); 


}


 //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

 $('[data-mask]').inputmask()




  $("#persona_destino").change(function(){
  
    cargar_usuarios();

   });





  function cargar_usuarios(){


    persona_destino= $('#persona_destino').val();
  

    if (persona_destino!='Seleccione el Usuario') {


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
          data:'persona_destino=' + persona_destino,
          url:'modulos/anuncios/notificaciones_final/elementos/session_id_usuario_sele.php',
          success:function(r){
            

            $('#usuario_id_carga').load('modulos/anuncios/notificaciones_final/carga_usuario.php');
          }
        });

     }else{

        $('#usuario_id_carga').html('');
        
         $.unblockUI();



     }
  }




function guardar_final(){

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
 


persona_destino = $.trim($("#persona_destino").val());
asunto_data = $.trim($("#asunto_data").val());
usuario_id_carga = $.trim($("#usuario_id_carga_d").val());
test_data = $.trim($("#test_data").val());



if (persona_destino=='Seleccione el Usuario') {
  toastr.warning('No selecciono ninguno Usuario');
  $.unblockUI();
  return false; 
}

if (usuario_id_carga=='') {
  toastr.warning('No selecciono ninguno destino');
  $.unblockUI();
  return false; 
}

if (asunto_data=='') {
  toastr.warning('No escribio ningun asunto');
  $.unblockUI();
  return false; 
}

if (test_data=='') {
  toastr.warning('No escribio ningun texto o mensaje');
  $.unblockUI();
  return false; 
}



persona_destino = $.trim($("#persona_destino").val());
asunto_data = $.trim($("#asunto_data").val());
usuario_id_carga = $.trim($("#usuario_id_carga_d").val());
test_data = $.trim($("#test_data").val());


 $.ajax({
          type:"post",
          data:'persona_destino=' + persona_destino+'&asunto_data=' + asunto_data+'&usuario_id_carga=' + usuario_id_carga+'&test_data=' + test_data,
          url:'modulos/anuncios/notificaciones_final/elementos/crud_notificacion.php',
          success:function(r){
            
            if (r==1) {
              toastr.success('Notificación registrado');
              
                   
               $('#contenidoCursos').html('');
              $('#tablaInstitucional').html('');
            
              $('#buscarTablaInstitucional').html(''); 
              $('#tablaInstitucional').load('modulos/anuncios/notificaciones_final/notificaciones.php');
               
                $('#contenidoAyuda').html(''); 


            }else{
              toastr.error('Problema del servidor');
              console.log(r);
              $.unblockUI();
            }
            
          }
        });

}






</script>
