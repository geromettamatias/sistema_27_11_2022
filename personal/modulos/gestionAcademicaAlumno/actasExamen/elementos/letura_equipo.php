<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$operacion=$_SESSION["operacion"];
$buscarTipo=$_SESSION['buscarTipo'];
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


$id = (isset($_POST['id'])) ? $_POST['id'] : '';



        $consulta = "SELECT `id`, `titulo`, `id_docente`, `obser` FROM `acta_examen_equipo_pedagogico_$cicloLectivo` WHERE `id`='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
           foreach($data as $dat) {

          $id=$dat['id'];
          $titulo=$dat['titulo'];
          $id_docente=$dat['id_docente'];
          $obser=$dat['obser'];

                }


                echo $id.'||'.$titulo.'||'.$id_docente.'||'.$obser;
$conexion = NULL;