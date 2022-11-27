<?php 
	session_start();

	$persona_destino = (isset($_POST['persona_destino'])) ? $_POST['persona_destino'] : '';
	$_SESSION['persona_destino']=$persona_destino;

	echo '1';
	

 ?>