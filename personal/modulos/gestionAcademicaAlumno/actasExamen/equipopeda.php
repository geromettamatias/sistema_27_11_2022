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


$consulta = "SELECT `id`, `titulo`, `id_docente`, `obser` FROM `acta_examen_equipo_pedagogico_$cicloLectivo`";
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
            <div class="card card-info">
              
              <div class="card-header">
                <h3 class="card-title">EQUIPOS PEDAGOGICOS</h3>

                <div class="card-tools">
                  <button onclick="regresar_mesas()" type="button" class="btn btn-tool"  title="Regresar lista de Alumno del curso">
                    <i class='fas fa-reply-all'></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="regresar_mesas()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

     
              <div id="cont_dos" class="card-body">
                <div class="chart">

                    <?php if ($operacion=='Lectura y Escritura'){ ?>


                <button class="btn btn-info" title="NUEVO EQUIPOS" onclick="Agregar()"><i class='fas fa-users'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>
<?php } ?>


<hr>
    <table id="tabla_correoSer" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>TITULO</th>
             <th>DOCENTES</th>
             <th>OBSER</th>
        
        </tr>
    </thead>
     <tbody>
        <?php  
     
         foreach($data as $dat) {

          $id=$dat['id'];
          $titulo=$dat['titulo'];
          $id_docente=$dat['id_docente'];
          $obser=$dat['obser'];

        ?>
        <tr>

            <td><?php echo $id; ?></td>
            <td><?php echo $titulo; ?></td>
            <td><?php 

            $docentes_datos='';
            

            if ($id_docente!='') {
   
$docente = explode(",", $id_docente);


foreach ($docente as $docen) {
 
 $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `idDocente`='$docen'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       foreach($data as $dat) {

            $nombre=$dat['nombre'];
            $dni=$dat['dni'];

            $docentes_datos.=''.$nombre.'; '.$dni.'<br>';
        }




 }

     echo $docentes_datos;
}


             ?></td>
            
            <td><?php echo $obser; ?></td>


          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>TITULO</th>
             <th>DOCENTES</th>
             <th>OBSER</th>
        
                
            
        </tr>
    </tfoot>
</table>





        <?php if ($operacion=='Lectura y Escritura'){ ?>



<div class="modal fade" id="modalCRUD_equipo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Equipo Pedagógico</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
             <div class="modal-body">

                <input type="text" class="form-control" id="id" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>

                      <div class="col-md-12">
                      <label>TITULO</label>

                  
                  
                     <input class="form-control" type="text" id="titulo_dos">

                 

                </div>

                    <div class="col-md-12">
                      <label>OBSERVACION</label>

                  
                  
                     <input class="form-control" type="text" id="obser">

                 

                </div>
                
                

              <div id="cont" class="col-md-12">
        
          
                      <label>SELECCIONE LOS DOCENTES</label>

               
                  <select id="docentes" class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                          style="width: 100%;">
                 


                             <?php

            

                            $c1onsulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {

                                         $idDocente = $d1at['idDocente'];
                                         $dni = $d1at['dni'];
                                         $nombre = $d1at['nombre'];
                             

                                 ?>
                                <option value="<?php echo $idDocente; ?>"><?php echo $nombre.'; '.$dni; ?></option>
                                <?php } ?>
        
                  </select>
          
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


    var myTable = $('#tabla_correoSer').DataTable({
        "destroy":true, 
           "pageLength" : 2,   
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

$('#tabla_correoSer tbody').on('click', 'tr', function () {



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


      id=dataFila[0];


        
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/letura_equipo.php",
            type: "POST",
            data: {id:id},
            success: function(res){
              

              data = res.split('||');

              id = data[0];            
              titulo = data[1];
              id_docente = data[2];
              obser = data[3];
     

              array_docente = id_docente.split(',');

              $('#docentes').select2({
                  dropdownParent: "#cont",
                  theme: "bootstrap-5", 

              });

               $('#docentes').val(array_docente).trigger('change.select2');
                

              
                $("#id").val(id);
                $("#titulo_dos").val(titulo);
                $("#obser").val(obser);
                
    
                  $.unblockUI();

               
            }
        });


 


    $("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del Usuario");            
    $("#modalCRUD_equipo").modal("show");  


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
            url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/crub_equipo.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){
            
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


  $('#docentes').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});

 $('#docentes').val([]).trigger('change.select2');
  


    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Equipo Pedagógico"); 
    $("#id").val(null);
   
    $("#titulo_dos").val('');
    $("#obser").val('');

    $("#opcion").val(1);





    $("#modalCRUD_equipo").modal("show"); 



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



  id= $("#id").val();
  docentes= $("#docentes").val();
 obser= $("#obser").val();
  titulo= $("#titulo_dos").val();
  opcion= $("#opcion").val();



  formato_base_docente='';
  for (var i = docentes.length - 1; i >= 0; i--) {
  
    if (formato_base_docente=='') {
      formato_base_docente=docentes[i];
    }else{
      formato_base_docente+='\,'+docentes[i];
    }
  }

  console.log(formato_base_docente);

  if (formato_base_docente=='') {
     toastr.warning('No selecciono ninguno docente');
      $.unblockUI();
      return false;
  }

           $("#modalCRUD_equipo").modal("hide"); 
        

   

     dataFila=[];
    dataFila.push(id);
    dataFila.push(titulo);
    dataFila.push(formato_base_docente);
    
    dataFila.push(obser);
    dataFila.push(opcion);
   
  
 console.log(dataFila);
    $.ajax({
        url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/crub_equipo.php",
        type: "POST",
        data: {dataFila:dataFila},
        success: function(res){  

            console.log(res);
            data = res.split('||');

            id = data[0];            
            titulo = data[1];
            docentes_datos = data[2];
            obser = data[3];
   
       
            if (opcion==1) {
                myTable.row.add([id,titulo,docentes_datos,obser]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([id,titulo,docentes_datos,obser]);

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}

<?php } ?>


 

</script>



















                

              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>

           </div>

          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

 <script type="text/javascript">

$.unblockUI();

function regresar_mesas () {


    
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


</script>