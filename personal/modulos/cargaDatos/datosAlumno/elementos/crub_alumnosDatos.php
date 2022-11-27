<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$idAlumnos=$_SESSION["idAlumnos"];



$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$idPlanEstudio = $dataFila[0];
$fechaNa =$dataFila[1];
$domicilioAlumnos =$dataFila[2];
$nacido =$dataFila[3];
$procedencia =$dataFila[4];
$telefonoAlumnos =$dataFila[5];
$discapasidadAlumnos =$dataFila[6];
$dniTutor =$dataFila[7];
$nombreTutor =$dataFila[8];
$TelefonoTutor =$dataFila[9];
$nacionalidadTutor =$dataFila[10];
$emailAlumnos =$dataFila[11];

 
$consulta = "UPDATE `datosalumnos` SET `domicilioAlumnos`='$domicilioAlumnos',`emailAlumnos`='$emailAlumnos',`telefonoAlumnos`='$telefonoAlumnos',`discapasidadAlumnos`='$discapasidadAlumnos',`nombreTutor`='$nombreTutor',`dniTutor`='$dniTutor',`TelefonoTutor`='$TelefonoTutor',`idPlanEstudio`='$idPlanEstudio',`fechaNa`='$fechaNa',`nacido`='$nacido',`procedencia`='$procedencia',`nacionalidadTutor`='$nacionalidadTutor' WHERE `idAlumnos`='$idAlumnos'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        
        $consulta = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `datosalumnos`.`domicilioAlumnos`, `datosalumnos`.`emailAlumnos`, `datosalumnos`.`telefonoAlumnos`, `datosalumnos`.`discapasidadAlumnos`, `datosalumnos`.`nombreTutor`, `datosalumnos`.`dniTutor`, `datosalumnos`.`TelefonoTutor`, `datosalumnos`.`idPlanEstudio`, `datosalumnos`.`fechaNa`, `datosalumnos`.`nacido`, `datosalumnos`.`procedencia`, `datosalumnos`.`nacionalidadTutor`, `plan_datos`.`nombre` FROM `datosalumnos` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan` =  `datosalumnos`.`idPlanEstudio` WHERE `datosalumnos`.`idAlumnos`='$idAlumnos'";
               
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;