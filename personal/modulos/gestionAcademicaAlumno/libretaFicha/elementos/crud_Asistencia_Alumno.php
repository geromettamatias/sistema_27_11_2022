<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 session_start();
$id_alumnos=$_SESSION['id_Alumno_Asistencia'];

$cicloF=$_SESSION['cicloLectivo'];
$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id = $dataFila[0];
$fecha_Alumno =$dataFila[1];
$cantidad_Alumno =$dataFila[2];
$justifico_Alumno =$dataFila[3];
$osb_Alumno =$dataFila[4];
$encabezado =$dataFila[5];
$opcion =$dataFila[6];


 

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `asistenciaalumno_$cicloLectivo`(`id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado`) VALUES (null,'$id_alumnos','$fecha_Alumno','$cantidad_Alumno','$justifico_Alumno','$osb_Alumno','$encabezado')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` ORDER BY `id_Asistencia` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `asistenciaalumno_$cicloLectivo` SET `id_Asistencia`='$id',`idAlumno`='$id_alumnos',`fecha`='$fecha_Alumno',`cantidad`='$cantidad_Alumno',`justificado`='$justifico_Alumno',`observacion`='$osb_Alumno',`encabezado`='$encabezado' WHERE `id_Asistencia`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id_Asistencia`, `idAlumno`, `fecha`, `cantidad`, `justificado`, `observacion`, `encabezado` FROM `asistenciaalumno_$cicloLectivo` WHERE `id_Asistencia`='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `asistenciaalumno_$cicloLectivo` WHERE `id_Asistencia`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=1;
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

