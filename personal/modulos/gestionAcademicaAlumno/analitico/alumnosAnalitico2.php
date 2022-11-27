
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">


                     <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];


if (isset($_SESSION['idAlumnos'])){
$idAlumnos=$_SESSION['idAlumnos'];


$c3onsulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $nombreAlumnos=$d3at['nombreAlumnos'];
            $dniAlumnos=$d3at['dniAlumnos'];
         }




    $c9onsulta = "SELECT datosalumnos.dniAlumnos, datosalumnos.nombreAlumnos, plan_datos.nombre FROM datosalumnos INNER JOIN plan_datos ON plan_datos.idPlan = datosalumnos.idPlanEstudio WHERE datosalumnos.idAlumnos = '$idAlumnos'";
        $r9esultado = $conexion->prepare($c9onsulta);
        $r9esultado->execute();
        $d9ata=$r9esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d9ata as $d9at) {
            $dniAlumnos=$d9at['dniAlumnos'];
            $nombreAlumnos=$d9at['nombreAlumnos'];
            $nombrePlan=$d9at['nombre'];
         }

?>


Analítico de:
                    <div id="datosF411">Modalidad: <?php echo $nombrePlan; ?> </div>
                    <div id="nombreAlumnosF311">Apellido y Nombre del Alumno:<?php echo $nombreAlumnos; ?></div>
                    <div id="dniF311">DNI del Alumno:<?php echo $dniAlumnos; ?></div>

<!--  -->

<input type="text" hidden=""  id="datosF311" value="<?php echo 'Modalidad: '.$nombrePlan. ' -- Apellido y nombre: '.$nombreAlumnos.'; DNI: : '.$dniAlumnos; ?>">

                </h3>

                <div class="card-tools">

                  <button onclick="atras()" type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class='fas fa-reply'></i>                  </button>

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
                  
                    <button id="RegresarAnalirico"  type="button" class="btn btn-success" data-toggle="modal" title="Regresar lista de Alumnos"><i class='fas fa-reply'></i></button>
                
  
                                     <div class="btn-group" role="group">

                                    

                               
                                    <button id="btnGroupDrop1Bu" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-print"></i></button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1Bu">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item modalCRUD_AnaliticoAlumnoFinas" href="javascript:void(0)">Analítico (MODELO VIEJO)</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item modalCRUD_AnaliticoAlumnoFinasNuevo" href="javascript:void(0)">Analítico (NUEVO MODELO)</a></li>
                                    </ul>
                                    <form id="inpudFinal">

                       
                                          <?php if ($operacion=='Lectura y Escritura'){ ?>

                                     <button type="button" class="btn btn-info p-2" data-toggle="modal" title="Datos extras del Analítico" onclick="botonEXTRA('<?php echo $idAlumnos ?>')"><i class='fas fa-file-alt'></i></button>  

                                     <button type="button" class="btn btn-info p-2 carga" data-toggle="modal" title="GUARDAR LOS DATOS EDITADOS DEL ANALITICO" onclick="ingresarNotaBaseDato()"><i class='fas fa-save'></i></button> 


                                     <button type="button" class="btn btn-danger p-2 mensaje" data-toggle="modal" title="GUARDAR LOS DATOS EDITADOS DEL ANALITICO" onclick="mensaje()"><i class='fas fa-save'></i></button>  


                                       <?php } ?>

                                  </div>
                                




                    <h5>Aclaración: Si utiliza el Buscador, solo se guardarán los datos que fueron buscados (se recomienda guardar los datos editados y luego utilizar el buscador)  </h5>
               
                    <div class="table-responsive">  




                   <table id="tablanotas111" class="table table-bordered border-primary table-sm" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>CICLO</th> 
                                <th>ESPACIO CURRICULAR</th>
                                <th >CALIF NUME</th>
                                <th style="width: 50px;">CALIF ESCR</th> 
                                <th>CONDICIÓN</th> 
                                <th>MES</th> 
                                <th>AÑO</th>
                                <th>ESTABLECI.</th> 
                                
                                                    
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $colorFinal='';

                            $contadorColores=0;     
                            $consulta = "SELECT analitico.idAnalitico, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, analitico.nota, analitico.notaEscr,  analitico.fechaMes, analitico.fechaAño,  analitico.condicion,  analitico.establecimiento FROM analitico INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = analitico.idAsig WHERE analitico.idAlumno = '$idAlumnos'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {                                
                    
                                $idAnalitico=$dat['idAnalitico'];
                                $nota=$dat['nota'];
                                $notaEscr=$dat['notaEscr'];

                                $ciclo=$dat['ciclo'];
                                $nombre=$dat['nombre'];

                                $fechaMes=$dat['fechaMes'];
                                 $fechaAño=$dat['fechaAño'];
                                $condicion=$dat['condicion'];
                                 $establecimiento=$dat['establecimiento'];
                            

                               if ($contadorColores<=6) {
                                 $contadorColores++;

                                 if ($contadorColores==1) {
                                     $colorFinal='success';
                                 }else{
                                        if ($contadorColores==2) {
                                            $colorFinal='primary';
                                         }else{
                                                 if ($contadorColores==3) {
                                                    $colorFinal='secondary';
                                                 }else{
                                                    if ($contadorColores==4) {
                                                        $colorFinal='danger';
                                                     }else{
                                                        if ($contadorColores==5) {
                                                            $colorFinal='warning';
                                                         }else{
                                                            $colorFinal='info';
                                                         }
                                                     }
                                                 }
                                         }
                                 }

                             }else{
                                $contadorColores=1;
                                $colorFinal='success';
                             }




                         
                            ?>
                            <tr class="table-<?php echo $colorFinal; ?>">
                              
                                <td><?php echo $idAnalitico ?></td>
                                <td><?php echo $ciclo ?></td>
                                <td><?php echo $nombre ?></td>

                                <td><input type="number" class="form-control bg-dark-x border-0" id="nota_<?php echo $idAnalitico; ?>" value="<?php echo $nota; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaEscr_<?php echo $idAnalitico; ?>" value="<?php echo $notaEscr; ?>" ></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="condicion_<?php echo $idAnalitico; ?>" value="<?php echo $condicion; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="fechaMes_<?php echo $idAnalitico; ?>" value="<?php echo $fechaMes; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="fechaAño_<?php echo $idAnalitico; ?>" value="<?php echo $fechaAño; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="establecimiento_<?php echo $idAnalitico; ?>" value="<?php echo $establecimiento; ?>"></td>


                                
           
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>               
                   </form>
               
              </div>
        





 <script type="text/javascript">


