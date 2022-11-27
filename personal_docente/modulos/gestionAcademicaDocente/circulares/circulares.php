 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


 
$consulta = "SELECT `id_circular`, `numero`, `url`, `type` FROM `circular`";
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
                <h3 class="card-title">CIRCULARES</h3>

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
                  

      
<button class="btn btn-danger" title="VISUALIZAR" onclick="descargar_2()"><i class="fas fa-cog fa-spin"></i>VISUALIZAR</button>

                <hr>



   <table id="tabla_circulares" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>N°-ID</th>
            <th>N° Disposición</th>
          
                
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>

            <td><?php echo $dat['id_circular'] ?></td>
            <td>

                <?php 

                    $tip='alt';

                    if ($dat['type']=='pdf') {
                        $tip='pdf';   
                    }else if ($dat['type']=='docx') {
                        $tip='word';   
                    }else if (($dat['type']=='jpg') || ($dat['type']=='jpeg') || ($dat['type']=='png')) {
                        $tip='image';   
                    }


                ?>
                <i class="fas fa-file-<?php echo $tip; ?>"></i>

                <a download="<?php echo $dat['numero'] ?>" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistema/elementos/circulares/<?php echo $dat['url'] ?>"> <?php echo $dat['numero'] ?></a></td>



        
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
            <th>N°-ID</th>
            <th>N° Disposición</th>
            
                
            
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





<div class="modal fade" id="modalPdf" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ver archivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                          
            <div class="modal-body">
                
                <iframe id="iframePDF" frameborder="0" scrolling="si" width="100%" height="400px"
                allowfullscreen></iframe>


               

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
               
            </div>
     
    </div>
  </div>
</div>

<script type="text/javascript">
 $('#imagenProceso').hide();
$.unblockUI();


    var myTable = $('#tabla_circulares').DataTable({
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




var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_circulares tbody').on('click', 'tr', function () {

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




 function remover () {
 
    $('#tablaInstitucionalFinal').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  

}



function descargar_2(){


    if (preguntar==1) {

  
        visualizar_modal();


   


    }else{

        toastr.warning('No selecciono ninguno');

    }

}
function visualizar_modal(){

    id_circular=dataFila[0];

              $.ajax({
                        url: "modulos/gestionAcademicaDocente/circulares/elementos/circularesLeerVisor.php",
                        type: "POST",
                        dataType: "json",
                        data: {id_circular:id_circular},
                        success: function(data){  
                            console.log(data);
                                  urlf = data[0].url;
                                  type = data[0].type;
                       


                            vari= 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistema/elementos/circulares/'+urlf;

                                if (type=='pdf') {

                                    $(".modal-header").css("background-color", "#4e73df");
                                    $(".modal-header").css("color", "white");  
                                    $("#modalPdf").modal("show");
                                    $('#iframePDF').attr('src',vari);

                                }else{

                                    window.open(vari, '_blank');
                                }

                               



                            
                        }        
                    });



}
 
</script>



