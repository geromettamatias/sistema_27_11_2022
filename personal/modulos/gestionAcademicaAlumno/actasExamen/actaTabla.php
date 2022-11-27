<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$operacion=$_SESSION["operacion"];
$buscarTipo=$_SESSION['buscarTipo'];
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



$consulta = "SELECT `actas_examen_datos_$cicloLectivo`.`idActa`, `actas_examen_datos_$cicloLectivo`.`edicion_docente`,`plan_datos_asignaturas`.`ciclo`, `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `plan_datos_asignaturas`.`idPlan`, `actas_examen_datos_$cicloLectivo`.`precentacion`, `actas_examen_datos_$cicloLectivo`.`finalizacion`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `actas_examen_datos_$cicloLectivo`.`tipo` = '$buscarTipo'";
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
                  
        <?php if ($operacion=='Lectura y Escritura'){ ?>


                <button class="btn btn-outline-primary" title="NUEVA ACTA" onclick="Agregar()"><i class='fas fa-user-plus'></i> NUEVA ACTA</button>
                <button class="btn btn-outline-danger" title="EDITAR/ELIMINAR ACTA" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i> EDITAR/ELIMINAR ACTA</button>
                <hr>
                <button class="btn btn-outline-warning" title="EQUIPO PEDAGOGICO" onclick="equipo_peda()"><i class="fas fa-cog fa-spin"></i>EQUIPO PEDAGOGICO</button>

                <button class="btn btn-outline-success" title="VISUALIZAR EQUIPO" onclick="visualizar()"><i class='fas fa-user-plus'></i> VISUALIZAR EQUIPO</button>

                <hr>


                <button class="btn btn-outline-success" title="INSCRIPCIONES DE ESTUDIANTE" onclick="inscrip()"><i class='fas fa-user-plus'></i> INSCRIPCIONES DE ESTUDIANTE</button>
                
                <button class="btn btn-outline-danger" title="CAMBIO DE ESTADO" onclick="estado()"><i class="fas fa-sync fa-spin"></i> CAMBIO DE ESTADO</button>


<?php } ?>


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
        <?php } ?>
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





<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')) { ?>



 <div class="modal fade" id="modalCRUD_acta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
            <div id="cont" class="modal-body">
           
                <input type="text" class="form-control" id="id" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>

 
                <div class="form-group">
     
                <div class="form-group">
                  <label for="fechaActa" class="col-form-label">FECHA INICIO</label>
                  <div class="col-10">
                    <input class="form-control" type="date" id="fechaActa">
                  </div>
                </div>
                <div class="form-group">
                  <label for="fechaActa" class="col-form-label">FECHA CIERRE</label>
                  <div class="col-10">
                    <input class="form-control" type="date" id="fechaActaCierre">
                  </div>
                </div>

                   <div class="form-group">
              <label for="equipo" class="col-form-label ediCur">Equipo Pedagógico:</label><br>
                        <select class="form-select" id="equipo" >
                             <option value="0">Seleccione el Equipo Pedagógico</option>
                             <?php

                                $c1onsulta = "SELECT `id`, `titulo`, `id_docente`, `obser` FROM `acta_examen_equipo_pedagogico_$cicloLectivo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['id'] ?>"><?php echo $d1at['titulo']; ?></option>
                                <?php } ?>
                        </select>
                
               </div>

                          
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="agregar_editar()" > <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>
</div>
     <?php } ?>





   
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





function editarEliminar(){


    if (preguntar==1) {

  Swal.fire({
          title: 'QUE DESEA HACER CON EL NUEVO CORREO?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'EDITAR',
          denyButtonText: `ELIMINAR`,
        }).then((result) => {
          
          if (result.isConfirmed) {

                editar_FINAL();


          } else if (result.isDenied) {

                eliminar_FINAL();
          }
        })


    }else{

        toastr.warning('No selecciono ninguno');

    }

}


function remover () {

    
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}





