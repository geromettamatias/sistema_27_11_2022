<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
 

    $cicloF=$_SESSION['cicloLectivo'];

    $cicloFF = explode("||", $cicloF);
    $cicloLectivo= $cicloFF[0]; 
    $edicion= $cicloFF[1]; 

    



$idInscripcion = (isset($_POST['idInscripcion'])) ? $_POST['idInscripcion'] : '';

$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1: //alta

$pref=0; 
    $consulta = "SELECT `acta_examen_inscrip_$cicloLectivo`.`idInscripcion`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos` FROM `acta_examen_inscrip_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `acta_examen_inscrip_$cicloLectivo`.`idAlumno` WHERE `acta_examen_inscrip_$cicloLectivo`.`idActa`='$idActa_inscriAlumno' AND `acta_examen_inscrip_$cicloLectivo`.`idAlumno`='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $pref=1;                

                            
                        }




if ($pref==0) {
    # code...

        $consulta = "INSERT INTO `acta_examen_inscrip_$cicloLectivo`(`idInscripcion`, `idActa`, `idAlumno`, `notaEsc`, `notaOral`, `promNumérico`, `promLetra`) VALUES (null,'$idActa_inscriAlumno','$idAlumnos','','','','') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `acta_examen_inscrip_$cicloLectivo`.`idInscripcion`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`idAlumnos`, `datosalumnos`.`dniAlumnos`, `acta_examen_inscrip_$cicloLectivo`.`notaEsc`, `acta_examen_inscrip_$cicloLectivo`.`notaOral`, `acta_examen_inscrip_$cicloLectivo`.`promNumérico`, `acta_examen_inscrip_$cicloLectivo`.`promLetra` FROM `acta_examen_inscrip_$cicloLectivo` INNER JOIN `datosalumnos` ON datosalumnos.idAlumnos = `acta_examen_inscrip_$cicloLectivo`.`idAlumno` ORDER BY `acta_examen_inscrip_$cicloLectivo`.`idInscripcion` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                              

                            $idInscripcion=$dat['idInscripcion'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];
                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];
                            $idAlumnos=$dat['idAlumnos'];
                          

                        

                            $res= $idInscripcion.'||'.$nombreAlumnos.'||'.$dniAlumnos.'||'.$notaEsc.'||'.$notaOral.'||'.$promNumérico.'||'.$promLetra.'||'.$idAlumnos;
                        }

                        echo $res;
}else{

echo '0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0';

}

        break;
       
    case 3://baja
        $consulta = "DELETE FROM `acta_examen_inscrip_$cicloLectivo` WHERE `idInscripcion`='$idInscripcion' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}



}else{
    echo 'error';
}  
$conexion = NULL;