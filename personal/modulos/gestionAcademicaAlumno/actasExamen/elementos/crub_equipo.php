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


$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id = $dataFila[0];

$titulo =$dataFila[1];
$docentes =$dataFila[2];
$obser =$dataFila[3];
$opcion =$dataFila[4];



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `acta_examen_equipo_pedagogico_$cicloLectivo`(`id`, `titulo`, `id_docente`, `obser`) VALUES (null,'$titulo','$docentes','$obser')";	



        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `id`, `titulo`, `id_docente`, `obser` FROM `acta_examen_equipo_pedagogico_$cicloLectivo` ORDER BY `id` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

         foreach($data as $dat) {

          $id=$dat['id'];
          $titulo=$dat['titulo'];
          $id_docente=$dat['id_docente'];
          $obser=$dat['obser'];


                                $docentes_datos='';
                                

                                if ($id_docente!='') {
                       
                    $docente = explode(",", $id_docente);


                    foreach ($docente as $docen) {
                     
                     $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `idDocente`='$docen'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                           foreach($data as $dat) {

                                $nombre=$dat['nombre'];
                                $dni=$dat['dni'];

                                $docentes_datos.=''.$nombre.'; '.$dni.'<br>';
                            }




                     }

                    }

                }


                echo $id.'||'.$titulo.'||'.$docentes_datos.'||'.$obser;


        break;
    case 2: //modificación
        $consulta = "UPDATE `acta_examen_equipo_pedagogico_$cicloLectivo` SET `titulo`='$titulo',`id_docente`='$docentes',`obser`='$obser' WHERE `id`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `id`, `titulo`, `id_docente`, `obser` FROM `acta_examen_equipo_pedagogico_$cicloLectivo` WHERE `id`='$id'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
           foreach($data as $dat) {

          $id=$dat['id'];
          $titulo=$dat['titulo'];
          $id_docente=$dat['id_docente'];
          $obser=$dat['obser'];


                                $docentes_datos='';
                                

                                if ($id_docente!='') {
                       
                    $docente = explode(",", $id_docente);


                    foreach ($docente as $docen) {
                     
                     $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `idDocente`='$docen'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                           foreach($data as $dat) {

                                $nombre=$dat['nombre'];
                                $dni=$dat['dni'];

                                $docentes_datos.=''.$nombre.'; '.$dni.'<br>';
                            }




                     }

                    }

                }


                echo $id.'||'.$titulo.'||'.$docentes_datos.'||'.$obser;
      

        break;        
    case 3://baja
        $consulta = "DELETE FROM `acta_examen_equipo_pedagogico_$cicloLectivo` WHERE `id`='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo 1;
                                
        break;        
}


$conexion = NULL;