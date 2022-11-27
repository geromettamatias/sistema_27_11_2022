<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$promovido = (isset($_POST['promovido'])) ? $_POST['promovido'] : '';
$ob = (isset($_POST['ob'])) ? $_POST['ob'] : '';
$lugarFecha = (isset($_POST['lugarFecha'])) ? $_POST['lugarFecha'] : '';

$idIns = (isset($_POST['idIns'])) ? $_POST['idIns'] : '';


if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 	
	$pref=0;

$idAlumno=0;
    $consulta = "SELECT `idAlumno` FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `idIns`='$idIns'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $idAlumno=$dat['idAlumno'];                

            }




	$consulta = "SELECT `idDatosFicha`, `idAlumno` FROM `datoslibreta_$cicloLectivo` WHERE `idAlumno`='$idAlumno'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $pref=1;                

            }

    if ($pref==0) {
                 
        $consulta = "INSERT INTO `datoslibreta_$cicloLectivo`(`idDatosFicha`, `idAlumno`, `promovido`, `ob`, `lugarFecha`) VALUES (null,'$idAlumno','$promovido','$ob','$lugarFecha')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

      	
    }else{

    
    	  $consulta = "UPDATE `datoslibreta_$cicloLectivo` SET `promovido`='$promovido',`ob`='$ob',`lugarFecha`='$lugarFecha' WHERE `idAlumno`='$idAlumno'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
    }    

echo "Muy Bien";
$conexion = NULL;

}