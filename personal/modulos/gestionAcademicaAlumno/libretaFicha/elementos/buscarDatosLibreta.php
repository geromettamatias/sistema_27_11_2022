<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$promovido='';
$ob='';
$lugarFecha='';

$res='';

if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$idIns = (isset($_POST['idIns'])) ? $_POST['idIns'] : '';


$consulta = "SELECT `datoslibreta_$cicloLectivo`.`idDatosFicha`, `datoslibreta_$cicloLectivo`.`idAlumno`, `datoslibreta_$cicloLectivo`.`promovido`, `datoslibreta_$cicloLectivo`.`ob`, `datoslibreta_$cicloLectivo`.`lugarFecha` FROM `datoslibreta_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`= `datoslibreta_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $promovido=$dat['promovido'];
                            $ob=$dat['ob'];
                            $lugarFecha=$dat['lugarFecha'];

                       
                  
                          
                            
                        }

                        $res= $promovido.'||'.$ob.'||'.$lugarFecha;

                        echo $res;
     
}else{

     $res= $promovido.'||'.$ob.'||'.$lugarFecha;

     echo $res;
}
$conexion = NULL;