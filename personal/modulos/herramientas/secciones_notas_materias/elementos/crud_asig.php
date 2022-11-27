
<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
$operacion=$_SESSION["operacion"];

if ((isset($_SESSION['cursoSe']))){
$cursoSe=$_SESSION['cursoSe'];

  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

}


$asignatura_vieja = (isset($_POST['asignatura_vieja'])) ? $_POST['asignatura_vieja'] : '';
$nombre_vieja = (isset($_POST['nombre_vieja'])) ? $_POST['nombre_vieja'] : '';


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id_seccion = $dataFila[0];
$asignatura =$dataFila[1];
$nombre_seccion_no =$dataFila[2];
$docentes =$dataFila[3];
$periodo =$dataFila[4];
$observacion =$dataFila[5];
$opcion =$dataFila[6];


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `nombres_secciones_asig_$cicloLectivo`(`id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs`, `id_curso`) VALUES (null,'$asignatura','$nombre_seccion_no','$docentes','$periodo','$observacion','$cursoSe')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $asignatura_arr = explode(",", $asignatura);

        $consulta_f='';

        foreach ($asignatura_arr as $id_asignatura_fi) {

            $cabezera=$id_asignatura_fi.'_'.$cursoSe.'_'.$nombre_seccion_no;

            if ($consulta_f=='') {
                $consulta_f="ALTER TABLE `secciones_asignaturas_$cicloLectivo` ADD `$cabezera` TEXT NULL AFTER `id_alumno`";
            }else{

                $consulta_f.=';'."ALTER TABLE `secciones_asignaturas_$cicloLectivo` ADD `$cabezera` TEXT NULL AFTER `id_alumno`";

            }

             
         } 
          
        $resultado_d = $conexion->prepare($consulta_f);
        $resultado_d->execute();



        $data_array=array();



        $consulta = "SELECT `id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs` FROM `nombres_secciones_asig_$cicloLectivo` ORDER BY `id_seccion` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $id_seccion= $dat['id_seccion'];
            $asignatura_dos= $dat['asignatura'];
            $nombre_seccion_dos= $dat['nombre_seccion'];
            $id_profesores_dos= $dat['id_profesores'];
            $periodo_dos= $dat['periodo'];
            $obs_dos= $dat['obs'];


            array_push($data_array, $id_seccion);
            array_push($data_array, $asignatura_dos);
            array_push($data_array, $nombre_seccion_dos);
            array_push($data_array, $id_profesores_dos);
            array_push($data_array, $periodo_dos);
            array_push($data_array, $obs_dos);

        }

         

         $asignatura_array = explode(",", $asignatura_dos);

                $imprimir='';

                foreach ($asignatura_array as $id_asignatura) {
                    
                    $consulta_2 = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan`, `cantidadHoraCatedra` FROM `plan_datos_asignaturas` WHERE `idAsig`='$id_asignatura'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                        $idAsig=$dat_2['idAsig'];
                        $nombre=$dat_2['nombre'];

                        if ($imprimir=='') {
                            $imprimir.=$idAsig.'-'.$nombre;
                        }else{
                            $imprimir.='||'.$idAsig.'-'.$nombre;
                        }
                    }


                }

             array_push($data_array, $imprimir);  
             

              $profesores_array = explode(",", $id_profesores_dos);

                $imprimir_dos='';

                foreach ($profesores_array as $id_profesores_doss) {
                    
                    $consulta_2 = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `idDocente`='$id_profesores_doss'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                        $idDocente=$dat_2['idDocente'];
                        $nombre=$dat_2['nombre'];
                        $dni=$dat_2['dni'];

                        if ($imprimir_dos=='') {
                            $imprimir_dos.=$idDocente.'-'.$nombre;
                        }else{
                            $imprimir_dos.='||'.$idDocente.'-'.$nombre;
                        }
                    }


                }
  
                array_push($data_array, $imprimir_dos);  
             
        print json_encode($data_array, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;
    case 2: //modificación
         $consulta = "UPDATE `nombres_secciones_asig_2022` SET `asignatura`='$asignatura',`nombre_seccion`='$nombre_seccion_no',`id_profesores`='$docentes',`periodo`='$periodo',`obs`='$observacion' WHERE `id_seccion`='$id_seccion'";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        $asignatura_arr_vieja = explode(",", $asignatura_vieja);

        $consulta_f_vieja='';

        foreach ($asignatura_arr_vieja as $id_asignatura_fi_d) {

             $cabezera_dos=$id_asignatura_fi_d.'_'.$cursoSe.'_'.$nombre_vieja;

          

            if ($consulta_f_vieja=='') {
                $consulta_f_vieja="ALTER TABLE `secciones_asignaturas_$cicloLectivo` DROP `$cabezera_dos`";
            }else{

                $consulta_f_vieja.=';'."ALTER TABLE `secciones_asignaturas_$cicloLectivo` DROP `$cabezera_dos`";

            }

             
         }


        $resultado_d = $conexion->prepare($consulta_f_vieja);
        $resultado_d->execute();


        // -----------------------------





        $asignatura_arr = explode(",", $asignatura);

        $consulta_f='';

        foreach ($asignatura_arr as $id_asignatura_fi) {

            $cabezera=$id_asignatura_fi.'_'.$cursoSe.'_'.$nombre_seccion_no;

    

            if ($consulta_f=='') {
                $consulta_f="ALTER TABLE `secciones_asignaturas_$cicloLectivo` ADD `$cabezera` TEXT NULL AFTER `id_alumno`";
            }else{

                $consulta_f.=';'."ALTER TABLE `secciones_asignaturas_$cicloLectivo` ADD `$cabezera` TEXT NULL AFTER `id_alumno`";

            }

             
         }

        $resultado_d = $conexion->prepare($consulta_f);
        $resultado_d->execute();



        $data_array=array();


        $consulta = "SELECT `id_seccion`, `asignatura`, `nombre_seccion`, `id_profesores`, `periodo`, `obs` FROM `nombres_secciones_asig_$cicloLectivo` WHERE `id_seccion`='$id_seccion'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $id_seccion= $dat['id_seccion'];
            $asignatura_dos= $dat['asignatura'];
            $nombre_seccion_dos= $dat['nombre_seccion'];
            $id_profesores_dos= $dat['id_profesores'];
            $periodo_dos= $dat['periodo'];
            $obs_dos= $dat['obs'];


            array_push($data_array, $id_seccion);
            array_push($data_array, $asignatura_dos);
            array_push($data_array, $nombre_seccion_dos);
            array_push($data_array, $id_profesores_dos);
            array_push($data_array, $periodo_dos);
            array_push($data_array, $obs_dos);

        }

         

         $asignatura_array = explode(",", $asignatura_dos);

                $imprimir='';

                foreach ($asignatura_array as $id_asignatura) {
                    
                    $consulta_2 = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan`, `cantidadHoraCatedra` FROM `plan_datos_asignaturas` WHERE `idAsig`='$id_asignatura'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                        $idAsig=$dat_2['idAsig'];
                        $nombre=$dat_2['nombre'];

                        if ($imprimir=='') {
                            $imprimir.=$idAsig.'-'.$nombre;
                        }else{
                            $imprimir.='||'.$idAsig.'-'.$nombre;
                        }
                    }


                }

             array_push($data_array, $imprimir);  
             

              $profesores_array = explode(",", $id_profesores_dos);

                $imprimir_dos='';

                foreach ($profesores_array as $id_profesores_doss) {
                    
                    $consulta_2 = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `idDocente`='$id_profesores_doss'";
                    $resultado_2 = $conexion->prepare($consulta_2);
                    $resultado_2->execute();
                    $data_2=$resultado_2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data_2 as $dat_2) {
                        $idDocente=$dat_2['idDocente'];
                        $nombre=$dat_2['nombre'];
                        $dni=$dat_2['dni'];

                        if ($imprimir_dos=='') {
                            $imprimir_dos.=$idDocente.'-'.$nombre;
                        }else{
                            $imprimir_dos.='||'.$idDocente.'-'.$nombre;
                        }
                    }


                }
  
                array_push($data_array, $imprimir_dos);  
             
        print json_encode($data_array, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS


        break;        
       
}


$conexion = NULL;