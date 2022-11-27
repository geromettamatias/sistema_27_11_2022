
<?php

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


session_start();

 
$id_usuario=$_SESSION['idUsuario'];
$operacion=$_SESSION["operacion"];

$res='';


 if (($operacion=='Lectura y Escritura') || ($_SESSION['cargo'] == 'Administrador')){ 

$consulta2 = "SELECT `id_calendario`, `nombre`, `color`, `id_usuario` FROM `auto_calendario`";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
    foreach($dat1a2 as $da1t2) { 
          $id_calendario=$da1t2['id_calendario'];
          $nombre=$da1t2['nombre'];
          $color=$da1t2['color'];
      
         $res.='<div id="boton_'.$id_calendario.'" class="external-event ui-draggable ui-draggable-handle" style="background-color: '.$color.'; border-color: '.$color.'; color: rgb(255, 255, 255); position: relative;">'.$nombre.'</div>';

    }



}else{


$consulta2 = "SELECT `id_calendario`, `nombre`, `color`, `id_usuario` FROM `auto_calendario` WHERE `id_usuario`='$id_usuario'";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
    foreach($dat1a2 as $da1t2) { 
          $id_calendario=$da1t2['id_calendario'];
          $nombre=$da1t2['nombre'];
          $color=$da1t2['color'];
      
         $res.='<div id="boton_'.$id_calendario.'" class="external-event ui-draggable ui-draggable-handle" style="background-color: '.$color.'; border-color: '.$color.'; color: rgb(255, 255, 255); position: relative;">'.$nombre.'</div>';

    }


}

echo $res;


?>

