<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$s_usuarioEstudiante=$_SESSION["s_usuarioEstudiante"];



$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';



$pass_actual =$dataFila[0];
$pass_actual= base64_encode($pass_actual);

$pass_nueva =$dataFila[1];
$pass_nueva= base64_encode($pass_nueva);


$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass`, `estado` FROM `datosalumnos` WHERE `dniAlumnos`='$s_usuarioEstudiante' AND `pass`='$pass_actual'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
if($resultado->rowCount() >= 1){


        $consulta = "UPDATE `datosalumnos` SET `pass`='$pass_nueva' WHERE `dniAlumnos`='$s_usuarioEstudiante'";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
       

       echo 1;
       
}else{
        echo 2;
}



$conexion = NULL;