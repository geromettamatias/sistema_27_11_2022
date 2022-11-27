
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if ((isset($_SESSION['cursoSe']))){
$cursoSe=$_SESSION['cursoSe'];

  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

}

if ($cursoSe!='0'){


}
$consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `inscrip_curso_alumno_$cicloLectivo`.`idCurso`, `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
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
                <h3 class="card-title">LISTA DE ALUMNOS DEL CURSO</h3>

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
                  


                <button class="btn btn-outline-dark" title="LIBRETA/FICHA/INFORME" onclick="asistencia()"><i class="fas fa-cog fa-spin"></i> ASISTENCIA</button>

                <button class="btn btn-outline-primary" title="LIBRETA/FICHA/INFORME" onclick="informacion()"><i class="fas fa-cog fa-spin"></i>LIBRETA/FICHA/INFORME/ASIGNATURAS PENDIENTES-EQUIVALENTE</button>


                <?php    if ((($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR')) && ($_SESSION['operacion'] == 'Lectura y Escritura')){  ?>

                <button class="btn btn-outline-warning" title="DATOS FICHA" onclick="datos()"><i class="fas fa-cog fa-spin"></i>DATOS</button>

                <?php    }  ?>


<hr>

 <div class="table-responsive">  

    <table id="tabla_correoSer" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N° Inscp</th>
             <th>DNI</th>
             <th>APELLIDO Y NOMBRE</th>
                         
        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {


        ?>
        <tr>

        <td><?php echo $dat['idIns'] ?></td>
        <td><?php echo $dat['dniAlumnos'] ?></td>
        <td><?php echo $dat['nombreAlumnos'] ?></td>
 
          
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N° Inscp</th>
             <th>DNI</th>
             <th>APELLIDO Y NOMBRE</th>
             
                
            
        </tr>
    </tfoot>
</table>
</div>





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

//  DATOS

 <?php    if ((($_SESSION['cargo'] == 'Administrador') || ($_SESSION['cargo'] == 'AUXILIAR')) && ($_SESSION['operacion'] == 'Lectura y Escritura')){  ?>

function datos(){


    if (preguntar==1) {

  Swal.fire({
          title: '¿QUÉ DATOS DESEA MODIFICAR',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'LIBRETA',
          denyButtonText: `FICHA`,
        }).then((result) => {
          
          if (result.isConfirmed) {

                botonDatosLibreta();


          } else if (result.isDenied) {

                botonDatosFicha();
          }
        })


    }else{

        toastr.warning('No selecciono ninguno');

    }

}







function botonDatosLibreta() {


idIns=dataFila[0];

  $.ajax({
    type:"post",
    data:'idIns=' + idIns,
    url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/buscarDatosLibreta.php',
    success:function(res){

            console.log(res);

            data = res.split('||');

            promovido1 = data[0];            
            ob1 = data[1];
            lugarFecha1 = data[2];
     

    Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:`<div class="col-12">
              <div class="form-group">
                  <label for="promovido" class="col-form-label">Promovido a:</label>
                  <input type="text" class="form-control" id="promovido" value='`+promovido1+`'>
              </div>
              <div class="form-group">
                  <label for="ob" class="col-form-label">OBSERVACIONES:</label>
                  <input type="text" class="form-control" id="ob" value='`+ob1+`'>
              </div>
              <div class="form-group">
                  <label for="lugarFecha" class="col-form-label">Lugar y Fecha:</label>
                  <input type="text" class="form-control" id="lugarFecha" value='`+lugarFecha1+`'>
              </div>
             
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  promovido = document.getElementById('promovido').value,
                  ob = document.getElementById('ob').value,
                  lugarFecha = document.getElementById('lugarFecha').value,
                
                 
                 ingresarDatosLibreta(idIns,promovido,ob,lugarFecha);
                                  
                }
        });



    }
  });


  
          
}




function ingresarDatosLibreta(idIns,promovido,ob,lugarFecha) {
  


  $.ajax({
    type:"post",
    data:'idIns=' + idIns +'&promovido=' + promovido +'&ob=' + ob +'&lugarFecha=' + lugarFecha,
    url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/ingresarDatosLibretaAlumno.php',
    success:function(r){
  
         Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Se edito los datos correctamente !!!',
          showConfirmButton: false,
          timer: 1500
        })

        toastr.success('Se edito los datos correctamente !!!');

    }
  });

}















