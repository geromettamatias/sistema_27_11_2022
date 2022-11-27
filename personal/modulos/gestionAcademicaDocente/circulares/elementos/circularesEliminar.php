<?php 
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$id_circular = (isset($_POST['id_circular'])) ? $_POST['id_circular'] : '';


 
$consulta = "SELECT `id_circular`, `numero`, `url`, `type` FROM `circular` WHERE `id_circular`='$id_circular'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

foreach($data as $dat) {                                                        
         $url=$dat['url']; 
     }
	
	unlink('../../../../../elementos/circulares/'.$url);
	
$consulta = "DELETE FROM `circular` WHERE `id_circular`='$id_circular'";   
$resultado = $conexion->prepare($consulta);
$resultado->execute();
           
echo 1;
 ?>