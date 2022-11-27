<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 


$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';


$consulta = "UPDATE `datosalumnos` SET `estado`='$estado' WHERE `idAlumnos`='$idAlumnos'";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        
        $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `nLegajos`, `pass`, `estado` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;