function editar_FINAL () {


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



    id=dataFila[0];
   

          $.ajax({
            url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/seccion_editar.php",
            type: "POST",
            data: {id:id},
            dataType: "json",
            success: function(data){  
                console.log(data);
                $.unblockUI(); 
                idActa = data[0].idActa;
                precentacion = data[0].precentacion; 
                id_equipo = data[0].id_equipo; 
                finalizacion = data[0].finalizacion;    
            
                $("#id").val(idActa);    
                $("#fechaActa").val(precentacion);
                $("#fechaActaCierre").val(finalizacion);
                $('#equipo').val(id_equipo).trigger('change.select2');
                $("#opcion").val(2);
                

                $(".modal-header").css("background-color", "#4e73df");
                $(".modal-header").css("color", "white");
                $(".modal-title").text(dataFila[1]);            
                $("#modalCRUD_acta").modal("show");  
               
            }
        });




}



function eliminar_FINAL(){


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
   

dataFila_dos=[];
    dataFila_dos.push(dataFila[0]);
    dataFila_dos.push(dataFila[0]);
    dataFila_dos.push(dataFila[0]);
    dataFila_dos.push(dataFila[0]);
    dataFila_dos.push(dataFila[0]);
    dataFila_dos.push(3);

    console.log(dataFila_dos)
        
        $.ajax({
             url:"modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
            type: "POST",
            data: {dataFila:dataFila_dos},
            success: function(r){
                console.log(r)
                if (r==1) {
                    myTable.rows('.selected').remove().draw();
                    toastr.info('Excelente !!');
                    $.unblockUI(); 
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });

        
     

}


function equipo_peda () {

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

  
   $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/equipopeda.php');
  $('#contenidoAyuda').html(''); 

  $('#imagenProceso').hide();

}





function Agregar () {

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

  
   $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/nueva_acta.php');
  $('#contenidoAyuda').html(''); 

  $('#imagenProceso').hide();

}



function estado() {
            
 
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
       url:"modulos/gestionAcademicaAlumno/actasExamen/elementos/cambiar_estado.php",
        type: "POST",
        data: {dataFila:dataFila},
        success: function(res){  
            console.log(res);
            data = res.split('||');

            idActa = data[0];            
            asignatura = data[1];
            precentacion = data[2];
            fechaActaCierre = data[3];
            equipo = data[4];

            edicion = data[5];


            if (edicion=='DESACTIVO') {
                    boton= '<font color="red">DESACTIVO</font>';
                }else if(edicion=='ACTIVO'){

                    boton= '<font color="green">ACTIVO</font>';

                }


             


                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idActa,asignatura,precentacion,fechaActaCierre,equipo,boton]);

       

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

function agregar_editar () {
            

           $("#modalCRUD_acta").modal("hide"); 
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


   
    id= $("#id").val();
    fechaActa= $("#fechaActa").val();
    fechaActaCierre= $("#fechaActaCierre").val();
    equipo= $("#equipo").val();
    opcion= $("#opcion").val();


      if (equipo==0) {
      toastr.warning('No esta seleccionado el Equipo');
      $.unblockUI(); 
      return false;
    }

    if (fechaActa=='') {
      toastr.warning('No esta seleccionado la fecha de Inicio');
      $.unblockUI(); 
      return false;
    }

    if (fechaActaCierre=='') {
      toastr.warning('No esta seleccionado la fecha de Cierre');
      $.unblockUI(); 
      return false;
    }


    dataFila=[];
    dataFila.push(equipo);
    dataFila.push(fechaActa);
    dataFila.push(fechaActaCierre);
    dataFila.push(id);
    dataFila.push(id);
    dataFila.push(opcion);

    console.log(dataFila)

    $.ajax({
       url:"modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
        type: "POST",
        data: {dataFila:dataFila},
        success: function(res){  
            console.log(res);
            data = res.split('||');

            idActa = data[0];            
            asignatura = data[1];
            precentacion = data[2];
            fechaActaCierre = data[3];
            equipo = data[4];

            edicion = data[5];


            if (edicion=='DESACTIVO') {
                    boton= '<font color="red">DESACTIVO</font>';
                }else if(edicion=='ACTIVO'){

                    boton= '<font color="green">ACTIVO</font>';

                }


             


                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idActa,asignatura,precentacion,fechaActaCierre,equipo,boton]);

       

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

<?php } ?>


 

</script>



