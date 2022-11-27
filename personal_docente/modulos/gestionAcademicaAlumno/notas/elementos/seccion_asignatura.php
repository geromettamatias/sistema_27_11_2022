<?php 
	session_start();

	$idAlumnos=$_POST['idAlumnos'];
	$_SESSION['idAlumnos']=$idAlumnos;

	$colu=$_POST['colu'];
	$_SESSION['colu']=$colu;

	echo '1';
	

 ?>