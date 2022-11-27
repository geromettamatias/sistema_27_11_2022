<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$operacion=$_SESSION["operacion"];


require '../../bd/libreria-php-json/json-file-decode.class.php';




?>






  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">LISTA DE NOTIFICACIONES</h3>

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


                <button class="btn btn-info" title="NUEVA NOTIFICACION" onclick="Agregar()"><i class='fas fa-upload'></i></button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i></button>
<?php } ?>

<button class="btn btn-danger" title="Usuarios Notificado" onclick="notificado()"><i class="fas fa-book"></i></button>

<hr>
    <table id="tabla_correoSer" class="table table display" style="width:100%">
    <thead>
        <tr>

             <th>N°</th>
             <th>USUARIO ORIGEN</th>
             <th>USUARIO DESTINO</th>
             <th>ASUNTO</th>
             <th>TEXTO</th>
                
        </tr>
    </thead>
       <tbody>
        <?php  
         

            $read = new json_file_decode();
            $datos_array_docente = $read->json("../../../../elementos/datos/notificaciones/usuario/datos.json");


            $cadena = implode($datos_array_docente[0]);
            
            if ($cadena!='') {
                foreach ($datos_array_docente as $datos_array_docente_1) {
                    echo '<tr>';
                    
                        echo '<td>'.$datos_array_docente_1[0].'</td>';
                        echo '<td>'.$datos_array_docente_1[1].'</td>';
                        echo '<td>'.$datos_array_docente_1[3].'</td>';
                        echo '<td>'.$datos_array_docente_1[5].'</td>';
                        echo '<td>'.$datos_array_docente_1[6].'</td>';
                   
                    echo '</tr>';
                }
            }


           

        ?>
  
    </tbody>     
    <tfoot>
        <tr>
          
             <th>N°</th>
             <th>USUARIO ORIGEN</th>
             <th>USUARIO DESTINO</th>
             <th>ASUNTO</th>
             <th>TEXTO</th>
                
            
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


   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


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




function notificado(){


    if (preguntar==1) {

        notificado_dos();

    }else{

        toastr.warning('No selecciono ninguno');

    }

}


function notificado_dos(){


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


    id_notificaciones=dataFila[0];
    persona_destino=dataFila[2];
 
        $.ajax({
            url: "modulos/anuncios/notificaciones_final/elementos/seccion_notificado.php",
            type: "POST",
            data: {id_notificaciones:id_notificaciones, persona_destino:persona_destino},
            success: function(r){
            
                if (r==1) {
                    
                    $('#contenidoAyuda').html(''); 
                       $('#contenidoCursos').html('');
                    $('#tablaInstitucional').html('');
                    
                    $('#buscarTablaInstitucional').html('');
                    $('#tablaInstitucional').load('modulos/anuncios/notificaciones_final/verificacion.php');

                    
                }else{
                    console.log(r);
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
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


    id_notificaciones=dataFila[0];
    opcion=2;
 
        $.ajax({
            url: "modulos/anuncios/notificaciones_final/elementos/seccion.php",
            type: "POST",
            data: {id_notificaciones:id_notificaciones, opcion:opcion},
            success: function(r){
            
                if (r==1) {
                    
                    $('#contenidoAyuda').html(''); 
                       $('#contenidoCursos').html('');
                    $('#tablaInstitucional').html('');
                    
                    $('#buscarTablaInstitucional').html('');
                    $('#tablaInstitucional').load('modulos/anuncios/notificaciones_final/nueva_notificaciones.php');

                    
                }else{
                     toastr.error('Problema con el servidor');
                     console.log(r);
                    $.unblockUI(); 
                }
               
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
   

     id_notificaciones=dataFila[0];

    
        $.ajax({
            url: "modulos/anuncios/notificaciones_final/elementos/eliminar_crud_notificacion.php",
            type: "POST",
            data: {id_notificaciones:id_notificaciones},
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


    id_notificaciones=0;
    opcion=1;
 
        $.ajax({
            url: "modulos/anuncios/notificaciones_final/elementos/seccion.php",
            type: "POST",
            data: {id_notificaciones:id_notificaciones, opcion:opcion},
            success: function(r){
            
                if (r==1) {
                    
                    $('#contenidoAyuda').html(''); 
                       $('#contenidoCursos').html('');
                    $('#tablaInstitucional').html('');
                    
                    $('#buscarTablaInstitucional').html('');
                    $('#tablaInstitucional').load('modulos/anuncios/notificaciones_final/nueva_notificaciones.php');

                    
                }else{
                     toastr.error('Problema con el servidor');
                     console.log(r);
                    $.unblockUI(); 
                }
               
            }
        });




}




<?php } ?>


 

</script>



