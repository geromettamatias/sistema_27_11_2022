
<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';



$consulta2 = "DELETE FROM `calendario_ins` WHERE `id_calendario`='$id'";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();


echo 1;


?>
