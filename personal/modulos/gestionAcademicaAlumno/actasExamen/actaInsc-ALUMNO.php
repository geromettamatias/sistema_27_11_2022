





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

    $cicloF=$_SESSION['cicloLectivo'];

    $cicloFF = explode("||", $cicloF);
    $cicloLectivo= $cicloFF[0]; 
    $edicion= $cicloFF[1]; 



    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
    
           $consulta = "SELECT `actas_examen_datos_$cicloLectivo`.`idActa`,`actas_examen_datos_$cicloLectivo`.`tipo`, `plan_datos_asignaturas`.`ciclo`, `plan_datos_asignaturas`.`idAsig` ,`plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `plan_datos_asignaturas`.`idPlan`, `actas_examen_datos_$cicloLectivo`.`precentacion`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `actas_examen_datos_$cicloLectivo`.`idActa` = '$idActa_inscriAlumno'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);



                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $tipo=$d1at['tipo'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];
                            $idAsig=$d1at['idAsig'];
                            $titulo=$d1at['titulo'];
                          

                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                }

                
                $_SESSION['idAsig_titulo']=$idAsig;
                $_SESSION['tipo_titulo']=$tipo;
                $_SESSION['idPlan_titulo']=$idPlan;
                $_SESSION['ciclo_titulo']=$ciclo;
                $_SESSION['nombreAsignatura_titulo']=$nombreAsignatura;
                $_SESSION['titulo_titulo']=$titulo;



