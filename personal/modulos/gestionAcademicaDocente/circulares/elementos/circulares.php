<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 
$circular = (isset($_POST['circular'])) ? $_POST['circular'] : '';


foreach ($_FILES as $key => $file) {


 $nombre= $file['name'];
 $type = $file['type'];
 $size = $file['size'];
 $archivotmp = $file['tmp_name'];

}
  

$new_name_file = $circular."_".$nombre;


$arra=explode('.', $nombre);
$ultimo_type = array_pop($arra);


move_uploaded_file($file['tmp_name'] ,"../../../../../elementos/circulares/".$new_name_file);



$consulta = "INSERT INTO `circular`(`id_circular`, `numero`, `url`, `type`) VALUES (null,'$circular','$new_name_file','$ultimo_type')";         
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 

$consulta = "SELECT `id_circular`, `numero`, `url`, `type` FROM `circular` ORDER BY `id_circular` DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS



?>






