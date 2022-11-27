<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS  
session_start();

$operacion=$_SESSION["operacion"];
$buscarTipo=$_SESSION['buscarTipo'];
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$idActa=$_SESSION["idActa"];

$docentes_datos='';
$id_docente='';
$titulo='SIN-DATOS';
 $consulta = "SELECT `actas_examen_datos_$cicloLectivo`.`idActa`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`id_docente` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `actas_examen_datos_$cicloLectivo`.`tipo` = '$buscarTipo' AND `actas_examen_datos_$cicloLectivo`.`idActa` = '$idActa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       foreach($data as $dat) {

            $titulo=$dat['titulo'];
            $id_docente=$dat['id_docente'];
        }

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

            $docentes_datos.='<tr><td>'.$nombre.'</td><td>'.$dni.'</td><tr>';
        }




 }


}

?>


           
            <table id="tabla_visual" class="table table display" style="width:100%">
    <thead>
        <tr>
            <th>APELLIDO Y NOMBRE</th>
            <th>DNI</th>
    
                
        </tr>
    </thead>
     <tbody>
            <?php  echo $docentes_datos; ?>
    </tbody>        
    <tfoot>
        <tr>
           <th>APELLIDO Y NOMBRE</th>
            <th>DNI</th>
            
        </tr>
    </tfoot>
</table>



  
<script type="text/javascript">


$('#titulo_tabla_visual').DataTable({
        "destroy":true, 
           "pageLength" : 10,   
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