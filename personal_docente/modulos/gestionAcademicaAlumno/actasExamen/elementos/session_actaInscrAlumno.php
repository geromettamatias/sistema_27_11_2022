<?php 
	session_start();

	$idActa=$_POST['idActa'];
	$_SESSION['idActa_inscriAlumno']=$idActa;

	$fecha_inicio=$_POST['fecha_inicio'];
	$_SESSION['fecha_inicio']=$fecha_inicio;


	echo '1';
	

 ?>