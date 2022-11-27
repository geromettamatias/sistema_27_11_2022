<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();

session_start();

 
$id_usuario=$_SESSION['idUsuario'];
$operacion=$_SESSION["operacion"];


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$id_1 = explode("_", $id);
$id_f=$id_1[1];

$res=0;
$consulta2 = "SELECT `id_calendario`, `nombre`, `color`, `id_usuario` FROM `auto_calendario` WHERE `id_calendario`='$id_f' AND `id_usuario`='$id_usuario'";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
    foreach($dat1a2 as $da1t2) { 

         $res=1;

    }





 if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ 
	
$consulta2 = "DELETE FROM `auto_calendario` WHERE `id_calendario`='$id_f'";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();


echo 1;

}else{

	echo 0;
}





?>

