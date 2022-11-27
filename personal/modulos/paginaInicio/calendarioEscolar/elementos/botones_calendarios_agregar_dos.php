
<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();

 
 
$id_usuario=$_SESSION['idUsuario'];
$operacion=$_SESSION["operacion"];



$nombre_boton = (isset($_POST['nombre_boton'])) ? $_POST['nombre_boton'] : '';
$currColor = (isset($_POST['currColor'])) ? $_POST['currColor'] : '';



$consulta2 = "INSERT INTO `auto_calendario`(`id_calendario`, `nombre`, `color`, `id_usuario`) VALUES (null,'$nombre_boton','$currColor','$id_usuario')";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();

$consulta = "SELECT `id_calendario`, `nombre`, `color`, `id_usuario` FROM `auto_calendario` ORDER BY `id_calendario` DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


?>
