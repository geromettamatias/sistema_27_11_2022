<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$idUsuario=$_SESSION["idUsuario"];
$operacion=$_SESSION["operacion"];
$buscarTipo=$_SESSION['buscarTipo'];
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



$consulta = "SELECT `actas_examen_datos_$cicloLectivo`.`idActa`, `actas_examen_datos_$cicloLectivo`.`edicion_docente`,`plan_datos_asignaturas`.`ciclo`, `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `plan_datos_asignaturas`.`idPlan`, `actas_examen_datos_$cicloLectivo`.`precentacion`, `actas_examen_datos_$cicloLectivo`.`finalizacion`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`id_docente` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `actas_examen_datos_$cicloLectivo`.`tipo` = '$buscarTipo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>






  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">LISTA DE ACTAS  <?php echo $buscarTipo ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  
  


                <button class="btn btn-outline-success" title="VISUALIZAR EQUIPO" onclick="visualizar()"><i class='fas fa-user-plus'></i> VISUALIZAR EQUIPO</button>

                <hr>


                <button class="btn btn-outline-success" title="INSCRIPCIONES DE ESTUDIANTE" onclick="inscrip()"><i class='fas fa-user-plus'></i> INSCRIPCIONES DE ESTUDIANTE</button>
                
              


<hr>
    <table id="tabla_examen" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>N°</th>
            <th>ASIGNATURA</th>
            <th>FECHA INICIO</th>
            <th>FECHA CIERRE</th>
            <th>EQUIPO</th>
            <th>EDICION DOCENTE</th>
                
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {

            $idActa=$dat['idActa'];
            $ciclo=$dat['ciclo'];
            $idPlan=$dat['idPlan'];
            $nombreAsignatura=$dat['nombreAsignatura'];
            $precentacion=$dat['precentacion'];
            $finalizacion=$dat['finalizacion'];
            $titulo=$dat['titulo'];

            $edicion_docente=$dat['edicion_docente'];

            $id_docente=$dat['id_docente'];

            $docente = explode(",", $id_docente);

            $pregunta=0;


            foreach ($docente as $docen) {
             
                if ($docen==$idUsuario) {
                    $pregunta=1;
                }

             }
            


             if ($pregunta==1) {
        
        ?>
        <tr>

            <td><?php echo $idActa ?></td>
            <td><?php echo $ciclo.'--'.$nombreAsignatura.'--'.$idPlan; ?></td>
            <td><?php
                        $date = date_create($precentacion);
                        $cadena_precentacion = date_format($date, 'd-m-Y');
                        echo $cadena_precentacion; 
                    ?>
                        
            </td>
            <td><?php
                        $date_finalizacion = date_create($finalizacion);
                        $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');
                        echo $cadena_finalizacion; 
                    ?>
                        
            </td>
            <td><?php echo $titulo ?></td>
            <td><?php 



                if ($edicion_docente=='DESACTIVO') {
                    echo '<font color="red">DESACTIVO</font>';
                }else if($edicion_docente=='ACTIVO'){

                    echo '<font color="green">ACTIVO</font>';

                }


                 ?></td>

          
        </tr>
        <?php }} ?>
    </tbody>        
    <tfoot>
        <tr>
            <th>N°</th>
            <th>ASIGNATURA</th>
            <th>FECHA INICIO</th>
            <th>FECHA CIERRE</th>
            <th>EQUIPO</th>
            <th>EDICION DOCENTE</th>
        </tr>
    </tfoot>
</table>






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




 <div class="modal fade" id="modale_visual" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
            <div id="cont" class="modal-body">
           
               <div id="tabla_visual_final"></div>

                          
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                
            </div>
     
    </div>
  </div>
</div>





   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();
  $('.duallistbox').bootstrapDualListbox()


    var myTable = $('#tabla_examen').DataTable({
        "destroy":true, 
           "pageLength" : 10,   
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


         <?php if ($operacion=='Lectura y Escritura'){ ?>


var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_examen tbody').on('click', 'tr', function () {



            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                preguntar=0;
            }else{
                myTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                preguntar=1;
            }
   
            dataFila = myTable.row( this ).data();

console.log(myTable.rows( '.selected' )[0][0]);

} );




function inscrip(){


    if (preguntar==1) {

        inscrpcionALUMNOS();


    }else{

        toastr.warning('No selecciono ninguno');

    }

}





function inscrpcionALUMNOS() {


     idActa=dataFila[0];

     fecha_inicio=dataFila[2];

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
          data:'idActa=' + idActa+'&fecha_inicio='+fecha_inicio,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/session_actaInscrAlumno.php',
          success:function(res){

                   
          
          }
        });

        
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
       

        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaInsc-ALUMNO.php');
   



}












function visualizar(){


    if (preguntar==1) {

        visualizar_final();


    }else{

        toastr.warning('No selecciono ninguno');

    }

}








function visualizar_final () {


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


    idActa=dataFila[0];


        
   

          $.ajax({
            url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/seccion_visual.php",
            type: "POST",
            data: {idActa:idActa},
            success: function(res){  

                console.log(res)
                
                if (res!=1) {
                    toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                    return false;
                }

                 $.unblockUI();
               

                $("#tabla_visual_final").load('modulos/gestionAcademicaAlumno/actasExamen/elementos/visualizar.php'); 

                $(".modal-header").css("background-color", "#4e73df");
                $(".modal-header").css("color", "white");
                $(".modal-title").text('Equipo Pedagógico: '+dataFila[4]);            
                $("#modale_visual").modal("show"); 
              
              
            }
        });




}



function remover () {

    
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}






<?php } ?>


 

</script>



