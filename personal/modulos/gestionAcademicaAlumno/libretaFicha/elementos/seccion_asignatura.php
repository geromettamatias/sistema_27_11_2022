<?php 
	session_start();

	$idAsig=$_POST['idAsig'];
	$_SESSION['idAsig']=$idAsig;

	$colu=$_POST['colu'];
	$_SESSION['colu']=$colu;


	echo '1';
	

 ?>