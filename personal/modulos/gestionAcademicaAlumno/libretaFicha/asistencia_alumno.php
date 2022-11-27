


  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-danger">
              
              <div class="card-header">
                <h3 class="card-title">




                  <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];




$id_Alumno_Asistencia=$_SESSION['id_Alumno_Asistencia'];

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


 
$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$id_Alumno_Asistencia'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                foreach($data as $dat) {
                                    $nombreAlumnos=$dat['nombreAlumnos'];
                                    $dniAlumnos=$dat['dniAlumnos'];
                                      }



        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `idAlumno`='$id_Alumno_Asistencia'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  



                           
                        



              
  
                            ?>  



                            
                  <div id="datos_titulo">INASISTENCIA (APELLIDO Y NOMBRE: <?php echo $nombreAlumnos; ?>; DNI:<?php echo $dniAlumnos; ?>)</div>







                </h3>

                <div class="card-tools">

                 

                  <button onclick="remover12()" type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-reply"></i>
                  </button>

                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover12()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">



    <table class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>INASISTENCIA JUSTIFICADA</th>
            <th>INASISTENCIA INJUSTIFICADA</th>
            <th>TOTAL</th> 
  
        </tr>
    </thead>
     <tbody>
        <tr>

            <td><div id="asistencia_justificado"> </div></td>
            <td><div id="asistencia_injustificado"> </div></td>
            <td><div id="asistencia_total"> </div></td>
     
        </tr>
  
    </tbody>        
   
</table>


<hr>


<?php if (($edicion=='SI') && ($operacion=='Lectura y Escritura')) { ?>

<button class="btn btn-info" title="NUEVA INASISTENCIA" onclick="Agregar()"><i class='fas fa-upload'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>

<?php } ?>

<button onclick="btnNuevo_Asistencia_Alumno_imprimir()" type="button" class="btn btn-info" data-toggle="modal" title="IMPRIMIR"><i class='fas fa-print'></i></button>


