<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();


$variable_mensaje='';
$consulta_data='';

$cicloLectivo=$_SESSION['cicloLectivoFina'];



$nombresColumnas = (isset($_POST['nombresColumnas'])) ? $_POST['nombresColumnas'] : '';
$arrayIdeLibreta = (isset($_POST['arrayIdeLibreta'])) ? $_POST['arrayIdeLibreta'] : '';

$arrayNotasCompletas = (isset($_POST['arrayNotasCompletas'])) ? $_POST['arrayNotasCompletas'] : '';
$contComas = (isset($_POST['contComas'])) ? $_POST['contComas'] : '';
$contComasFijo= (isset($_POST['contComas'])) ? $_POST['contComas'] : '';

$contador=0;


foreach($arrayIdeLibreta as $idLibreta) {

$editarDatos='';

    foreach($nombresColumnas as $nombresColu) {


        if ($contComas == 1) {
            $editarDatos.=' `'.$nombresColu.'`'.'='."'".$arrayNotasCompletas[$contador]."' ";
        }else{
            $editarDatos.=' `'.$nombresColu.'`'.'='."'".$arrayNotasCompletas[$contador]."', ";
        }
        $contador++;
        $contComas--;

        
    }

    $consulta = "UPDATE `libreta_digital_$cicloLectivo` SET $editarDatos WHERE `id_libreta`='$idLibreta'";        
        
    $variable_mensaje=$variable_mensaje.'Proceso Finalizado --N°Libreta'.$idLibreta.'--';
    $consulta_data= $consulta_data.$consulta.';';
    
    $contComas=$contComasFijo;
}


$resultado = $conexion->prepare($consulta_data);
$resultado->execute();  
echo $variable_mensaje;



      


  

$conexion = NULL;