<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$s_usuarioEstudiante=$_SESSION["s_usuarioEstudiante"];



$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';


$fechaNa =$dataFila[0];
$domicilioAlumnos =$dataFila[1];
$nacido =$dataFila[2];
$procedencia =$dataFila[3];
$telefonoAlumnos =$dataFila[4];
$discapasidadAlumnos =$dataFila[5];
$dniTutor =$dataFila[6];
$nombreTutor =$dataFila[7];
$TelefonoTutor =$dataFila[8];
$nacionalidadTutor =$dataFila[9];
$emailAlumnos =$dataFila[10];
$dniAlumnos =$dataFila[11];
$nombreAlumnos =$dataFila[12];
$cuilAlumnos =$dataFila[13];


 
$consulta = "UPDATE `datosalumnos` SET `cuilAlumnos`='$cuilAlumnos',`dniAlumnos`='$dniAlumnos',`nombreAlumnos`='$nombreAlumnos',`domicilioAlumnos`='$domicilioAlumnos',`emailAlumnos`='$emailAlumnos',`telefonoAlumnos`='$telefonoAlumnos',`discapasidadAlumnos`='$discapasidadAlumnos',`nombreTutor`='$nombreTutor',`dniTutor`='$dniTutor',`TelefonoTutor`='$TelefonoTutor',`fechaNa`='$fechaNa',`nacido`='$nacido',`procedencia`='$procedencia',`nacionalidadTutor`='$nacionalidadTutor' WHERE `dniAlumnos`='$s_usuarioEstudiante'";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $_SESSION["s_usuarioEstudiante"]=$dniAlumnos;

        $_SESSION["cuilAlumnos"]=$cuilAlumnos;
        


        
        $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor` FROM `datosalumnos` INNER JOIN `plan_datos` WHERE `dniAlumnos`='$dniAlumnos'";
               
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;