function botonDatosFicha() {

    idIns=dataFila[0];
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
        data:'idIns=' + idIns,
        url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/buscarDatosFicha.php',
        success:function(res){

              alert(res);
            data = res.split('||');

            Libro = data[0];            
            Folio = data[1];
           
            auxiliar = data[2];
            piePagina = data[3];
    


        Swal.fire({
              title: 'Datos para la Ficha del Alumno',
              html:`<div class="col-12">
                <div class="form-group">
                    <label for="Libro" class="col-form-label">Libro:</label>
                    <input type="text" class="form-control" id="Libro" value='`+Libro+`'>
                </div>
                <div class="form-group">
                    <label for="Folio" class="col-form-label">Folio:</label>
                    <input type="text" class="form-control" id="Folio" value='`+Folio+`'>
                </div>
                
                <div class="form-group">
                    <label for="auxiliar" class="col-form-label">Auxiliar Docente:</label>
                    <input type="text" class="form-control" id="auxiliar" value='`+auxiliar+`'>
                </div>
              <div class="form-group">
                  <label for="piePagina" class="col-form-label">Observaciones(Pie de Pagina):</label>
                 
                  <textarea class="form-control" id="piePagina" rows="5">`+piePagina+`</textarea>
              </div>
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  Libro = document.getElementById('Libro').value,
                  Folio = document.getElementById('Folio').value,
                  auxiliar = document.getElementById('auxiliar').value,
                  piePagina = document.getElementById('piePagina').value,
                 
                 ingresarDatosFicha(idIns,Libro,Folio,auxiliar,piePagina);
                                  
                }
        });


               $.unblockUI();
        }
    });


    
          
}




function ingresarDatosFicha(idIns,Libro,Folio,auxiliar,piePagina) {
    
    $.ajax({
        type:"post",
        data:'idIns=' + idIns +'&Libro=' + Libro +'&Folio=' + Folio +'&auxiliar=' + auxiliar +'&piePagina=' + piePagina,
        url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/ingresarDatosFichaAlumno.php',
        success:function(r){

             Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Se edito los datos correctamente !!!',
          showConfirmButton: false,
          timer: 1500
        })

        toastr.success('Se edito los datos correctamente !!!');

        }
    });

}






<?php } ?>


// FIN

//  lIBRETA ASIGNATUAS


function asistencia(){


    if (preguntar==1) {


                asistencia_final();



    }else{

        toastr.warning('No selecciono ninguno');

    }

}




function informacion(){


    if (preguntar==1) {

  Swal.fire({
          title: '¿QUÉ APARTADO DESEA INGRESAR DEL ALUMNO?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'LIBRETA/FICHA/INFORME',
          denyButtonText: `ASIGNATURA PENDI./EQUI.`,
        }).then((result) => {
          
          if (result.isConfirmed) {

                libreta_informe_ficha();


          } else if (result.isDenied) {

                asignatura_equivalente_pendiente();
          }
        })


    }else{

        toastr.warning('No selecciono ninguno');

    }

}


// lIBRETA
// FIN lIBRETA

function libreta_informe_ficha(idIns) {

    idIns=dataFila[0];

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
                  data:'idIns=' + idIns,
                  url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionLibretaDigital.php',
                  success:function(r){
                    

                             $('#contenidoAyuda').load('modulos/gestionAcademicaAlumno/libretaFicha/LibretaDigital.php');

                    
                    
                  }
                });



    
          
}




function asistencia_final(){

     idIns=dataFila[0]; 

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
              data:'idIns=' + idIns,
              url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/session_asistencia_alumno.php', 
              success:function(r){
                

                
                     $('#contenidoAyuda').load('modulos/gestionAcademicaAlumno/libretaFicha/asistencia_alumno.php');

                
                
              }
            });




}


function asignatura_equivalente_pendiente(){

     idIns=dataFila[0]; 

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
              data:'idIns=' + idIns,
              url:'modulos/gestionAcademicaAlumno/libretaFicha/elementos/seccionPendienteApro.php', 
              success:function(r){
                

                
                     $('#contenidoAyuda').load('modulos/gestionAcademicaAlumno/libretaFicha/asignaturasPendientes.php');

                
                
              }
            });




}

// FIN









function remover () {

    
    $('#cursoSe').val(0);

    $('#contenidoAyuda').html('');


}

 

</script>



