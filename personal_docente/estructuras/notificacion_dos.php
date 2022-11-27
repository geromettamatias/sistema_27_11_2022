<?php

session_start();

$idUsuario=$_SESSION["idUsuario"];


$notificaciones_cantidad=$_SESSION["notificaciones_cantidad"];
$cantidad_notificacion=0;
$referencia='';

require 'bd/libreria-php-json/json-file-decode.class.php';


$read = new json_file_decode();
$datos_array_docente = $read->json("../../elementos/datos/notificaciones/usuario/datos.json");


$cadena = implode($datos_array_docente[0]);

if ($cadena!='') {
    foreach ($datos_array_docente as $datos_array_docente_1) {



            $id_mensaje=$datos_array_docente_1[0];
           
            $usuario_destino=$datos_array_docente_1[3];
            
            $id_usuario_destino=$datos_array_docente_1[4];
            $id_usuario_destino_1 = explode(",", $id_usuario_destino);
            $pregunta_destino=0;

            $id_usuario_destino_verificacion=$datos_array_docente_1[7];
            $id_usuario_destino_verificacion_1 = explode(",", $id_usuario_destino_verificacion);
            // print json_encode($datos_array_docente_1);
            $pregunta_destino_verificacion=0;

            if ($usuario_destino=='Docentes') {
             

                  foreach ($id_usuario_destino_1 as $id_usuario_dest) {
                      
                      if ($id_usuario_dest==$idUsuario) {
                         $pregunta_destino=1;
                          
                      }
                  }


                     foreach ($id_usuario_destino_verificacion_1 as $id_usuario_destino_verifi) {
                        
                        if ($id_usuario_destino_verifi==$idUsuario) {
                           $pregunta_destino_verificacion=1;
                        }
                      }
                  

                  

                  if (($pregunta_destino==1) && ($pregunta_destino_verificacion==0)) {

                   
                    $referencia=$datos_array_docente_1[0].'||'.$datos_array_docente_1[5].'||'.$datos_array_docente_1[6];
                    
                    
                    $cantidad_notificacion++;
                  }


            }
 

    }
}


if ($notificaciones_cantidad!=$cantidad_notificacion) {
  // $_SESSION["notificaciones_cantidad"]=$cantidad_notificacion;
  

  echo $referencia;


}else{
  echo 0;
}



 ?>
