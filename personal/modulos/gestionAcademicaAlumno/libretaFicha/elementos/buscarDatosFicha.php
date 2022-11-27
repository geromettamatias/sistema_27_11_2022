<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$Libro='';
$Folio='';

$auxiliar='';
$piePagina='';
$res='';

if (isset($_SESSION['cicloLectivo'])){
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$idIns = (isset($_POST['idIns'])) ? $_POST['idIns'] : '';


$consulta = "SELECT `datosficha_$cicloLectivo`.`idDatoExtraFicha`, `datosficha_$cicloLectivo`.`idAlumno`, `datosficha_$cicloLectivo`.`Libro`, `datosficha_$cicloLectivo`.`Folio`, `datosficha_$cicloLectivo`.`auxiliar`, `datosficha_$cicloLectivo`.`piePagina` FROM `datosficha_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idAlumno`= `datosficha_$cicloLectivo`.`idAlumno` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $Libro=$dat['Libro'];
                            $Folio=$dat['Folio'];
                            
                            $auxiliar=$dat['auxiliar'];
                            $piePagina=$dat['piePagina'];

                  
                          
                            
                        }

                        $res= $Libro.'||'.$Folio.'||'.$auxiliar.'||'.$piePagina;

                        echo $res;
     
}else{

     $res= $Libro.'||'.$Folio.'||'.$auxiliar.'||'.$piePagina;

     echo $res;
}
$conexion = NULL;