$('.mensaje').hide();



     Swal.fire(
          'IMPORTANTE !!',
          'No se olvide de guardar los datos despues de modificarlos',
          'warning'
        )

    

    var tablanotas = $('#tablanotas111').DataTable({ 

        
    "destroy":true,
     scrollX:        "600px",   
     scrollY:        "400px",
     
        paging:         false,
         fixedColumns: false,
        // fixedColumns:   {
        //     leftColumns: 2//Le indico que deje fijas solo las 2 primeras columnas
        // },




   
     language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "Nothing found - sorry",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "No records available",
      search: "",
      searchPlaceholder: "Buscar",
      loadingRecords: "Cargando...",
      processing: "Procesando....",
      paginate: {
        first: "primero",
        last: "ultimo",
        next: "siguiente",
        previous: "anterior"
      },
      infoFiltered: "(filtered from _MAX_ total records)"
    },
   

  
   
    });


var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinas", function(){


 window.open('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico3.php', '_blank');   

});
$(document).on("click", ".modalCRUD_AnaliticoAlumnoFinasNuevo", function(){


 window.open('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico4.php', '_blank');   

});




    <?php if ($operacion=='Lectura y Escritura'){ ?>



// nuevo



function ingresarNotaBaseDato() {

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




buscador_notas_alumnos=$('#tablanotas111_filter input').val();
   
 if(buscador_notas_alumnos.length==0){

     $('.mensaje').hide();
     $('.carga').show();


 }else{

    $('.mensaje').show();
    $('.carga').hide();
    toastr.error('Se debe borrar el contenido del buscador para poder guardar o enviar los datos');

     Swal.fire('Borre el contenido del Buscador y vuelva a guardar o enviar los datos (CONTROLE SU LA LISTA ANTES DE GUARDAR). Una vez guardado la planilla de notas, deberá  Imprimar la misma (en botón imprimir) verificando que se guardó los datos antes de salir de la lista, sino deberá guardar nuevamente la planilla !! ');

    $.unblockUI();

    return false;

 }


// reasigno Variables
var array_analitico =[];

var array_notas =[];
var array_notasEscr =[];
var array_fechaMes =[];
var array_fechaAño =[];
var array_condicion =[];
var array_establecimiento =[];

tablanotas.rows().data().each(function (value) {
    var analitico= value[0];
     
    nota='';
    notaEscr='';
    fechaMes='';
    fechaAño='';
    condicion='';
    establecimiento='';

    nota = $("#nota_"+analitico).val();
    notaEscr = $("#notaEscr_"+analitico).val();
    fechaMes = $("#fechaMes_"+analitico).val();
    fechaAño = $("#fechaAño_"+analitico).val();
    condicion = $("#condicion_"+analitico).val();
    establecimiento = $("#establecimiento_"+analitico).val();


    array_analitico.push(analitico);

    array_notas.push(nota);
    array_notasEscr.push(notaEscr);
    array_fechaMes.push(fechaMes);
    array_fechaAño.push(fechaAño);
    array_condicion.push(condicion);
    array_establecimiento.push(establecimiento);

});

// console.log(array_analitico);

// console.log(array_notas);
// console.log(array_notasEscr);
// console.log(array_fechaMes);
// console.log(array_fechaAño);
// console.log(array_condicion);
// console.log(array_establecimiento);

       
$.ajax({
type:"post",
data:{array_analitico:array_analitico,array_notas:array_notas,array_notasEscr:array_notasEscr,array_fechaMes:array_fechaMes,array_fechaAño:array_fechaAño,array_condicion:array_condicion,array_establecimiento:array_establecimiento},
url:'modulos/gestionAcademicaAlumno/analitico/elementos/crud_AnaliticoFinal.php',
success:function(r){

    if (r==1) {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Se con exito la carga !!!',
          showConfirmButton: false,
          timer: 1500
        })

        toastr.success('Se con exito la carga !!!');
    }

console.log(r);
toastr.info('Se guardo la información con exito');
}
});



