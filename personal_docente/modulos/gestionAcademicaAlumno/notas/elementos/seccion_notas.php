<?php 
	session_start();

	$datos_array=$_POST['datos_array'];
	$id_asignatura = $datos_array[0];
	$cicloLectivo =$datos_array[1];
	$id_curso =$datos_array[2];
	$nombreAsignacion =$datos_array[3];
	$nombreCurso =$datos_array[4];

	$_SESSION['id_asignatura']=$id_asignatura;
	$_SESSION['cicloLectivo']=$cicloLectivo;
	$_SESSION['id_curso']=$id_curso;
	$_SESSION['nombreAsignacion']=$nombreAsignacion;
	$_SESSION['nombreCurso']=$nombreCurso;

	$id_alumnos_array=$_POST['id_alumnos_array'];
	$_SESSION['id_alumnos_array']=$id_alumnos_array;

	$nombreColumnas_array=$_POST['nombreColumnas_array'];
	$_SESSION['nombreColumnas_array']=$nombreColumnas_array;

	echo '1';
	

 ?>