<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


session_start();

$id_usuario=$_SESSION['idUsuario'];


$dias_completo = (isset($_POST['dias_completo'])) ? $_POST['dias_completo'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$background_color = (isset($_POST['background_color'])) ? $_POST['background_color'] : '';
$color_fin = (isset($_POST['color_fin'])) ? $_POST['color_fin'] : '';


$consulta2 = "INSERT INTO `calendario_ins`(`id_calendario`, `allDay`, `date`, `innerHTML`, `background_color`, `color_fin`, `id_usuario`) VALUES (null,'$dias_completo','$fecha ','$nombre','$background_color','$color_fin','$id_usuario')";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();

echo 1;


?>