<hr>
    <table id="tabla_asistencia" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>CANTIDAD</th> 
            <th>JUSTIFICO</th>
            <th>OBSERV.</th>
            <th>ENCABEZADO</th>
                
        </tr>
    </thead>
     <tbody>
        <?php  
                                   
                            
                             foreach($data as $dat) {

                            $id_Asistencia=$dat['id_Asistencia'];
                            $idAlumno=$dat['idAlumno'];
                            $fecha=$dat['fecha'];
                            $cantidad=$dat['cantidad'];
                            $justificado=$dat['justificado'];
                            $observacion=$dat['observacion'];
                            $encabezado=$dat['encabezado'];
        ?>
        <tr>

            <td><?php echo $id_Asistencia ?></td>
            <td><?php echo $fecha ?></td>
            <td><?php echo $cantidad; ?></td>
            <td><?php echo $justificado ?></td>
            <td><?php echo $observacion ?></td>
            <td><?php echo $encabezado ?></td>  


          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
              <th>ID</th>
            <th>FECHA</th>
            <th>CANTIDAD</th> 
            <th>JUSTIFICO</th>
            <th>OBSERV.</th>
            <th>ENCABEZADO</th>
                
            
        </tr>
    </tfoot>
</table>



<div class="modal fade" id="modalCRUD_CorreoApp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="id" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>
                
               
                 
                
                
                <div class="form-group">
                <label for="fecha_Alumno" class="col-form-label">FECHA:</label>
                <input type="date" class="form-control" id="fecha_Alumno">
                </div>
                <div class="form-group">
                <label for="cantidad_Alumno" class="col-form-label">CANTIDAD:</label>
             
                <select class="form-control" id="cantidad_Alumno">
                          <option>1</option>
                          <option>0,5</option>
                          <option>0,25</option>
                         
                </select>



                </div> 
                <div class="form-group">
                <label for="justifico_Alumno" class="col-form-label">JUSTIFICO:</label>
                
                <select class="form-control" id="justifico_Alumno">
                          <option>NO</option>
                          <option>SI</option>
                </select>
                </div>

                 <div class="form-group">
                      <label for="encabezado" class="col-form-label">CURSO Y ASIGNATURA:</label>
                      <select class="form-control" id="encabezado">
                          
                           <?php
                     
                          $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo` WHERE `corresponde`='FICHA/LIBRETA'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();

                          $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                          foreach($dat1a as $da1t) { 
                           
                            $nombreAsig=$da1t['nombre'];
                       

                            ?>
                            <option><?php echo $nombreAsig ?></option>
                            <?php } ?>

                            
                        </select>
                </div>
 

                 <div class="form-group">
                <label for="osb_Alumno" class="col-form-label">OSERBACIÓN:</label>
                
                <textarea id="osb_Alumno" class="form-control" rows="10" cols="40"></textarea>
                </div> 



           

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>








   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


    var myTable = $('#tabla_asistencia').DataTable({
        "destroy":true,
scrollX:        "800px",   
scrollY:        "600px",

paging:         false,
fixedColumns: false,   
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
            className: 'btn btn-success',
            title:$('#datos_titulo').html(), 
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger',
             title:$('#datos_titulo').html(),
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
            title:$('#datos_titulo').html(),
          },
        ]         
        });




var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_asistencia tbody').on('click', 'tr', function () {



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


function editarEliminar(){


    if (preguntar==1) {

  Swal.fire({
          title: 'QUE DESEA HACER CON ESTA INASISTENCIA?',
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



function editar_FINAL () {

    
 

    $("#id").val(dataFila[0]);
    $("#fecha_Alumno").val(dataFila[1]);

    cantidad_tres=dataFila[2];

       if (cantidad_tres=='1') {
        cantidad_tres='1';
      }else if (cantidad_tres=='0.5') {
        cantidad_tres='0,5';
      }else if (cantidad_tres=='0.25') {
        cantidad_tres='0,25';
      }



    $("#cantidad_Alumno").val(cantidad_tres);



    
    $("#justifico_Alumno").val(dataFila[3]);
    $("#osb_Alumno").val(dataFila[4]);
    $("#encabezado").val(dataFila[5]);
    $("#opcion").val(2);

  

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos de la inasistencia");            
    $("#modalCRUD_CorreoApp").modal("show");  


}



function eliminar_FINAL(){


                            $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 
   

     dataFila.push(3);




        
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/crud_Asistencia_Alumno.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){
            
                if (r==1) {


              
                    myTable.rows('.selected').remove().draw();
                    toastr.info('Excelente !!');
                    $.unblockUI(); 

                    calculo();
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });

        
     

}






function Agregar () {

    
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva inasistencia"); 
    $("#id_correoSer").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_CorreoApp").modal("show"); 



}





function agregar_editar () {
            

           $("#modalCRUD_CorreoApp").modal("hide"); 
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
    fecha_Alumno= $("#fecha_Alumno").val();
    cantidad_Alumno= $("#cantidad_Alumno").val();
    justifico_Alumno= $("#justifico_Alumno").val();
    osb_Alumno= $("#osb_Alumno").val();
    encabezado= $("#encabezado").val();
    opcion= $("#opcion").val();

    dataFila=[];
    dataFila.push(id);
    dataFila.push(fecha_Alumno);
    dataFila.push(cantidad_Alumno);
    dataFila.push(justifico_Alumno);
    dataFila.push(osb_Alumno);
    dataFila.push(encabezado);
    dataFila.push(opcion);


    $.ajax({
        url: "modulos/gestionAcademicaAlumno/libretaFicha/elementos/crud_Asistencia_Alumno.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
              id_Asistencia = data[0].id_Asistencia;            
           
            fecha = data[0].fecha;
            cantidad = data[0].cantidad;

   

            justificado = data[0].justificado;
            observacion = data[0].observacion;
            encabezado = data[0].encabezado;

              $.unblockUI(); 
              


                dataFila=[];
                dataFila.push(id);
                dataFila.push(fecha_Alumno);
                dataFila.push(cantidad_Alumno);
                dataFila.push(justifico_Alumno);
                dataFila.push(osb_Alumno);
                dataFila.push(encabezado);
              


       
            if (opcion==1) {
                myTable.row.add([id_Asistencia,fecha,cantidad,justificado,observacion,encabezado]).draw();

                calculo();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([id_Asistencia,fecha,cantidad,justificado,observacion,encabezado]);

                calculo();

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}



 function btnNuevo_Asistencia_Alumno_imprimir(){
    window.open('modulos/gestionAcademicaAlumno/libretaFicha/asistenciaAlumnoImprimir.php', '_blank'); 

}

function remover12 () {

  
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
           
            $('#contenidoAyuda').load('modulos/gestionAcademicaAlumno/libretaFicha/Notas_TablaInscrp.php');


        


}

calculo();

function calculo(){

total_justificado=0;
total_injustificado=0;

  myTable.rows().data().each(function (value) {

// obtengo el valor de cada fila
var id= value[0];

var cantidad= value[2];
var justifico= value[3];

if (cantidad=='0,5') {
  cantidad=0.5;
}else if (cantidad=='0,25') {
  cantidad=0.25;
}else if (cantidad=='1') {
  cantidad=1;
}

if (justifico=='SI') {
  total_justificado=total_justificado+cantidad;
}else if (justifico=='NO') {
  total_injustificado=total_injustificado+cantidad;
}

total=total_justificado+total_injustificado;



$('#asistencia_justificado').html(total_justificado);
$('#asistencia_injustificado').html('<font color="red"><b>'+total_injustificado+'</b></font>');
$('#asistencia_total').html(total);



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











