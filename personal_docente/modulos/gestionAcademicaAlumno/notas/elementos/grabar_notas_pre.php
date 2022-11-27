<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();


$cursoSeProfesor=$_SESSION['cursoSeProfesor'];
$cicloLectivo=$_SESSION['cicloLectivoFina'];
$idUsuario=$_SESSION["idUsuario"];


$idAlumnos=$_SESSION["idAlumnos"];
$colu_1=$_SESSION["colu"];

$colu_array = explode ('&&', $colu_1);
$colu=$colu_array[0];
$colu_editar=$colu_array[1];

$dataFila_nombres = (isset($_POST['dataFila_nombres'])) ? $_POST['dataFila_nombres'] : '';

$dataFila_notas = (isset($_POST['dataFila_notas'])) ? $_POST['dataFila_notas'] : '';




$pregunta=0;

$c2onsulta = "SELECT `id_nota_seccion`, `id_alumno` FROM `secciones_asignaturas_$cicloLectivo` WHERE `id_alumno`='$idAlumnos' AND `columnar`='$colu'";
$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
$d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

foreach($d2ata as $d2at) {
    $pregunta=1;
 } 



if ($pregunta==0) {



$nombre='';
$valor='';


foreach ($dataFila_nombres as $dataFila_nomb) {
    
    if ($nombre=='') {
        $nombre.='`'.$dataFila_nomb.'`';
    }else{
        $nombre.=', `'.$dataFila_nomb.'`';
    }
}

foreach ($dataFila_notas as $dataFila_no) {
    
    if ($valor=='') {
        $valor.="'".$dataFila_no."'";
    }else{
        $valor.=", '".$dataFila_no."'";
    }
}    
   
 
$c2onsulta = "INSERT INTO `secciones_asignaturas_$cicloLectivo`(`id_nota_seccion`, `id_alumno`, `columnar`, $nombre) VALUES (null,'$idAlumnos', '$colu', $valor)";
$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
echo 1;



}else{



    $edi='';


for ($i=0; $i < count($dataFila_notas); $i++) { 

    if ($edi=='') {
      
      $edi.="`".$dataFila_nombres[$i]."`='".$dataFila_notas[$i]."'";

    }else{
       $edi.=", `".$dataFila_nombres[$i]."`='".$dataFila_notas[$i]."'"; 
  
    }


}  
    
$c2onsulta = "UPDATE `secciones_asignaturas_$cicloLectivo` SET $edi WHERE `id_alumno`='$idAlumnos'  AND `columnar`='$colu'";
$r2esultado = $conexion->prepare($c2onsulta);
$r2esultado->execute();
echo 1;

}



$conexion = NULL;