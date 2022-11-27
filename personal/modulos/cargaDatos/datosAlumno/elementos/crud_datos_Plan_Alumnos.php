<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$idAlumnos = $dataFila[0];
$estado =$dataFila[1];
$dniAlumnos =$dataFila[2];
$cuilAlumnos =$dataFila[3];
$nLegajos =$dataFila[4];
$nombreAlumnos =$dataFila[5];
$pass =$dataFila[6];
$pass= base64_encode($pass);


$opcion =$dataFila[7];



switch($opcion){
    case 1: //alta



        $discapasidadAlumnos='SIN-DATOS';
        $fechaNa='SIN-DATOS';
        $domicilioAlumnos='SIN-DATOS';
        $emailAlumnos='SIN-DATOS';
        $nacido='SIN-DATOS';
        $procedencia='SIN-DATOS';
        $dniTutor='SIN-DATOS';
        $nombreTutor='SIN-DATOS';
        $TelefonoTutor='SIN-DATOS';
        $nacionalidadTutor='SIN-DATOS';

        $telefonoAlumnos='SIN-DATOS';

        $idPlanEstudio=0;
        $consulta = "SELECT `idPlan` FROM `plan_datos` ORDER BY `idPlan` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
        $idPlanEstudio=$dat['idPlan'];
        }


        $consulta = "INSERT INTO `datosalumnos`(`idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass`, `estado`) VALUES (null,'$nombreAlumnos','$dniAlumnos','$cuilAlumnos','$domicilioAlumnos','$emailAlumnos','$telefonoAlumnos','$discapasidadAlumnos','$nombreTutor','$dniTutor','$TelefonoTutor','$idPlanEstudio','$fechaNa','$nLegajos','$nacido','$procedencia','$nacionalidadTutor','$pass','$estado')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

    

        $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `nLegajos`, `pass`, `estado` FROM `datosalumnos` ORDER BY `idAlumnos` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:

  

        $consulta = "UPDATE `datosalumnos` SET `nombreAlumnos`='$nombreAlumnos',`dniAlumnos`='$dniAlumnos',`cuilAlumnos`='$cuilAlumnos',`nLegajos`='$nLegajos',`pass`='$pass',`estado`='$estado' WHERE `idAlumnos`='$idAlumnos'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        
        $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `nLegajos`, `pass`, `estado` FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja


    $pass_comprobacion =$dataFila[8];


    if ($pass_comprobacion=='ESCUELA16') {
  

    // Buscamos datos del alumno para elimninar completo

     $ciclos_liectivos = array();
     $idIns_alumnos = array();
     $idIns_alumnos_ciclo = array();

    $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo`";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
          array_push($ciclos_liectivos, $dat['ciclo']);

        } 

         foreach ($ciclos_liectivos as &$ciclos_l) {
         
            $consulta = " SELECT `idIns`, `idCurso`, `idAlumno` FROM `inscrip_curso_alumno_$ciclos_l` WHERE `idAlumno`='$idAlumnos'";       
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $dat) {
                 
                 array_push($idIns_alumnos, $dat['idIns']);
                 array_push($idIns_alumnos_ciclo, $ciclos_l);

                } 
  
        }

        // eliminar datos de asistencia, datos de ficha y datos libreta

        foreach ($ciclos_liectivos as &$ciclos_l) {
         
            $consulta = "DELETE FROM `asistenciaalumno_$ciclos_l` WHERE `idAlumno`='$idAlumnos'";     
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "DELETE FROM `datosficha_$ciclos_l` WHERE `idAlumno`='$idAlumnos'";     
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
      
            $consulta = "DELETE FROM `datoslibreta_$ciclos_l` WHERE `idAlumno`='$idAlumnos'";     
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();


      
        }

        $contador=0;

        foreach ($idIns_alumnos_ciclo as &$ciclo_idIns) {

            $idIns=$idIns_alumnos[$contador];
         
            $consulta = "DELETE FROM `libreta_digital_$ciclo_idIns` WHERE `idIns`='$idIns'";     
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "DELETE FROM `inscrip_curso_alumno_$ciclo_idIns` WHERE `idIns`='$idIns'";     
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            
            $contador++;
      
        }



        $consulta = "DELETE FROM `analitico` WHERE `idAlumno`='$idAlumnos'";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "DELETE FROM `analitico_datos` WHERE `idAlumno`='$idAlumnos'";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        $consulta = "DELETE FROM `datosalumnos` WHERE `idAlumnos`='$idAlumnos'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=1;


         }else{

            $data=0;
         }
       
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;