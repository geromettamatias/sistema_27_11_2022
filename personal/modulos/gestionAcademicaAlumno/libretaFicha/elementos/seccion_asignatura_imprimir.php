<?php 
	session_start();

	$idAsigF_array=$_POST['idAsigF_array'];
	$_SESSION['idAsigF_array']=$idAsigF_array;
	$nombreColumnas_array=$_POST['nombreColumnas_array'];
	$_SESSION['nombreColumnas_array']=$nombreColumnas_array;

	echo '1';
	

 ?>