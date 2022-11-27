<?php
  
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();
$cursoSe=$_SESSION['cursoSe'];
$cicloF=$_SESSION['cicloLectivo'];
$columnaSEle=$_SESSION['columnaSEle'];
$idasignatura=$_SESSION['idasignatura'];


$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


$asignatura = explode(",", $idasignatura);
$columna = explode(",", $columnaSEle);

              
$col='';            
foreach ($columna as $colu) {

    if ($col=='') {
        $col.="`libreta_digital_$cicloLectivo`.`".$colu."`"; 
    }else{
        $col.=", `libreta_digital_$cicloLectivo`.`".$colu."`"; 
}

   
}

$carga_id_alu = array();
$carga_nombre = array();
$carga_dni = array();
$carga_notas = array();

$carga_Contador=0;

$notas_fi = array();

$alumnos_dni='';

$pre=0;
$consu='';




$c2onsulta = "SELECT `datosalumnos`.`idAlumnos`,`datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre`, `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
$d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

foreach($d2ata as $d2at) {
$idAlumnos=$d2at['idAlumnos'];
$nombreAlumnos=$d2at['nombreAlumnos'];
$dniAlumnos=$d2at['dniAlumnos'];

array_push($carga_id_alu, $idAlumnos);
array_push($carga_nombre, $nombreAlumnos);
array_push($carga_dni, $dniAlumnos);




}


$consu_do='';
$pre_do=0;

foreach ($carga_id_alu as $id_alu) {

 if ($pre_do==0) {
        $pre_do=1;
        $consu_do.="AND `datosalumnos`.`idAlumnos`="."'".$id_alu."'";

    }else{
        $consu_do.=" OR `datosalumnos`.`idAlumnos`="."'".$id_alu."'";
    }


}



$c2onsulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre`, $col , `datosalumnos`.`idAlumnos`,`datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre`, `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `plan_datos_asignaturas`.`idAsig`  FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` INNER JOIN `libreta_digital_$cicloLectivo` ON `libreta_digital_$cicloLectivo`.`idIns` =`inscrip_curso_alumno_$cicloLectivo`.`idIns` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe' ".$consu_do;

$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
$d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

foreach($d2ata as $d2at) {

    $idAsig=$d2at['idAsig'];
    $pregunta=0;

    



        foreach ($asignatura as $asig) {
            $asignat = explode("||", $asig);
            $id_A= $asignat[0]; // porción1
                
            if ($idAsig==$id_A) {
                $pregunta=1;
            }

        }

    if ($pregunta==1) {
            foreach ($columna as $colu) {
 
            $colu_se=$d2at[''.$colu.''];


            array_push($carga_notas, $colu_se);

            }

    }

    

}








?>

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">PLANILLA DE NOTAS</h3>

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
 
     <div class="table-responsive"> 

<h3></h3>

<button class="btn btn-outline-danger" onclick="seleccionarTODO()" class="obtener">Select/NoSelect</button>


 <button class="btn btn-outline-warning"  onclick="borrarSeleccion()">Ocultar fila/s Seleccionadas</button>
       
 
<button class="btn btn-outline-secondary"  onclick="actualizar()" >Mostar todas las filas Ocultas</button>
         


<hr>
<h3>Titulo:</h3>
<button class="btn btn-outline-primary"  onclick="cambiar_titulo()" ><h5 id="titulo_tabla">PLANILLA DE NOTAS</h5></button>

<hr>
              
    <table id="example" class="table table-bordered table display" style="width:100%">
    <thead>


        <tr>
            <th>Apellido y Nombre</th>
            <th>DNI</th>
       
       
                <?php

                foreach ($asignatura as $asig) {

                      $asignat = explode("||", $asig);
                        $id_A= $asignat[0]; // porción1
                        $asig_fin= $asignat[1]; // porción2


                        foreach ($columna as $colu) {

                            $carga_Contador++;
                        ?>
                        <th> <?php  echo $asig_fin.'  <hr>  '.$colu; ?></th>

                <?php }} ?>


        </tr>
                
   
    </thead>
     <tbody>
         
            
        <?php 

        $not=0;


        for ($i=0; $i < count($carga_nombre); $i++) { 
            
             echo '<tr>';
             echo '<th>'.$carga_nombre[$i].'</th>';
             echo '<th>'.$carga_dni[$i].'</th>';


            for ($x=0; $x < $carga_Contador; $x++) { 

                $not=($i*$carga_Contador)+$x;




                echo '<th>'.$carga_notas[$not].'</th>';

            }




             



             echo '</tr>';

        }

        



         ?>



    </tbody>        

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

var myTable;

var_title= $('#titulo_tabla').html();
table(var_title);
function cambiar_titulo() {


  


                  Swal.fire({
              title: 'INGRESE EL TITULO DE LA TABLA',
              html:'<input type="text" class="form-control" id="texto">', 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  text = document.getElementById('texto').value;

                  $('#titulo_tabla').html(text);

                  table(text);  
                                  
                }
        });


    

    
}

$.unblockUI();

$('#imagenProceso').hide();

function table(var_title) {


       myTable = $('#example').DataTable({
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
            //para usar los botones   
            responsive: "true",
            dom: 'Bfrtilp',       
            buttons:[ 
          {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success',
            title: var_title,
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger',
            title: var_title,
          },
          {
             
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
            title: var_title,

          },
        ]         
        });


    }

$('#imprimir').on('click', 'tr', function () {
alert();
} );
 

//  inicio el array y el selector (total)
var arrayContieneLosElementosAEliminar =[];
var selector=0;



//  selecciono particular o grupal, agrego en un array 

$('#example tbody').on('click', 'tr', function () {
        
        // selecciona en datatable
         $(this).toggleClass('selected');

  

   
    // obtengo los valores
    var dataFila = myTable.row( this ).data();
    //verifico con el dato si esta dentro del array, busco y si tiene indice
    index = arrayContieneLosElementosAEliminar.indexOf(dataFila[0]);
    // verifico si posee indice no puede dar -1
    if (index > -1) {
        // elimino el elemento seleccionado con el indice encontrado
        arrayContieneLosElementosAEliminar.splice(index, 1);
    }else{
        // agrego elemento al array
        arrayContieneLosElementosAEliminar.push(dataFila[0]);

    }
console.log(arrayContieneLosElementosAEliminar); 


} );

//  fin seleccion particular o grupal

//  seleccinar total
function seleccionarTODO () {

    //  selecciono y selecciono todo, reinicio el array y agrego los elementos nuevamente...

    if ((selector % 2) == 0) {
             $("tr").addClass(" odd selected");
            arrayContieneLosElementosAEliminar=[];

            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar.push(dataFila_total);
            });

    }else{

            $("tr").removeClass(" odd selected");
            
            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar=[];
            });
    }

selector++;

console.log(arrayContieneLosElementosAEliminar); 


}

//  fino selecciono total


//  eliminar lo seleccionado

function borrarSeleccion () {
  
        myTable.rows('.selected').remove().draw();
}

// fin de eliminar seleccionado



//  agregar una fila

function Agregar () {

   myTable.row.add([1,2,3,4,5,6]).draw();

}

function actualizar () {


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
 

$('#tablaFiFIFI').load('modulos/gestionAcademicaAlumno/planillaNotas/tablaColu.php');
                    


}




</script>



