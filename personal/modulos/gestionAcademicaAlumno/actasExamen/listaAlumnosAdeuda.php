




  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">


                             <?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();


    $operacion=$_SESSION["operacion"];

    $cicloF=$_SESSION['cicloLectivo'];

    $cicloFF = explode("||", $cicloF);
    $cicloLectivo= $cicloFF[0]; 
    $edicion= $cicloFF[1]; 



    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
    
 
      
      $tipo=$_SESSION['tipo_titulo'];
      $idPlan=$_SESSION['idPlan_titulo'];
      $ciclo=$_SESSION['ciclo_titulo'];
      $nombreAsignatura=$_SESSION['nombreAsignatura_titulo'];
      $titulo=$_SESSION['titulo_titulo'];

              

?>






                 <?php echo $tipo; ?>
                 <?php echo '<br>TIPO: '.$idPlan.'--CICLO: '.$ciclo.'--ASIGNATURA: '.$nombreAsignatura; ?>
                 <br>Equipo Pedagógico: <?php echo $titulo; ?>
              







                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover7()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                
                                 
                <button onclick="regresar()" type="button" class="btn btn-warning" data-toggle="modal"  title="Regresar"><i class='fas fa-reply-all'></i></button>

                 <div class="table-responsive">  




                 <table id="tabla_inscripFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th>                         
                                <th>SEL</th>
                                <th>SITUACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                       <?php  
                            $colorFinal='';

                            $contadorColores=0;
                      
  if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='primary';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                            $colorFinal='info';
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='success';
                             }





                                         $consulta = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`,`asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`idAlumno`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `asignaturas_pendientes_$cicloLectivo`.`situacion`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`ciclo`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_1`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_2`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_3`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_4`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_5` FROM `datosalumnos` INNER JOIN `asignaturas_pendientes_$cicloLectivo` ON `asignaturas_pendientes_$cicloLectivo`.`idAlumno`=`datosalumnos`.`idAlumnos` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas`";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                                    foreach($data as $dat) { 

                                        $idAlumnos=$dat['idAlumnos'];
                                        $dniAlumnos=$dat['dniAlumnos'];
                                        $nombreAlumnos=$dat['nombreAlumnos'];


                                        $nombre=$dat['nombre'];
                                        $ciclo2=$dat['ciclo'];


                                        $calFinal_1=intval($dat['calFinal_1']);
                                        $calFinal_2=intval($dat['calFinal_2']);
                                        $calFinal_3=intval($dat['calFinal_3']);
                                        $calFinal_4=intval($dat['calFinal_4']);
                                        $calFinal_5=intval($dat['calFinal_5']);

                                        if ((($calFinal_1=='') || ($calFinal_1 < 6)) && (($calFinal_2=='') || ($calFinal_2 < 6)) && (($calFinal_3=='') || ($calFinal_3 < 6)) && (($calFinal_4=='') || ($calFinal_4 < 6)) && (($calFinal_5=='') || ($calFinal_5 < 6))) {
                                
                                            if (($nombreAsignatura==$nombre)&&($ciclo2==$ciclo)) {
                                            
                                            

                             ?>
                                            
                            <tr class="table-<?php echo $colorFinal; ?>">
                              
                              
                         
                                <td><?php echo $idAlumnos; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                                <td><button id="<?php echo $idAlumnos ?>" onclick="ingresar(<?php echo $idAlumnos ?>)" type="button" class="btn btn-info" data-toggle="modal" title="INSCRIBIR ALUMNO"><i class='fas fa-user-plus'></i></button></td>


                                <td><?php 

                                $res= '<div id="situ'.$idAlumnos.'"><FONT COLOR="green">NO INSCRIPTO</FONT></div>';

                                $idAlumnos2='';
                           $consulta = "SELECT `acta_examen_inscrip_$cicloLectivo`.`idInscripcion`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`idAlumnos`, `datosalumnos`.`dniAlumnos`, `acta_examen_inscrip_$cicloLectivo`.`notaEsc`, `acta_examen_inscrip_$cicloLectivo`.`notaOral`, `acta_examen_inscrip_$cicloLectivo`.`promNumérico`, `acta_examen_inscrip_$cicloLectivo`.`promLetra` FROM `acta_examen_inscrip_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `acta_examen_inscrip_$cicloLectivo`.`idAlumno` WHERE `acta_examen_inscrip_$cicloLectivo`.`idActa` = '$idActa_inscriAlumno'";
                              $resultado = $conexion->prepare($consulta);
                              $resultado->execute();
                              $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                              foreach($data as $dat) { 
                                     $idAlumnos2=$dat['idAlumnos'];
                                


                                if ($idAlumnos2==$idAlumnos) {
                                    $res= '<div id="situ'.$idAlumnos.'"><FONT COLOR="red">INSCRIPTO</FONT></div>';
                                }

                                }


                                echo $res;

                                 ?></td>

                            </tr>
                                    <?php 


                                        }


                                    } 


                                       


                                    }


                                         
                                                  


                                  


                             ?>                           
                        </tbody>        
                       </table>                    

               
              </div>
       

        



 <script type="text/javascript">
$(document).ready(function(){

 $.unblockUI();
 

    var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable({ 

          
                "destroy":true,  
                
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
                      
                    });





});

function ingresar(idAlumnos){

    // $.blockUI({ 
    //                                 message: '<h1>Espere !!</h1>',
    //                                 css: { 
    //                                 border: 'none', 
    //                                 padding: '15px', 
    //                                 backgroundColor: '#000', 
    //                                 '-webkit-border-radius': '10px', 
    //                                 '-moz-border-radius': '10px', 
    //                                 opacity: .5, 
    //                                 color: '#fff' 
    //                             } }); 

         if (idAlumnos==0) {

        Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'Debe seleccionar un alumno',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
    }else{
  

    
    $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_inscrp_Acta_Examen2.php',
          success:function(res){
            console.log(res)

            if (res=='1') {


                toastr.success('El alumno se inscribio a la mesa');


                $('#situ'+idAlumnos).html('<FONT COLOR="red">INSCRIPTO</FONT>');

                  $.unblockUI();


            }else if (res=='2'){

                toastr.error('El alumno ya estaba inscripto');

                  $.unblockUI();

            }
   
    
          }
        });


}


   
    
}  





function regresar() {

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
   

        
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
       

        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaInsc-ALUMNO.php');
   



}



function remover7 () {

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
        
                $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();


}




  $.unblockUI();
</script>



<?php } ?> 







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