$.unblockUI();


} 









$("#tablanotas111_filter input").keyup(function(){
     //lo que tarda en descargar el input
    setTimeout(function(){
            probar_boton_Final();
    }, 1); 
});

$("#tablanotas111_filter input").click(function(){
    //lo que tarda en descargar el input
    setTimeout(function(){
            probar_boton_Final();
    }, 1);   
});



function probar_boton_Final(){
    
     buscador_notas_alumnos=$('#tablanotas111_filter input').val();
   
     if(buscador_notas_alumnos.length==0){
    
         $('.mensaje').hide();
         $('.carga').show();



     }else{

        $('.mensaje').show();
        $('.carga').hide();

     }

}







// fin



function botonEXTRA(idAlumno) {



  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno,
    url:'modulos/gestionAcademicaAlumno/analitico/elementos/buscarDatosAnalitico.php',
    success:function(res){
      console.log(res);
        
            data = res.split('||');

            Libro = data[0];            
            Folio = data[1];
            egreso = data[2];
            lugar = data[3];
            fecha = data[4];
            obs = data[5];
         

    Swal.fire({
              title: 'Datos del Analítico',
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
                  <label for="egreso" class="col-form-label">FECHA DE EGRESO::</label>
                  <input type="text" class="form-control" id="egreso" value='`+egreso+`'>
              </div>
              <div class="form-group">
                  <label for="lugar" class="col-form-label">LUGAR:</label>
                  <input type="text" class="form-control" id="lugar" value='`+lugar+`'>
              </div>
              <div class="form-group">
                  <label for="fecha" class="col-form-label">FECHA:</label>
                  <input type="text" class="form-control" id="fecha" value='`+fecha+`'>
              </div>
              <div class="form-group">
                  <label for="obs" class="col-form-label">OBSERVACIONES: Ingresó con:</label>
                  <input type="text" class="form-control" id="obs" value='`+obs+`'>
              </div>
            
            </div>`, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  Libro = document.getElementById('Libro').value,
                  Folio = document.getElementById('Folio').value,
                  egreso = document.getElementById('egreso').value,
                  lugar = document.getElementById('lugar').value,
                   fecha = document.getElementById('fecha').value,
                   obs = document.getElementById('obs').value,
                
                 ingresarDatosAnalitico(idAlumno,Libro,Folio,egreso,lugar,fecha,obs);
                                  
                }
        });



    }
  });


  
          
}

function ingresarDatosAnalitico(idAlumno,Libro,Folio,egreso,lugar,fecha,obs) {
  
  $.ajax({
    type:"post",
    data:'idAlumno=' + idAlumno +'&Libro=' + Libro +'&Folio=' + Folio +'&egreso=' + egreso +'&lugar=' + lugar +'&fecha=' + fecha +'&obs=' + obs,
    url:'modulos/gestionAcademicaAlumno/analitico/elementos/ingresarDatosAnalitico.php',
    success:function(r){

      Swal.fire(
            'Muy bien !!',
            'Operación exitosa',
            'success'
          )

    }
  });

}


    <?php } ?>

function atras(){

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
        $('#contenidoAyuda').html(''); 
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico1.php');  
}


function remover(){


        
       $("#planillaDocente").removeClass("nav-link active");
      $("#planillaDocente").addClass("nav-link");

      $("#ciclo").removeClass("nav-link active");
      $("#ciclo").addClass("nav-link");

      $("#encabesados").removeClass("nav-link active");
      $("#encabesados").addClass("nav-link");
      $("#informes").removeClass("nav-link active");
      $("#informes").addClass("nav-link");

    

      $("#usuarioOtro").removeClass("nav-link active");
      $("#usuarioOtro").addClass("nav-link");

      $("#posteo").removeClass("nav-link active");
      $("#posteo").addClass("nav-link");


      $("#modeloDos").removeClass("nav-link active");
      $("#modeloDos").addClass("nav-link");

      $("#modeloUno").removeClass("nav-link active");
      $("#modeloUno").addClass("nav-link");


      $("#datosSitio").removeClass("nav-link active");
      $("#datosSitio").addClass("nav-link");

      $("#datos_Institucion").removeClass("nav-link active");
      $("#datos_Institucion").addClass("nav-link");

      $("#datosPlanEstudios").removeClass("nav-link active");
      $("#datosPlanEstudios").addClass("nav-link");


      $("#asignaturas").removeClass("nav-link active");
      $("#asignaturas").addClass("nav-link");

      $("#anuncioAlumnoCantidadEstadistica").removeClass("nav-link active");
      $("#anuncioAlumnoCantidadEstadistica").addClass("nav-link");


      $("#usuariosEstadistica").removeClass("nav-link active");
      $("#usuariosEstadistica").addClass("nav-link");

      $("#cursos").removeClass("nav-link active");
      $("#cursos").addClass("nav-link");

      $("#cargaAlumno").removeClass("nav-link active");
      $("#cargaAlumno").addClass("nav-link");

      $("#cargaAlumnoPre").removeClass("nav-link active");
      $("#cargaAlumnoPre").addClass("nav-link");

$("#habilitarDocente").removeClass("nav-link active");
      $("#habilitarDocente").addClass("nav-link");


      $("#cargaDocente").removeClass("nav-link active");
      $("#cargaDocente").addClass("nav-link");

      $("#inscripNota").removeClass("nav-link active");
      $("#inscripNota").addClass("nav-link");

      $("#libretaDigital").removeClass("nav-link active");
      $("#libretaDigital").addClass("nav-link");

      $("#planillaCentralizadora").removeClass("nav-link active");
      $("#planillaCentralizadora").addClass("nav-link");

      $("#analiticos").removeClass("nav-link active");
      $("#analiticos").addClass("nav-link");

      $("#asistenciaAlumno").removeClass("nav-link active");
      $("#asistenciaAlumno").addClass("nav-link");

      $("#actas").removeClass("nav-link active");
      $("#actas").addClass("nav-link");

    

     
      $("#circularProfe").removeClass("nav-link active");
      $("#circularProfe").addClass("nav-link");

    

      $("#novedades").removeClass("nav-link active");
      $("#novedades").addClass("nav-link");

      $("#directivoDatos").removeClass("nav-link active");
      $("#directivoDatos").addClass("nav-link");

      $("#historia").removeClass("nav-link active");
      $("#historia").addClass("nav-link");

      $("#anuncioAlumno").removeClass("nav-link active");
      $("#anuncioAlumno").addClass("nav-link");

      $("#anuncioProfe").removeClass("nav-link active");
      $("#anuncioProfe").addClass("nav-link");

      $("#estadisticaApro").removeClass("nav-link active");
      $("#estadisticaApro").addClass("nav-link");

      $("#planillaNotas").removeClass("nav-link active");
      $("#planillaNotas").addClass("nav-link");

      


     
         $("#generarPedidoAdmin").removeClass("nav-link active");
      $("#generarPedidoAdmin").addClass("nav-link");

          $("#generarPedido").removeClass("nav-link active");
      $("#generarPedido").addClass("nav-link");

           $("#correos").removeClass("nav-link active");
      $("#correos").addClass("nav-link");

           $("#correosSER").removeClass("nav-link active");
      $("#correosSER").addClass("nav-link");


            $("#notificacion").removeClass("nav-link active");
      $("#notificacion").addClass("nav-link");

     $("#ingresoSistema").removeClass("nav-link active");
      $("#ingresoSistema").addClass("nav-link");


        $("#collapseOne").collapse('show');
  
 
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html(''); 

}   



function mensaje(){
    
         toastr.error('Se debe borrar el contenido del buscador para poder guardar o enviar los datos');
          Swal.fire('Borre el contenido del Buscador y vuelva a guardar o enviar los datos (CONTROLE SU LA LISTA ANTES DE GUARDAR). Una vez guardado la planilla de notas, deberá  Imprimar la misma (en botón imprimir) verificando que se guardó los datos antes de salir de la lista, sino deberá guardar nuevamente la planilla !! ');
     
}
 $.unblockUI();
</script>




<?php  } ?>






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



 

             
             
 
