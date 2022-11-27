<?php 

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
require '../../../bd/libreria-php-json/json-file-decode.class.php';

session_start();

$id_notificaciones = (isset($_POST['id_notificaciones'])) ? $_POST['id_notificaciones'] : '';
$_SESSION['id_notificaciones']=$id_notificaciones;
$persona_destino = (isset($_POST['persona_destino'])) ? $_POST['persona_destino'] : '';
$_SESSION['persona_destino']=$persona_destino;




$id_persona_destino='';
$id_usuarios_confirmacion='';

$id_notificaciones_dos=0;



$read = new json_file_decode();
$datos_array_docente = $read->json("../../../../../elementos/datos/notificaciones/usuario/datos.json");


$cadena = implode($datos_array_docente[0]);

if ($cadena!='') {
foreach ($datos_array_docente as $datos_array_docente_1) {


		$id_notificaciones_dos=$datos_array_docente_1[0];


		if ($id_notificaciones_dos==$id_notificaciones) {
	
		    
		      $id_persona_destino=$datos_array_docente_1[4];
		      $id_usuarios_confirmacion=$datos_array_docente_1[7];

   		}
   
}
}



	$_SESSION['id_persona_destino']=$id_persona_destino;

	$_SESSION['id_usuarios_confirmacion']=$id_usuarios_confirmacion;


	echo 1;
	

 ?>