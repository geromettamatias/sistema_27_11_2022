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

$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';
$idActa =$dataFila[0];

        $consulta = "SELECT `actas_examen_datos_$cicloLectivo`.`idActa`, `actas_examen_datos_$cicloLectivo`.`edicion_docente`,`plan_datos_asignaturas`.`ciclo`, `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `plan_datos_asignaturas`.`idPlan`, `actas_examen_datos_$cicloLectivo`.`precentacion`, `actas_examen_datos_$cicloLectivo`.`finalizacion`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `actas_examen_datos_$cicloLectivo`.`tipo` = '$buscarTipo' AND `actas_examen_datos_$cicloLectivo`.`idActa` = '$idActa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       foreach($data as $dat) {

            $idActa=$dat['idActa'];
            $ciclo=$dat['ciclo'];
            $idPlan=$dat['idPlan'];
            $nombreAsignatura=$dat['nombreAsignatura'];
            $precentacion=$dat['precentacion'];
            $date_precentacion = date_create($precentacion);
            $precentacion = date_format($date_precentacion, 'd-m-Y');
            $finalizacion=$dat['finalizacion'];
            $date_finalizacion = date_create($finalizacion);
            $finalizacion = date_format($date_finalizacion, 'd-m-Y');
            $titulo=$dat['titulo'];

            $edicion_docente=$dat['edicion_docente'];
            $edicion_docente_final='';

            if ($edicion_docente=='DESACTIVO') {
                    $edicion_docente_final='ACTIVO';
                }else if($edicion_docente=='ACTIVO'){
                    $edicion_docente_final='DESACTIVO';

                }

        }  

        $consulta = "UPDATE `actas_examen_datos_$cicloLectivo` SET `edicion_docente`='$edicion_docente_final' WHERE `idActa`='$idActa'";   
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  

            $res= $idActa.'||'.$ciclo.'--'.$nombreAsignatura.'--'.$idPlan.'||'.$precentacion.'||'.$finalizacion.'||'.$titulo.'||'.$edicion_docente_final;
                       

            echo $res;


$conexion = NULL;