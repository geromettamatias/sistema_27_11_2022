<?php 

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
require '../../../bd/libreria-php-json/json-file-decode.class.php';

session_start();

$id_notificaciones_dos=0;

$persona_origen='';
$id_persona_origen='';
$persona_destino='';
$id_persona_destino='';
$asunto='';
$texto='';
$id_usuarios_confirmacion='';


$id_notificaciones = (isset($_POST['id_notificaciones'])) ? $_POST['id_notificaciones'] : '';
$_SESSION['id_notificaciones']=$id_notificaciones;

$read = new json_file_decode();
$datos_array_docente = $read->json("../../../../../elementos/datos/notificaciones/usuario/datos.json");


$cadena = implode($datos_array_docente[0]);

if ($cadena!='') {
foreach ($datos_array_docente as $datos_array_docente_1) {


		$id_notificaciones_dos=$datos_array_docente_1[0];


		if ($id_notificaciones_dos==$id_notificaciones) {
			// code...
		
		 	 
		      $persona_origen=$datos_array_docente_1[1];
		      $id_persona_origen=$datos_array_docente_1[2];
		      $persona_destino=$datos_array_docente_1[3];
		      $id_persona_destino=$datos_array_docente_1[4];
		      $asunto=$datos_array_docente_1[5];
		      $texto=$datos_array_docente_1[6];
		      $id_usuarios_confirmacion=$datos_array_docente_1[7];

   		}
   
}
}



	$_SESSION['persona_origen']=$persona_origen;
	$_SESSION['id_persona_origen']=$id_persona_origen;
	$_SESSION['persona_destino']=$persona_destino;
	$_SESSION['id_persona_destino']=$id_persona_destino;
	$_SESSION['asunto']=$asunto;
	$_SESSION['texto']=$texto;
	$_SESSION['id_usuarios_confirmacion']=$id_usuarios_confirmacion;


	$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
	$_SESSION['opcion']=$opcion;

	echo 1;
	

 ?>