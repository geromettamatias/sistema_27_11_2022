
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];

if ((isset($_SESSION['cursoSe']))){
$cursoSe=$_SESSION['cursoSe'];

  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

}




$asig_array_id=array();
$asig_array_nombre=array();

 $c2onsulta = "SELECT DISTINCT `plan_datos_asignaturas`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivo`.`ciclo` FROM `plan_datos_asignaturas` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`ciclo` = `plan_datos_asignaturas`.`ciclo` WHERE `curso_$cicloLectivo`.`idCurso` ='$cursoSe'";




                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idAsig=$d2at['idAsig'];
                    $nombre=$d2at['nombre'];
                    
                    array_push($asig_array_id, $idAsig);
                    array_push($asig_array_nombre, $nombre);


                
            }






$consulta = "SELECT `id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs`, `id_curso` FROM `nombres_secciones_asig_$cicloLectivo` WHERE `id_curso`='$cursoSe'";
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
                <h3 class="card-title">SECCIONES DE LAS ASIGNATURAS POR CICLO</h3>

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


                <button class="btn btn-info" title="NUEVO SECCION" onclick="Agregar()"><i class='fas fa-folder-plus'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>
<?php } ?>


<hr>
    <table id="tabla_SECCION_ASIGNATURA" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>ID/ASIG</th>
             <th>NOMBRE SECCION</th>
             <th>PROFESOR</th>
             <th>PERIODO</th>
             <th>OBS</th>
                            
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {

       

        ?>
        <tr>

            <td><?php echo $dat['id_seccion'] ?></td>
            <td><?php

                $asignatura_array = explode(",", $dat['asignatura']);
                $imprimir='';

                foreach ($asignatura_array as $id_asignatura) {
                    
                    $consulta_2 = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan`, `cantidadHoraCatedra` FROM `plan_datos_asignaturas` WHERE `idAsig`='$id_asignatura'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                        $idAsig=$dat_2['idAsig'];
                        $nombre=$dat_2['nombre'];

                        if ($imprimir=='') {
                            $imprimir.=$idAsig.'-'.$nombre;
                        }else{
                            $imprimir.='||'.$idAsig.'-'.$nombre;
                        }
                    }


                }

             echo $imprimir; ?></td>
            <td><?php echo $dat['nombre_seccion'] ?></td>
            <td><?php 

                      $profesores_array = explode(",", $dat['id_profesores']);

                $imprimir='';

                foreach ($profesores_array as $id_profesores) {
                    
                    $consulta_2 = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `idDocente`='$id_profesores'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                        $idDocente=$dat_2['idDocente'];
                        $nombre=$dat_2['nombre'];
                        $dni=$dat_2['dni'];

                        if ($imprimir=='') {
                            $imprimir.=$idDocente.'-'.$nombre;
                        }else{
                            $imprimir.='||'.$idDocente.'-'.$nombre;
                        }
                    }


                }



            echo $imprimir; ?></td>
            <td><?php echo $dat['periodo'] ?></td>
            <td><?php echo $dat['obs'] ?></td>
            
  
        </tr>
        <?php }?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>ID/ASIG</th>
             <th>NOMBRE SECCION</th>
             <th>PROFESOR</th>
             <th>PERIODO</th>
             <th>OBS</th>
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



<div class="modal fade" id="modalCRUD_asignatr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div  class="modal-body">

                <input type="text" class="form-control" id="id_seccion" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>

                <input type="text" class="form-control" id="asignatura_vieja" hidden=''>
                <input type="text" class="form-control" id="nombre_vieja" hidden=''>
                
                <div id="cont_1" class="form-group">
                <label for="asignatura_dos" class="col-form-label">ASIGANTURA:</label>

                    <?php
  


        $cat_uno='';
        for ($i=0; $i < count($asig_array_id); $i++) { 
            
            $cat_uno.="<option value='".$asig_array_id[$i]."'>".$asig_array_id[$i].'-'.$asig_array_nombre[$i]."</option>";
        }

         

    



                  
?>
                    <select class="form-control" multiple="multiple" data-placeholder="Seleccione las Asignaturas" style="width: 100%;" id="asignatura_dos">

                
                  <?php echo $cat_uno;  ?>
                </select>



                </div>


                <div class="form-group">
                <label for="nombre_seccion_no" class="col-form-label">NOMBRE DE LA SECCION:</label>
                <input type="text" class="form-control" id="nombre_seccion_no">
                </div>



                <div id="cont_2" class="form-group">
                <label for="docentes" class="col-form-label">DOCENTES:</label>

                    <?php


                    $cat='';

                          $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes`";
                          $resultado = $conexion->prepare($consulta);
                          $resultado->execute();
                          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                          foreach($data as $dat) {
                            $dni=$dat['dni'];
                            $nombre=$dat['nombre'];
                             $idDocente=$dat['idDocente'];
                            

                             $cat.="<option value='".$idDocente."'>".$dni.'||'.$nombre."</option>";

                        
                    }


                                      
                    ?>
                    <select class="form-control" multiple="multiple" data-placeholder="Seleccione lo/s docentes" style="width: 100%;" id="docentes_dos">

                    
                      <?php echo $cat;  ?>
                    </select>
               
                </div>
                
                <div class="form-group">
                  <label>DESDE/HASTA:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="periodo">
                  </div>
                  <!-- /.input group -->
                </div>

                 <div class="form-group">
                <label for="host" class="col-form-label">Observación:</label>
                <textarea id="observacion" class="form-control" rows="3" placeholder="Observación ..."></textarea>
                </div>

               
           

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>



<?php } ?>






   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


    var myTable = $('#tabla_SECCION_ASIGNATURA').DataTable({
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


var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_SECCION_ASIGNATURA tbody').on('click', 'tr', function () {



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
          title: 'QUE DESEA HACER CON ESTA SECCION?',
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


    asignatu=dataFila[1];
 

    asignatu_array=asignatu.split('||');

    valor=[];
    valor_viejo='';

    for (var i = asignatu_array.length - 1; i >= 0; i--) {
        
        asignatu_array_dos=asignatu_array[i];
        asignatu_array_tres=asignatu_array_dos.split('-');
        id_asig=asignatu_array_tres[0];
        
        valor.push(id_asig);

        if (valor_viejo=='') {
            valor_viejo+=''+id_asig;
        }else{
            valor_viejo+=','+id_asig;
        }

    }

    $("#asignatura_vieja").val(valor_viejo);


        $('#asignatura_dos').select2({
            dropdownParent: "#cont_1",
            theme: "bootstrap-5", 

        });

    
        $('#asignatura_dos').val(valor).trigger('change.select2');

        //Date range picker
        $('#periodo').daterangepicker();

        $('#periodo').val(dataFila[4]).trigger('change.select2');



          docente=dataFila[3];
 

            docente_array=docente.split('||');

            valor_do=[];

            for (var i = docente_array.length - 1; i >= 0; i--) {
                
                docente_array_dos=docente_array[i];
                docente_array_tres=docente_array_dos.split('-');
                id_docen=docente_array_tres[0];
                
                valor_do.push(id_docen);

            }


        $('#docentes_dos').select2({
            dropdownParent: "#cont_2",
            theme: "bootstrap-5", 

        });

       $('#docentes_dos').val(valor_do).trigger('change.select2');


        $("#id_seccion").val(dataFila[0]);

    $("#observacion").val(dataFila[5]);

    $("#nombre_seccion_no").val(dataFila[2]);
    $("#nombre_vieja").val(dataFila[2]);



    $("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar la seccion");            
    $("#modalCRUD_asignatr").modal("show");  


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
   

 
    asignatu=dataFila[1];
 

    asignatu_array=asignatu.split('||');

    valor=[];
    asignatura_vieja='';

    for (var i = asignatu_array.length - 1; i >= 0; i--) {
        
        asignatu_array_dos=asignatu_array[i];
        asignatu_array_tres=asignatu_array_dos.split('-');
        id_asig=asignatu_array_tres[0];
        
        valor.push(id_asig);

        if (asignatura_vieja=='') {
            asignatura_vieja+=''+id_asig;
        }else{
            asignatura_vieja+=','+id_asig;
        }

    }
    
        nombre_vieja= dataFila[2];


        id_seccion=dataFila[0];

        console.log({id_seccion:id_seccion,asignatura_vieja:asignatura_vieja,nombre_vieja:nombre_vieja});
        
        $.ajax({
            url: "modulos/herramientas/secciones_notas_materias/elementos/crub_eliminar.php",
            type: "POST",
            data: {id_seccion:id_seccion,asignatura_vieja:asignatura_vieja,nombre_vieja:nombre_vieja},
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






function Agregar () {

    
    
    $("#id_seccion").val(null);
    $("#opcion").val(1);


    //Date range picker
    $('#periodo').daterangepicker();

    $('#asignatura_dos').select2({
    dropdownParent: "#cont_1",
    theme: "bootstrap-5", 

});

    $('#docentes_dos').select2({
    dropdownParent: "#cont_2",
    theme: "bootstrap-5", 

});
    $('#asignatura_dos').val('').trigger('change.select2');
    $('#docentes_dos').val('').trigger('change.select2');
    $('#equipo').val('').trigger('change.select2');

    $("#observacion").val('');

    $("#nombre_seccion_no").val('');


    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva seccion"); 

    $("#modalCRUD_asignatr").modal("show"); 



}





function agregar_editar () {
            

            
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


    id_seccion= $("#id_seccion").val();
    asignatura= $("#asignatura_dos").val();
    nombre_seccion_no= $("#nombre_seccion_no").val();
    docentes= $("#docentes_dos").val();
    periodo= $("#periodo").val();
    observacion= $("#observacion").val();
    opcion= $("#opcion").val();
    asignatura_vieja= $("#asignatura_vieja").val();
    nombre_vieja= $("#nombre_vieja").val();

    nombre_seccion_no_prue=nombre_seccion_no.split(' ');

 
    if (nombre_seccion_no_prue.length>1) {

        toastr.warning('El nombre de la Seccion no debe contener espacio en blanco, utilize guion bajo _');
            $.unblockUI();
            return false;
    }

    myTable.rows().data().each(function (value) {

      nombre_viejo_ta= value[2];

        if (nombre_seccion_no==nombre_viejo_ta) {
            toastr.error('El nombre de la seccion es repetido !!');
            $.unblockUI();
            return false;
        }

    });


    asignatura=asignatura.toString();
     docentes=docentes.toString();

    if (asignatura=='') {
        toastr.warning('Falta la asignatura !!');
        $.unblockUI();
        return false;
    }
    if (nombre_seccion_no=='') {
        toastr.warning('Falta la Nombre !!');
        $.unblockUI();
        return false;
    }
    if (docentes=='') {
        toastr.warning('Falta la Docentes !!');
        $.unblockUI();
        return false;
    }
    if (periodo=='') {
        toastr.warning('Falta la Periodos !!');
        $.unblockUI();
        return false;
    }
    if (observacion=='') {
        toastr.warning('Falta la observacion !!');
        $.unblockUI();
        return false;
    }

    $("#modalCRUD_asignatr").modal("hide");

    dataFila=[];
    dataFila.push(id_seccion);
    dataFila.push(asignatura);
    dataFila.push(nombre_seccion_no);
    dataFila.push(docentes);
    dataFila.push(periodo);
    dataFila.push(observacion);
    dataFila.push(opcion);
    console.log(dataFila)


    $.ajax({
        url: "modulos/herramientas/secciones_notas_materias/elementos/crud_asig.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila,asignatura_vieja:asignatura_vieja,nombre_vieja:nombre_vieja},
        success: function(data){ 
            console.log(data);
        
            id_seccion = data[0];            
            asignatura = data[1];    
            nombre_seccion = data[2];    
            id_profesores = data[3];    
            periodo = data[4];    
            obs = data[5];    
            
            asignatura_array = data[6]; 
            profesores_array = data[7];  

            dataFila=[];
            dataFila.push(id_seccion);
            dataFila.push(asignatura_array);
            dataFila.push(nombre_seccion);
            dataFila.push(profesores_array);
            dataFila.push(periodo);
            dataFila.push(obs);
          
            if (opcion==1) {
                myTable.row.add([id_seccion,asignatura_array,nombre_seccion,profesores_array,periodo,obs]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([id_seccion,asignatura_array,nombre_seccion,profesores_array,periodo,obs]);



            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

<?php } ?>


 

</script>








