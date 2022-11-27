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


$matricula = (isset($_POST['matricula'])) ? $_POST['matricula'] : '';

$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$equipo = $dataFila[0];
$fechaActa =$dataFila[1];
$fechaActaCierre =$dataFila[2];
$asignaturas_ingreso =$dataFila[3];
$idActa =$dataFila[4];
$opcion =$dataFila[5];


switch($opcion){
    case 1: 
        $sentencia='';
        $asignaturas_i = explode(",", $asignaturas_ingreso);

        foreach ($asignaturas_i as $asignaturas) {
            
          

            if ($sentencia=='') {
                
                $sentencia.="(null,'$buscarTipo','$asignaturas','$fechaActa','$equipo','$fechaActaCierre','DESACTIVO')";
            }else{

                $sentencia.=", (null,'$buscarTipo','$asignaturas','$fechaActa','$equipo','$fechaActaCierre','DESACTIVO')";
            }
            

             

        }
            


        $consulta = "INSERT INTO `actas_examen_datos_$cicloLectivo`(`idActa`, `tipo`, `idAsignatura`, `precentacion`, `id_equipo`, `finalizacion`, `edicion_docente`) VALUES $sentencia";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        if ($matricula=='SI') {



            
               

                    foreach ($asignaturas_i as $asignaturas) {

                        $id_alumno_inscribir = [];

                          $idActa=0;
                            $consulta = "SELECT `idActa`, `tipo`, `idAsignatura`, `precentacion`, `id_equipo`, `finalizacion` FROM `actas_examen_datos_$cicloLectivo` WHERE `idAsignatura`='$asignaturas' AND `precentacion`='$fechaActa' AND `id_equipo`='$equipo' AND `finalizacion`='$fechaActaCierre' AND `tipo`='$buscarTipo'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach($data as $dat) {
                                $idActa=$dat['idActa'];
                            }




                            $consulta = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`,`asignaturas_pendientes_$cicloLectivo`.`idAsigPendiente`,`asignaturas_pendientes_$cicloLectivo`.`asignaturas`, `plan_datos_asignaturas`.`nombre`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_1`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_2`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_3`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_4`, `asignaturas_pendientes_$cicloLectivo`.`calFinal_5` FROM `datosalumnos` INNER JOIN `asignaturas_pendientes_$cicloLectivo` ON `asignaturas_pendientes_$cicloLectivo`.`idAlumno`=`datosalumnos`.`idAlumnos` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig`= `asignaturas_pendientes_$cicloLectivo`.`asignaturas` WHERE `asignaturas_pendientes_$cicloLectivo`.`asignaturas`='$asignaturas'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                          
                                    foreach($data as $dat) { 

                                        $idAlumnos=$dat['idAlumnos'];
                                      
                                        $calFinal_1=intval($dat['calFinal_1']);
                                        $calFinal_2=intval($dat['calFinal_2']);
                                        $calFinal_3=intval($dat['calFinal_3']);
                                        $calFinal_4=intval($dat['calFinal_4']);
                                        $calFinal_5=intval($dat['calFinal_5']);

                                        if ((($calFinal_1=='') || ($calFinal_1 < 6)) && (($calFinal_2=='') || ($calFinal_2 < 6)) && (($calFinal_3=='') || ($calFinal_3 < 6)) && (($calFinal_4=='') || ($calFinal_4 < 6)) && (($calFinal_5=='') || ($calFinal_5 < 6))) {

                                            // echo  $idAlumnos.' -- '.$calFinal_1.' , '.$calFinal_2.' , '.$calFinal_3.' , '.$calFinal_4.' , '.$calFinal_5.' //    ';
                                            array_push($id_alumno_inscribir, $idAlumnos);
                                            
                                        }
         
                                      
                                    }


                               foreach ($id_alumno_inscribir as $id_alumno_ins) {


                                    if ($idActa!=0) {
                                        $consulta = "INSERT INTO `acta_examen_inscrip_$cicloLectivo`(`idInscripcion`, `idActa`, `idAlumno`, `notaEsc`, `notaOral`, `promNumérico`, `promLetra`) VALUES (null,'$idActa','$id_alumno_ins','','','','')";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                    }


                                }





          
                    }



                 

                    // print json_encode($id_alumno_inscribir, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS

                    echo 1;

                   

        }



                            
        break;
    case 2: //modificación


        $consulta = "UPDATE `actas_examen_datos_$cicloLectivo` SET `precentacion`='$fechaActa',`id_equipo`='$equipo',`finalizacion`='$fechaActaCierre' WHERE `idActa`='$idActa'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  

  
        $consulta = "SELECT `actas_examen_datos_$cicloLectivo`.`idActa`, `actas_examen_datos_$cicloLectivo`.`edicion_docente`,`plan_datos_asignaturas`.`ciclo`, `plan_datos_asignaturas`.`nombre` AS 'nombreAsignatura', `plan_datos_asignaturas`.`idPlan`, `actas_examen_datos_$cicloLectivo`.`precentacion`, `actas_examen_datos_$cicloLectivo`.`finalizacion`, `acta_examen_equipo_pedagogico_$cicloLectivo`.`titulo` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo` WHERE `actas_examen_datos_$cicloLectivo`.`tipo` = '$buscarTipo' AND `actas_examen_datos_$cicloLectivo`.`idActa` = '$idActa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       foreach($data as $dat) {

            $idActa=$dat['idActa'];
            $ciclo=$dat['ciclo'];
            $idPlan=$dat['idPlan'];
            $nombreAsignatura=$dat['nombreAsignatura'];
            $precentacion=$dat['precentacion'];
            $date_precentacion = date_create($precentacion);
            $precentacion = date_format($date_precentacion, 'd-m-Y');
            $finalizacion=$dat['finalizacion'];
            $date_finalizacion = date_create($finalizacion);
            $finalizacion = date_format($date_finalizacion, 'd-m-Y');
            $titulo=$dat['titulo'];

            $edicion_docente=$dat['edicion_docente'];

        }    
            $res= $idActa.'||'.$ciclo.'--'.$nombreAsignatura.'--'.$idPlan.'||'.$precentacion.'||'.$finalizacion.'||'.$titulo.'||'.$edicion_docente;
                       

            echo $res;

      
        break;        
    case 3://baja
        $consulta = "DELETE FROM `actas_examen_datos_$cicloLectivo` WHERE `idActa`='$idActa'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        $consulta = "DELETE FROM `acta_examen_inscrip_$cicloLectivo` WHERE `idActa`='$idActa'";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;        
}

$conexion = NULL;