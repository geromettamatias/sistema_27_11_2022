
<?php
  
        session_start();

$operacion=$_SESSION["operacion"];



?>



  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Carga de Alumno mediante Excel (Formato CSV DELIMITADO POR COMAS)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">


  <?php if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ ?>


<h2>Para poder realizar la carga de los Alumno mediante Excel deberá <font color="#ff0000">respetar ciertas pautas.</font></h2>

<ol><li>Descargue el <a download="alumno" href="modulos/cargaDatos/datosAlumno/alumno.csv">MODELO EXCEL FORMATO (CSV DELIMITADO POR COMAS)</a> en donde visualizara todo los datos que deberá completar y luego guarde con el mismo formato…
</li><li>El formato del Excel debe ser <a href="https://intercom.help/Colppy/es/articles/4519664-formato-csv-delimitado-por-comas-formato-archivo-modelo-para-importar" target="_blank">(CSV DELIMITADO POR COMAS)</a>&nbsp;</li><li>La primera fila son los encabezados donde te dirán en qué lugar va cada información del alumno.
</li><li><font color="#ff0000"><b>NO</b></font> <font color="#ff0000" style="">elimine columna, respete el orden de cada columna. </font></li><li>Cada Celda, <font color="#ff0000"><b>NO debe estar vacío.
</b></font></li><li>Respete el tipo de dato que se le pide Ejemplo:</li></ol><p><br></p><table class="table table-bordered"><tbody><tr><td><span style="text-align: right;">Teléfono:&nbsp;</span><br></td><td><span style="text-align: right;">3624-15-003454 (los números con el guion medio).</span><br></td></tr><tr><td><span style="text-align: right;">DNI:&nbsp;</span><br></td><td><span style="text-align: right;">32451268 (solo números, no más de 8 dígitos).</span><br></td></tr><tr><td><span style="text-align: right;">CUIL:</span><br></td><td><span style="text-align: right;">27-32451268-5 (números más los guiones medio).</span><br></td></tr><tr><td><span style="text-align: right;">Fecha de Nacimiento:</span><br></td><td><span style="text-align: right;">05-12-2012 (Día-mes-año Separado por guiones)</span><br></td></tr><tr><td><span style="text-align: right;">Estado:</span><br></td><td><span style="text-align: right;">Tendrá dos opciones ACTIVO, DESACTIVO</span><br></td></tr><tr><td><span style="text-align: right;">Contraseña:</span><br></td><td><span style="text-align: right;">es la contraseña que utilizara el alumno para ingresar al sistema</span><br></td></tr></tbody></table>
  

<h5>Carga Por Planilla <a download="alumno" href="modulos/cargaDatos/datosAlumno/alumno.csv">MODELO EXCEL FORMATO (CSV DELIMITADO POR COMAS)</a></h5>
  <div id="container-input">
            <div class="wrap-file">


              
                <div class="content-icon-camera">


                    <input class="btn btn-success" type="file" id="file" name="file[]" accept=".csv" />
                    <div class="icon-camera"></div>
                </div>
                <div id="preview-images">
                    
                </div>
            </div>
            
           
        </div>


        <button type="submit" class="btn btn-dark" onclick="publicar()"> <i class='fas fa-save'></i> SUBIR ARCHIVO</button>
<hr><br>




<?php }else{ ?>


    <h2>Usted NO tiene los Permisos para poder Realizar la carga mediante Excel, comuníquese con el Administrador !!</h2>


<?php } ?>

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



<div class="modal fade bd-example-modal-xl" id="modal_informe" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <div id="informe_carga"></div>
            </div>


  
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
     
    </div>
  </div>
</div>

</div>


   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();


<?php if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ ?>


    var formData = new FormData();

    var cantidadArchivos=0;

   file.addEventListener('change', function (e) {

        for ( var i = 0; i < file.files.length; i++ ) {
            var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();

            nombreArchivo=file.files[i].name;
            createThumbnail(file, i, thumbnail_id,nombreArchivo);
            formData.append(thumbnail_id, file.files[i]);
            cantidadArchivos=1;
        }

        

        e.target.value = '';

    });


  
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






    function publicar(){

     
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
    


                    $.ajax({
                
               url:'modulos/cargaDatos/datosAlumno/elementos/registrar.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                
                success: function(respuesta){

                    $("#informe_carga").html(respuesta); 
                    $(".modal-header").css("background-color", "#FF3374");
                    $(".modal-header").css("color", "white");
                    $(".modal-title").text("Informe sobre la carge en Excel");            
                    $("#modal_informe").modal("show"); 
                    
            
                    toastr.success('Proceso Finalizado');



                       
                    clearFormDataAndThumbnails();

                       

                        $.unblockUI();
                 },




});  
    }




 <?php } ?>










</script>



