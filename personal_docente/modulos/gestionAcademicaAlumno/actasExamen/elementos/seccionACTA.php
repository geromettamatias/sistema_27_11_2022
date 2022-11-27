<?php 
	session_start();

	$buscarTipo=$_POST['buscarTipo'];
	$_SESSION['buscarTipo']=$buscarTipo;

	$cicloLectivo=$_POST['cicloLectivo'];
	$_SESSION['cicloLectivo']=$cicloLectivo;


	echo '1';
	

 ?>