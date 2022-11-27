

<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$id_notificaciones=$_SESSION["id_notificaciones"];
$id_persona_destino=$_SESSION["id_persona_destino"];
$persona_destino=$_SESSION["persona_destino"];
$id_usuarios_confirmacion=$_SESSION["id_usuarios_confirmacion"];


$id_persona_dest = explode(",", $id_persona_destino);
$id_usuarios_confirma = explode(",", $id_usuarios_confirmacion);

$usuario_nombre_confirmado=array();
$usuario_dni_confirmado=array();
$confirma=array();

if ($persona_destino=='Docentes') {
                 

                 $consulta2 = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes`";
                  $resultado2 = $conexion->prepare($consulta2);
                  $resultado2->execute();
                  $dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a2 as $da1t2) { 

                    $id=$da1t2['idDocente'];
                    $dni=$da1t2['dni'];
                    $nombre=$da1t2['nombre'];


                    $comprobar_esta=0;
                    $comprobar_verificado=0;
                    

                    foreach ($id_persona_dest as $id_persona_d) {
                      if ($id_persona_d==$id) {

                            $comprobar_esta=1;
                            
                            foreach ($id_usuarios_confirma as $id_usuarios_conf) {
                                if ($id_usuarios_conf==$id) {
                                    $comprobar_verificado=1;     
                                }

                            }
                      }
                      
                    }


                    if ($comprobar_esta==1) {
                        array_push($usuario_nombre_confirmado, $nombre);
                        array_push($usuario_dni_confirmado, $dni);

                        if ($comprobar_verificado==1) {
                              array_push($confirma, '<font color="blue">CONFIRMADO</font>');
                        }else{
                              array_push($confirma, '<font color="red">NO CONFIRMADO</font>');
                        }
                    }
                    
                 
                    }


            }else if ($persona_destino=='Personales') {
                  

                  $consulta2 = "SELECT `idUsu`, `nombre`, `dni` FROM `personal_eet16`";
                  $resultado2 = $conexion->prepare($consulta2);
                  $resultado2->execute();
                  $dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a2 as $da1t2) { 

                    $id=$da1t2['idUsu'];
                    $dni=$da1t2['dni'];
                    $nombre=$da1t2['nombre'];
                 
                    
                    $comprobar_esta=0;
                    $comprobar_verificado=0;
                    

                    foreach ($id_persona_dest as $id_persona_d) {
                      if ($id_persona_d==$id) {

                            $comprobar_esta=1;
                            
                            foreach ($id_usuarios_confirma as $id_usuarios_conf) {
                                if ($id_usuarios_conf==$id) {
                                    $comprobar_verificado=1;     
                                }

                            }
                      }
                      
                    }


                    if ($comprobar_esta==1) {
                        array_push($usuario_nombre_confirmado, $nombre);
                        array_push($usuario_dni_confirmado, $dni);

                        if ($comprobar_verificado==1) {
                              array_push($confirma, '<font color="blue">CONFIRMADO</font>');
                        }else{
                              array_push($confirma, '<font color="red">NO CONFIRMADO</font>');
                        }
                    }
                    
                 
   
                    }


            }else if ($persona_destino=='Estudiantes') {
                    

                    $consulta2 = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos` FROM `datosalumnos`";
                  $resultado2 = $conexion->prepare($consulta2);
                  $resultado2->execute();
                  $dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a2 as $da1t2) { 

                    $id=$da1t2['idAlumnos'];
                    $dni=$da1t2['dniAlumnos'];
                    $nombre=$da1t2['nombreAlumnos'];
           
               
                    $comprobar_esta=0;
                    $comprobar_verificado=0;
                    

                    foreach ($id_persona_dest as $id_persona_d) {
                      if ($id_persona_d==$id) {

                            $comprobar_esta=1;
                            
                            foreach ($id_usuarios_confirma as $id_usuarios_conf) {
                                if ($id_usuarios_conf==$id) {
                                    $comprobar_verificado=1;     
                                }

                            }
                      }
                      
                    }


                    if ($comprobar_esta==1) {
                        array_push($usuario_nombre_confirmado, $nombre);
                        array_push($usuario_dni_confirmado, $dni);

                        if ($comprobar_verificado==1) {
                              array_push($confirma, '<font color="blue">CONFIRMADO</font>');
                        }else{
                              array_push($confirma, '<font color="red">NO CONFIRMADO</font>');
                        }
                    }
                    
                 
                  }


            } 



?>

 <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Lista de usuarios notificados</h3>

         

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
                    

                     <table id="tabla_verificacion" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>NOMBRE</th>
             <th>DNI</th>
             <th>SITUACIÓN</th>
                        
        </tr>
    </thead>
     <tbody>
        <?php  
         for ($i=0; $i < count($usuario_nombre_confirmado); $i++) { 


          $confirma_fi=$confirma[$i];

          if ($confirma_fi=='<font color="blue">CONFIRMADO</font>') {
            $tabla='info';
          }else{
            $tabla='danger';
          }

        ?>
        <tr class="table-<?php echo $tabla; ?>">

            <td><?php echo $usuario_nombre_confirmado[$i]; ?></td>
            <td><?php echo $usuario_dni_confirmado[$i]; ?></td>
            <td><?php echo $confirma_fi; ?></td>
          
        </tr>
        <?php } ?>

    </tbody>        
    <tfoot>
        <tr>   
             <th>NOMBRE</th>
             <th>DNI</th>
             <th>SITUACIÓN</th>
            
        </tr>
    </tfoot>
</table>


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


    var myTable = $('#tabla_verificacion').DataTable({
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



</script>












