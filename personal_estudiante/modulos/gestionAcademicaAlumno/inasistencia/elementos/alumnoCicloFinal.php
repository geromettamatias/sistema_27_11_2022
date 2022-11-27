<?php 
	session_start();

	$cicloLectivo_INA = (isset($_POST['cicloLectivo_INA'])) ? $_POST['cicloLectivo_INA'] : '';
	$_SESSION['cicloLectivo_INA']=$cicloLectivo_INA;


	echo $cicloLectivo_INA;
	


 ?>