?>






                 <?php echo $tipo.'<br>TIPO: '.$idPlan.'--CICLO: '.$ciclo.'--ASIGNATURA: '.$nombreAsignatura.'<br>Equipo Pedagógico: '.$titulo; ?>
              



                </h3>

                <div class="card-tools">

                    <button onclick="regresar_mesas_dos()" type="button" class="btn btn-tool"  title="Regresar lista de Alumno del curso">
                    <i class='fas fa-reply-all'></i>
                  </button>

                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover6()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                    <!--  -->








                
                <button id="btn_regresar" type="button" class="btn btn-warning" data-toggle="modal"  title="Regresar"><i class='fas fa-reply-all'></i></button>

             
                <?php if ($operacion=='Lectura y Escritura'){ ?>

                <button onclick="listaFi()" type="button" class="btn btn-danger" data-toggle="modal" title="Lista Alumnos que adeuda"><i class='fas fa-user-plus'></i></button>

            
                <button id="btnNuevo_InscripAl" type="button" class="btn btn-info" data-toggle="modal" title="INSCRIBIR ALUMNO"><i class='fas fa-user-plus'></i></button>
                

                <button  type="button" class="btn btn-secondary modalCRUD_actaGuardarNota" data-toggle="modal" title="GUARDAR NOTAS EDITADAS"><i class='fas fa-save'></i></button>
                
                <button onclick="mensaje()"  type="button" class="btn btn-danger mensaje" data-toggle="modal" title="GUARDAR NOTAS EDITADAS"><i class='fas fa-save'></i></button>
                

                

                <button onClick="eliminarFinal();" type="button" class="btn btn-danger" data-toggle="modal" title="Eliminar Seleción"><i class='fas fa-trash-alt'></i></button> <input type="checkbox" class="p-4" onClick="ActivarCasilla(this);" value="0" />


                <?php } ?>

                 <hr>

                    <button id='btn_imprimir'  type="button" class="btn btn-success" data-toggle="modal" title="IMPRIMIR PLANILLA"><i class='fas fa-print'></i></button>
                
                <hr>   


                <h5>Aclaración: Si utiliza el Buscador, solo se guardarán los datos que fueron buscados (se recomienda guardar los datos editados y luego utilizar el buscador)  </h5>

                <div class="table-responsive">  


                 <table id="tabla_inscripFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th> 
                                <th>Nota Esc</th> 
                                <th>Nota Oral</th> 
                                <th>Prom Numérico</th>
                                <th>Prom Letra</th>                         
                                <th>SEL</th>
                            </tr>
                        </thead>
                        <tbody>
                       <?php  
                            $colorFinal='';

                            $contadorColores=0;
                           $consulta = "SELECT `acta_examen_inscrip_$cicloLectivo`.`idInscripcion`, `datosalumnos`.`idAlumnos`,`datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `acta_examen_inscrip_$cicloLectivo`.`notaEsc`, `acta_examen_inscrip_$cicloLectivo`.`notaOral`, `acta_examen_inscrip_$cicloLectivo`.`promNumérico`, `acta_examen_inscrip_$cicloLectivo`.`promLetra` FROM `acta_examen_inscrip_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `acta_examen_inscrip_$cicloLectivo`.`idAlumno` WHERE `acta_examen_inscrip_$cicloLectivo`.`idActa` = '$idActa_inscriAlumno'";
                              $resultado = $conexion->prepare($consulta);
                              $resultado->execute();
                              $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                              foreach($data as $dat) { 

                              

                            $idInscripcion=$dat['idInscripcion'];
                            $idAlumnos=$dat['idAlumnos'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];

                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];

                          




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
                           
                         
                            <tr id="<?php echo $idInscripcion ?>" class="table-<?php echo $colorFinal; ?>">
                              
                              
                         
                                <td><?php echo $idInscripcion; ?></td>
                                <td><?php echo $idAlumnos.'||'.$nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                                <td><input type="number" class="form-control bg-dark-x border-0" id="notaEsc_<?php echo $idInscripcion; ?>" value="<?php echo $notaEsc; ?>"></td>

                                <td><input type="number" class="form-control bg-dark-x border-0" id="notaOral_<?php echo $idInscripcion; ?>" value="<?php echo $notaOral; ?>"></td>

                                <td><input type="number" class="form-control bg-dark-x border-0" id="promNumérico_<?php echo $idInscripcion; ?>" value="<?php echo $promNumérico; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="promLetra_<?php echo $idInscripcion; ?>" value="<?php echo $promLetra; ?>"></td>

                                <td><input type='checkbox' class="seleTod" value="<?php echo $idInscripcion ?>" ></input></td>
                            </tr>
                           <?php } ?>                            
                        </tbody>        
                       </table>                    

               
              </div>
      



   <?php if ($operacion=='Lectura y Escritura'){ ?>

         



<div class="modal fade" id="inscripcionAlumnoMesaS" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Inscripción a la Mesa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="formInscrip">    
            <div id="cont" class="modal-body">
           

 
                <div class="form-group">
              
                        <select class="form-select" id="idAlumnos" >
                            <option value="0">Seleccione el Estudiante</option>
                             <?php


                             $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor` FROM `datosalumnos`";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                                    foreach($data as $dat) { 

                                         
                                         $idAlumnos=$dat['idAlumnos'];
                                         $dniAlumnos=$dat['dniAlumnos'];
                                         $nombreAlumnos=$dat['nombreAlumnos'];

                                             ?>
                                            <option value="<?php echo $idAlumnos; ?>"><?php echo $nombreAlumnos.'; DNI: '.$dniAlumnos; ?></option>
                                        <?php } ?>
                        </select>
                
               </div>


            
           
                                    
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
        </form> 
    </div>
  </div>
</div>

     
                 
<div class="modal fade" id="informeCarga_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Informe de Carga</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    
            <div class="modal-body">
           
                    <div id="informeCarga"></div>
                                    
            </div> 
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
             
            </div>
    
    </div>
  </div>
</div>


<?php } ?>


 <script type="text/javascript">




function regresar_mesas_dos () {


    
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
  

function mensaje(){
    
         toastr.error('Se debe borrar el contenido del buscador para poder guardar o enviar los datos');
          Swal.fire('Borre el contenido del Buscador y vuelva a guardar o enviar los datos (CONTROLE SU LA LISTA ANTES DE GUARDAR). Una vez guardado la planilla de notas, deberá  Imprimar la misma (en botón imprimir) verificando que se guardó los datos antes de salir de la lista, sino deberá guardar nuevamente la planilla !! ');
     
}





$(document).ready(function(){



     var tablaAlumno = $('#tablaAlumnoNuevo').DataTable({ 

          
                "destroy":true,  
               
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

                    });








    $("#btn_regresar").click(function(){
        $('#imagenProceso').show();
        $('#tablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
        $('#contenidoAyuda').html(''); 
        
        $('#imagenProceso').hide();


          
         $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actasBuscar.php');
     
        
    });

 
   
    var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable({ 

          
                
"destroy":true,
scrollX:        "800px",   
scrollY:        "600px",

paging:         false,
fixedColumns: false,
// fixedColumns:   {
//     leftColumns: 2//Le indico que deje fijas solo las 2 primeras columnas
// },


  
                
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
                      
                    });







probar_boton_Final_actas();

$("#tabla_inscripFinal_filter input").keyup(function(){
     //lo que tarda en descargar el input
    setTimeout(function(){
            probar_boton_Final_actas();
    }, 1); 
});

$("#tabla_inscripFinal_filter input").click(function(){
    //lo que tarda en descargar el input
    setTimeout(function(){
            probar_boton_Final_actas();
    }, 1);   
});


function probar_boton_Final_actas(){
    
     buscador_notas_alumnos=$('#tabla_inscripFinal_filter input').val();

     
   
     if(buscador_notas_alumnos.length==0){
    
         $('.mensaje').hide();
         $('.modalCRUD_actaGuardarNota').show();



     }else{

        $('.mensaje').show();
        $('.modalCRUD_actaGuardarNota').hide();

     }

}



















<?php if ($operacion=='Lectura y Escritura'){ ?>


$("#btnlistaAlumnos").click(function(){
  
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga");            
    $("#inscripcionAlumnoMesaS").modal("show"); 

    
$('#idAlumnos').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});

});





$("#btnNuevo_InscripAl").click(function(){
  
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga");            
    $("#inscripcionAlumnoMesaS").modal("show"); 

    
$('#idAlumnos').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});

});

<?php } ?>
$("#RegresarLibreta").click(function(){

  $('#imagenProceso').show();

      $('#libreTaOcul').show();

      $('#libretaFina').html('');
                

           
    
 $('#imagenProceso').hide(); 

}); 

<?php if ($operacion=='Lectura y Escritura'){ ?>


$("#formInscrip").submit(function(e){
    e.preventDefault();   

    idAlumnos = $.trim($("#idAlumnos").val());

    if (idAlumnos==0) {

        Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'Debe seleccionar un alumno',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
    }else{
    opcion=1;
    $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos + '&opcion=' + opcion,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_inscrp_Acta_Examen.php',
          success:function(res){
            
            data = res.split('||');

            idInscripcion = data[0];            
            nombreAlumnos = data[1];
            dniAlumnos = data[2];
            notaEsc = data[3];
            notaOral = data[4];
            promNumérico = data[5];
            promLetra = data[6];
            idAlumnos = data[7];

            if (idInscripcion != '0') {

            notaEsc= '<input type="text" class="form-control bg-dark-x border-0" id="notaEsc_'+idInscripcion+'" value="'+notaEsc+'" >';

            notaOral= '<input type="text" class="form-control bg-dark-x border-0" id="notaOral_'+idInscripcion+'" value="'+notaOral+'" >';

            promNumérico= '<input type="text" class="form-control bg-dark-x border-0" id="promNumérico_'+idInscripcion+'" value="'+promNumérico+'" >';

            promLetra= '<input type="text" class="form-control bg-dark-x border-0" id="promLetra_'+idInscripcion+'" value="'+promLetra+'" >';

            boton= '<input type="checkbox" class="seleTod" value="'+idInscripcion+'"></input>';



            var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable();
            tabla_inscripFinal.row.add( [idInscripcion,idAlumnos+'||'+nombreAlumnos,dniAlumnos,notaEsc,notaOral,promNumérico,promLetra,boton]).node().id = idInscripcion;
            tabla_inscripFinal.draw( false );

            celda = document.getElementById(idInscripcion);

    
            celda.style.backgroundColor="#dddddd";

            Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Tu trabajo ha sido guardado',
                      showConfirmButton: false,
                      timer: 600
                    })

          }else{

            Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'El Alumno ya esta inscripto en la mesa',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
          }

          
          }
        });


}
   
    
});  










<?php } ?>




$("#btn_imprimir").click(function(e){
    e.preventDefault();

  contadorAlumno=0;

  comparar=25;

  contador=0;


  tabla_inscripFinal.rows().data().each(function (value) {
    
    contadorAlumno++;

    if (contadorAlumno==comparar) {

      contador++;

    
      comparar=comparar+25;

    }
    
   
     
  });
 

          $.ajax({
                  type:"post",
                  data:'contadorAlumno=' + contadorAlumno + '&contador=' + contador,
                  url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/seccionCantidadImprimirActa.php',
                  success:function(respuesta){

 
             
              }
            });

        
        window.open('modulos/gestionAcademicaAlumno/actasExamen/imprimirActaFinal.php', '_blank'); 

});







<?php if ($operacion=='Lectura y Escritura'){ ?>

var nombresColumnas=[];   

$(document).on("click", ".modalCRUD_actaGuardarNota", function(){


buscador_notas_alumnos=$('#tabla_inscripFinal_filter input').val();
   
 if(buscador_notas_alumnos.length==0){

     $('.mensaje').hide();
     $('.modalCRUD_actaGuardarNota').show();


 }else{

    $('.mensaje').show();
    $('.modalCRUD_actaGuardarNota').hide();
    toastr.error('Se debe borrar el contenido del buscador para poder guardar o enviar los datos');

     Swal.fire('Borre el contenido del Buscador y vuelva a guardar o enviar los datos (CONTROLE SU LA LISTA ANTES DE GUARDAR). Una vez guardado la planilla de notas, deberá  Imprimar la misma (en botón imprimir) verificando que se guardó los datos antes de salir de la lista, sino deberá guardar nuevamente la planilla !! ');

    $.unblockUI();

    return false;

 }












  

Swal.fire({
  title: 'ESTA SEGURO DE EDITAR',
  text: "Una vez editado no se podra recuperar la nota",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
        
        id_inscripcion=[];
        id_alumnos=[];
        notaEsc=[];
        notaOral=[];
        promNumérico=[];
        promLetra=[];
        informe_malo=[];



        tabla_inscripFinal.rows().data().each(function (value) {
            var idInscripcion= value[0];
            var id_alumnos_uno= value[1];

            notaEsc_pre=$("#notaEsc_"+idInscripcion).val();
            notaOral_pre=$("#notaOral_"+idInscripcion).val();
            promNumérico_pre=$("#promNumérico_"+idInscripcion).val();
            promLetra_pre=$("#promLetra_"+idInscripcion).val();

            console.log(promNumérico_pre +' - '+ promLetra_pre);


            if ((promLetra_pre!='') && (promNumérico_pre=='')) {
                promNumérico_pre=1;
            }

                if ((promLetra_pre!='') && (promNumérico_pre!='')) {
                
               
                id_inscripcion.push(idInscripcion);

                id_alumnos_u = id_alumnos_uno.split('||');  
                id_alumnos.push(id_alumnos_u[0]);
               
                notaEsc.push(notaEsc_pre);  
                notaOral.push(notaOral_pre); 
                promNumérico.push(promNumérico_pre);
                promLetra.push(promLetra_pre);

                }else{

                    id_alumnos_u = id_alumnos_uno.split('||');  
                    informe_malo.push(id_alumnos_u[1]);

                }
         

            });
           
            notaActaGuardar(id_inscripcion,id_alumnos,notaEsc,notaOral,promNumérico,promLetra,informe_malo);

            
          

  }
})

});

<?php } ?>

});




function eliminarFinal(){


         Swal.fire({
          title: 'Esta seguro de Desmatricular estos alumno/s del curso?',
          text: "Los alumnos perderan todas las notas de la Libreta digital",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Desmatricular'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Operación éxitosa',
              'success'
            )

          $("#imagenProceso").show();
         
          botonMuchosEliminarFi2();
        }
      })
  

   
       
      


     
}


 function botonMuchosEliminarFi2() {

    tabla_inscripFinal=$('#tabla_inscripFinal').DataTable();
 
        $("input:checkbox:checked").each(function() {

          idInscripcion = $(this).val();
          fila=$(this);
          
     
          if (idInscripcion!=0) {

            

                tabla_inscripFinal.row(fila.parents('tr')).remove().draw();
               
                opcion=3;
                $.ajax({
                  type:"post",
                  data:'idInscripcion=' + idInscripcion + '&opcion=' + opcion,
                  url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_inscrp_Acta_Examen.php',
                  success:function(respuesta){

 
             
                  }
                });

           
            
          }

        });
        Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Se actualizo los registros',
              showConfirmButton: false,
              timer: 500
            });
        $("#imagenProceso").hide();
        
}


function ActivarCasilla(casilla){
    miscasillas=document.getElementsByClassName('seleTod'); //Rescatamos controles tipo Input
    for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
      {
        if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
        {
          miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
        }
      }
    }



function notaActaGuardar(id_inscripcion,id_alumnos,notaEsc,notaOral,promNumérico,promLetra,informe_malo) {
   
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
        url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_notaActaInscrip.php",
        type: "POST",
        data: {id_inscripcion:id_inscripcion, id_alumnos:id_alumnos, notaEsc:notaEsc, notaOral:notaOral, promNumérico:promNumérico, promLetra:promLetra},
        success: function(res){  
           console.log(res);
            $.unblockUI(); 


            Swal.fire(
          'MUY BIEN',
          'Los datos fueron registrados y guardados en la base de dato',
          'success'
        )
                contenido='NINGUN ESTUDIANTE';
                for (var i = informe_malo.length - 1; i >= 0; i--) {
                    informe_malo[i]

                    if (contenido=='NINGUN ESTUDIANTE') {
                        contenido=informe_malo[i];
                    }else{
                        contenido+='<br>'+informe_malo[i];
                    }

                }
                $("#informeCarga").html("<h3>Los Estudiantes que no registran notas finales, no se guarda la información</h3><br>"+contenido);

                $(".modal-header").css("background-color", "#1cc88a");
                $(".modal-header").css("color", "white");
                $(".modal-title").text("Informe de Carga");            
                $("#informeCarga_modal").modal("show"); 




              
   

        }        
    });
    
    
}   













function listaFi(){ 



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

          $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
       
        $('#contenidoAyuda').load('modulos/gestionAcademicaAlumno/actasExamen/listaAlumnosAdeuda.php');
        
      

        $("#preInscripcion").removeClass("nav-link");
        $("#preInscripcion").addClass("nav-link active");  
  
      
      }














  $.unblockUI();



 function remover6 () {

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



<?php } ?> 











                    <!--  -->
  




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

