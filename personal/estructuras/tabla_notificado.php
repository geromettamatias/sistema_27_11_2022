 <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Notificaciones</h3>

         

            <div class="card-tools">

             
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
            <div class="row">
                  
                  <div class="col-md-12">
                    

                     <table id="tabla_verificacion_fi" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>REFERENCIA</th>
             <th>MENSAJE</th>
             <th>SITUACIÓN</th>
                        
        </tr>
    </thead>
     <tbody>



 <?php

session_start();

$idUsuario=$_SESSION["idUsuario"];


$cantidad_notificacion=0;
$referencia='';

require 'bd/libreria-php-json/json-file-decode.class.php';


$read = new json_file_decode();
$datos_array_docente = $read->json("../../elementos/datos/notificaciones/usuario/datos.json");


$cadena = implode($datos_array_docente[0]);

if ($cadena!='') {
    foreach ($datos_array_docente as $datos_array_docente_1) {

            $id_mensaje=$datos_array_docente_1[0];
           
            $usuario_destino=$datos_array_docente_1[3];
            
            $id_usuario_destino=$datos_array_docente_1[4];
            $id_usuario_destino_1 = explode(",", $id_usuario_destino);
            $pregunta_destino=0;

            $id_usuario_destino_verificacion=$datos_array_docente_1[7];
            $id_usuario_destino_verificacion_1 = explode(",", $id_usuario_destino_verificacion);
            $pregunta_destino_verificacion=0;

            if ($usuario_destino=='Personales') {
             

                  foreach ($id_usuario_destino_1 as $id_usuario_dest) {
                      if ($id_usuario_dest==$idUsuario) {
                         $pregunta_destino=1;
                      } 
                  }


               
                     foreach ($id_usuario_destino_verificacion_1 as $id_usuario_destino_verifi) {
                        if ($id_usuario_destino_verifi==$idUsuario) {
                           $pregunta_destino_verificacion=1;
                        } 
                      }
                

                  

                  if (($pregunta_destino==1)&&($pregunta_destino_verificacion==0)) {

                    
                    $referencia.='<tr class="table-danger">
                                        <td>'.$datos_array_docente_1[5].'</td>
                                        <td>'.$datos_array_docente_1[6].'</td>
                                        <td><font color="red">NO CONFIRMADO</font></td>
                                  </tr>';
                    $cantidad_notificacion++;
                  }else if (($pregunta_destino==1)&&($pregunta_destino_verificacion==1)) {

                    
                    $referencia.='<tr class="table-info">
                                        <td>'.$datos_array_docente_1[5].'</td>
                                        <td>'.$datos_array_docente_1[6].'</td>
                                        <td><font color="blue">CONFIRMADO</font></td>
                                  </tr>';
                    $cantidad_notificacion++;
                  }


            }
 

    }
}

            echo $referencia;

  ?>



    </tbody>        
    <tfoot>
        <tr>   
             <th>REFERENCIA</th>
             <th>MENSAJE</th>
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


    var myTable = $('#tabla_verificacion_fi').DataTable({
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






</script>




