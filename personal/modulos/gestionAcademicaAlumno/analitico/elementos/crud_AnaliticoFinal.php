<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$array_analitico = (isset($_POST['array_analitico'])) ? $_POST['array_analitico'] : '';

$array_notas = (isset($_POST['array_notas'])) ? $_POST['array_notas'] : '';
$array_notasEscr = (isset($_POST['array_notasEscr'])) ? $_POST['array_notasEscr'] : '';
$array_fechaMes = (isset($_POST['array_fechaMes'])) ? $_POST['array_fechaMes'] : '';
$array_fechaAño = (isset($_POST['array_fechaAño'])) ? $_POST['array_fechaAño'] : '';
$array_condicion = (isset($_POST['array_condicion'])) ? $_POST['array_condicion'] : '';
$array_establecimiento = (isset($_POST['array_establecimiento'])) ? $_POST['array_establecimiento'] : '';

$consulta_Data = '';
$analitico='';
$nota='';
$notaEscr='';
$fechaMes='';
$fechaAño='';
$condicion='';
$establecimiento='';

for ($i=0; $i < count($array_analitico); $i++) { 

   $analitico=$array_analitico[$i];

   $nota=$array_notas[$i];
   $notaEscr=$array_notasEscr[$i];
   $fechaMes=$array_fechaMes[$i];
   $fechaAño=$array_fechaAño[$i];
   $condicion=$array_condicion[$i];
   $establecimiento=$array_establecimiento[$i];
  
   $consulta = "UPDATE `analitico` SET `nota`='$nota', `notaEscr`='$notaEscr', `fechaMes`='$fechaMes', `fechaAño`='$fechaAño', `condicion`='$condicion', `establecimiento`='$establecimiento' WHERE `idAnalitico`='$analitico'";

   $consulta_Data= $consulta_Data.$consulta.';';

}


$resultado = $conexion->prepare($consulta_Data);
$resultado->execute(); 

echo 1;


$conexion = NULL;