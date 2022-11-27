<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];


$idAlumnos=$_SESSION["idAlumnos"];


$nombreAlumnos='';



$consulta = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`domicilioAlumnos`, `datosalumnos`.`emailAlumnos`, `datosalumnos`.`telefonoAlumnos`, `datosalumnos`.`discapasidadAlumnos`, `datosalumnos`.`nombreTutor`, `datosalumnos`.`dniTutor`, `datosalumnos`.`TelefonoTutor`, `datosalumnos`.`idPlanEstudio`, `datosalumnos`.`fechaNa`, `datosalumnos`.`nacido`, `datosalumnos`.`procedencia`, `datosalumnos`.`nacionalidadTutor`, `plan_datos`.`nombre` FROM `datosalumnos` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan` =  `datosalumnos`.`idPlanEstudio` WHERE `datosalumnos`.`idAlumnos`='$idAlumnos'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {
        
        $nombreAlumnos=$dat['nombreAlumnos'];
        $dniAlumnos=$dat['dniAlumnos'];
        $domicilioAlumnos=$dat['domicilioAlumnos'];
        $telefonoAlumnos=$dat['telefonoAlumnos'];
        $discapasidadAlumnos=$dat['discapasidadAlumnos'];
        $nombreTutor=$dat['nombreTutor'];
        $dniTutor=$dat['dniTutor'];
        $TelefonoTutor=$dat['TelefonoTutor'];
        $idPlanEstudio=$dat['idPlanEstudio'];
        $nombre=$dat['nombre'];
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
    $idPlanEstudio='SIN-DATOS';
    $nombre='SIN-DATOS';
    $fechaNa='SIN-DATOS';
    $nacido='SIN-DATOS';
    $procedencia='SIN-DATOS';
    $nacionalidadTutor='SIN-DATOS';
    $emailAlumnos='SIN-DATOS';
       
}


?>






  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">DATOS DE <?php echo $nombreAlumnos.', DNI: '.$dniAlumnos; ?></h3>

                <div class="card-tools">

                 <button onclick="regresar()" type="button" class="btn btn-tool"  title="Regresar lista de Alumno del curso">
                    <i class='fas fa-reply-all'></i>
                  </button>


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


<button class="btn btn-danger" title="EDITAR" onclick="editar_datos()">EDITAR LOS DATOS <i class="fas fa-cog fa-spin"></i></button>
<?php } ?>


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
            <td>PLAN DE ESTUDIO INSCRIPTO</td>
            <td id="idPlanEstudio_1"><?php echo $idPlanEstudio.'||'.$nombre; ?></td>
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







        <?php if ($operacion=='Lectura y Escritura'){ ?>



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
                            <div class="col-md-12">
                                
                                <label for="discapasidadAlumnos" class="form-label">Discapacidad</label>
                                 <textarea class="form-control" id="discapasidadAlumnos" rows="3"></textarea>
                            </div>

            
                        </div>


                           <div class="row">
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
                                
                                <label for="domicilioAlumnos" class="col-form-label">Domicilio:</label>
                                 <input type="text" class="form-control" id="domicilioAlumnos">

                            </div>

                            <div class="col-md-4">
                   
                                <label for="emailAlumnos" class="col-form-label">Email:</label>
                              
                                 <input id="emailAlumnos" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">

                            </div>
                          
                        </div>
                        <hr>

                   


                           <div class="row">
                            <div class="col-md-4">

                                 <label for="idPlanEstudio" class="col-form-label">Orientación al que se inscribe:</label>
                        <select class="form-control" id="idPlanEstudio">
                             <?php

                                $c1onsulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['idPlan'] ?>"><?php echo $d1at['nombre'] ?></option>
                                <?php } ?>
                        </select>

                            </div>

                            <div class="col-md-4">
                                
                                <label for="nacido" class="col-form-label">Nacido:</label>
                                <input type="text" class="form-control" id="nacido">

                            </div>

                            <div class="col-md-4">
                                
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
                                
                                 <label for="nacionalidadTutor" class="col-form-label">Nacionalidad/TUTOR:</label>
                                <input type="text" class="form-control" id="nacionalidadTutor">

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



<?php } ?>






   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();

$('[data-mask]').inputmask()



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


         <?php if ($operacion=='Lectura y Escritura'){ ?>





function remover () {

    
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  



}





function editar_datos () {

 
    idPlanEstudio_1=$("#idPlanEstudio_1").html();

    datos=idPlanEstudio_1.split('||');
    idPlanEstudio=datos[0];

    $('#idPlanEstudio').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
    });
   $('#idPlanEstudio').val(idPlanEstudio).trigger('change.select2');



    fechaNa_1=$("#fechaNa_1").html();
    $("#fechaNa").val(fechaNa_1);

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


  
    idPlanEstudio=$("#idPlanEstudio").val();
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


   
    datos=dniTutor.split('_');
   

     if (!(datos.length==1)) {
        toastr.error('El DNI del Tutor esta incompleto o debe completar con ceros');
          $.unblockUI();  
        return false;
    }



    $("#modale_datos_Alumnos").modal("hide"); 

    dataFila=[];
    dataFila.push(idPlanEstudio);
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

    console.log(dataFila)

    $.ajax({
        url: "modulos/cargaDatos/datosAlumno/elementos/crub_alumnosDatos.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);


            domicilioAlumnos = data[0].domicilioAlumnos;            
            emailAlumnos = data[0].emailAlumnos;
            telefonoAlumnos = data[0].telefonoAlumnos;
            discapasidadAlumnos = data[0].discapasidadAlumnos;
            nombreTutor = data[0].nombreTutor;
            dniTutor = data[0].dniTutor;
            TelefonoTutor = data[0].TelefonoTutor;
            idPlanEstudio = data[0].idPlanEstudio;
            fechaNa = data[0].fechaNa;
            nacido = data[0].nacido;
            procedencia = data[0].procedencia;
            nacionalidadTutor = data[0].nacionalidadTutor;
            nombre = data[0].nombre;
          

       
            $("#idPlanEstudio_1").html(idPlanEstudio+'||'+nombre);
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





<?php } ?>



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




        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAlumno/alumnos.php');
     
}
 

</script>



