
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
$id_seccion = (isset($_POST['id_seccion'])) ? $_POST['id_seccion'] : '';




 $consulta = "DELETE FROM `nombres_secciones_asig_$cicloLectivo` WHERE `id_seccion`='$id_seccion'";     
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

        

       

        echo 1;


$conexion = NULL;