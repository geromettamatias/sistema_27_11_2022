
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
                  
       <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET') || ($_SESSION['cargo'] == 'REGENTE')){  ?>  

                <button class="btn btn-info" title="NUEVA CIRCULAR" onclick="Agregar()"><i class='fas fa-user-plus'></i>NUEVA CIRCULAR</button>

<button class="btn btn-danger" title="ELIMINAR" onclick="elimniar()"><i class="fas fa-cog fa-spin"></i>ELIMINAR</button>


<hr>
<?php    }  ?> 
      
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


    <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET') || ($_SESSION['cargo'] == 'REGENTE')){  ?>  



<div class="modal fade" id="modale_circular" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                
                <div class="form-group">
                <label for="circular" class="col-form-label">Circular:</label>
                <input type="text" class="form-control" id="circular">
                </div>

                <div class="form-group">
                <div id="container-input">
                    <div class="wrap-file">
                        <div class="content-icon-camera">
                            <input class="btn btn-success" type="file" id="file" name="file[]" onchange="validateFileType()" />
                            <div class="icon-camera"></div>
                        </div>
                        <div id="preview-images"></div>
                    </div>
            
           
                </div>
                
                </div>       
           

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button  class="btn btn-dark" onclick="publicar()"> <i class='fas fa-save'></i> GUARDAR CIRCULAR</button>
           
            </div>
     
    </div>
  </div>
</div>

<?php } ?>




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

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


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


         <?php    if (($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'VICE-DIR') || ($_SESSION['cargo'] == 'SECRET') || ($_SESSION['cargo'] == 'REGENTE')){  ?> 


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


function elimniar(){


    if (preguntar==1) {

        Swal.fire({
                  title: 'Eliminar?',
                  text: "Esta seguro de Eliminar esta Circular, no se podra recuperar más!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Eliminar definitivamente!'
                }).then((result) => {
                  if (result.isConfirmed) {
                     eliminar_FINAL();
                  }
                })      
      

    }else{

        toastr.warning('No selecciono ninguno');

    }

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
   

     
         id_circular=dataFila[0];
         myTable.rows('.selected').remove().draw();
        $.ajax({
            url: "modulos/gestionAcademicaDocente/circulares/elementos/circularesEliminar.php",
            type: "POST",
            data: {id_circular:id_circular},
            success: function(r){
            
                
                    
                    toastr.info('Excelente !!');
                    $.unblockUI(); 
                
               
            }
        });

        
     

}

function Agregar () {

   
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Circular"); 
    $("#modale_circular").modal("show"); 



}


    var formData = new FormData();

    var cantidadArchivos=0;


function validateFileType(){
        var fileName = document.getElementById("file").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png" || extFile=="docx" || extFile=="csv" || extFile=="pdf"){
           subir();

           toastr.info('Formato del documento aceptado');

        }else{

             clearFormDataAndThumbnails();
            toastr.error('NO aceptado el Formato del documento');
            
        }   
    }

    function subir(){

         

        for ( var i = 0; i < file.files.length; i++ ) {
            var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();

            nombreArchivo=file.files[i].name;
            createThumbnail(file, i, thumbnail_id,nombreArchivo);
            formData.append(thumbnail_id, file.files[i]);
            cantidadArchivos=1;
        }

        
   

    }
 
   


  
 var createThumbnail = function (file, iterator, thumbnail_id,nombreArchivo) {
        var thumbnail = document.createElement('div');


        thumbnail.classList.add('thumbnail', thumbnail_id);
        thumbnail.dataset.id = thumbnail_id;

        // thumbnail.setAttribute('style', `background-image: url(${ URL.createObjectURL( file.files[iterator] ) })`);   imagen
        
     document.getElementById('preview-images').appendChild(thumbnail);
        createCloseButton(thumbnail_id,nombreArchivo);
    }

    var createCloseButton = function (thumbnail_id,nombreArchivo) {
        var closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerText = '*) ELIMINAR: '+nombreArchivo;
        document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
    }

    var clearFormDataAndThumbnails = function () {

        $('#circular').val('');
        for ( var key of formData.keys() ) {
            formData.delete(key);
            cantidadArchivos=0;
        }

        cantidadArchivos=0;

        document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
            thumbnail.remove();
        });
    }

    document.body.addEventListener('click', function (e) {
        if ( e.target.classList.contains('close-button') ) {
            e.target.parentNode.remove();
            formData.delete(e.target.parentNode.dataset.id);
            cantidadArchivos=0;
        }
    });


    function publicar(publicar){

     
          circular=$('#circular').val();

    if (circular=='') {
            toastr.error('En el campo descripción de circular, esta vacío');
            return false;
          }


if (cantidadArchivos==0) {
            toastr.error('No hay archivo seleccionado');
            return false;
          }


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
    



           $("#modale_circular").modal("hide");


           
            formData.append('circular', circular);

                    $.ajax({
                
               url:'modulos/gestionAcademicaDocente/circulares/elementos/circulares.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                dataType: "json",
                success: function(respuesta){
                   
                        id_circular = respuesta[0].id_circular;            
                        numero = respuesta[0].numero;
                        url = respuesta[0].url;
                        type = respuesta[0].type;


                         tip='alt';

                            if (type=='pdf') {
                                tip='pdf';   
                            }else if (type=='docx') {
                                tip='word';   
                            }else if ((type=='jpg') || (type=='jpeg') || (type=='png')) {
                                tip='image';   
                            }

                

                        numero_final=`<i class="fas fa-file-`+tip+`"></i> <a download="`+numero+`" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistema/elementos/circulares/`+url+`"> `+numero+`</a>`;

                      
                    if (id_circular) {

                        toastr.success('¡Operación exitosa!');
                        toastr.info('¡Petición exitosa!');

                         myTable.row.add([id_circular,numero_final]).draw();
                       

                    }else{

                      
                        toastr.error('error de Servidor');
                      

                    }


                       
                    clearFormDataAndThumbnails();

                       

                        $.unblockUI();
                 },




});  
    }







<?php } ?>


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



