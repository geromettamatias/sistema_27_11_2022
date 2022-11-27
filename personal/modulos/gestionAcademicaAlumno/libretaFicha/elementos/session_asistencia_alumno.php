
<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$idIns=$_POST['idIns'];
$_SESSION['idIns']=$idIns;


$cicloF=$_SESSION['cicloLectivo'];
$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 
$id_Alumno_Asistencia='';

$consulta = "SELECT `inscrip_curso_alumno_$cicloLectivo`.`idIns`, `inscrip_curso_alumno_$cicloLectivo`.`idCurso`, `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos`= `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $dat) {
	$idAlumno=$dat['idAlumno'];
	$id_Alumno_Asistencia=$idAlumno;
} 


$_SESSION['id_Alumno_Asistencia']=$id_Alumno_Asistencia;



	echo '1';
	

 ?>