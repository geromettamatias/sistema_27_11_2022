<?php

session_start();

$idUsuario=$_SESSION["idUsuario"];
$id_mensaje_buscar = (isset($_POST['id_mensaje'])) ? $_POST['id_mensaje'] : '';
$id_mensaje_buscar = intval($id_mensaje_buscar);


$referencia='';

require 'bd/libreria-php-json/json-file-decode.class.php';


$read = new json_file_decode();
$datos_array_docente = $read->json("../../elementos/datos/notificaciones/usuario/datos.json");
$referencia='0||0||0';

$cadena = implode($datos_array_docente[0]);

if ($cadena!='') {
    foreach ($datos_array_docente as $datos_array_docente_1) {



            $id_mensaje=$datos_array_docente_1[0];
           
            if ($id_mensaje_buscar==$id_mensaje) {
                $referencia=$datos_array_docente_1[0].'||'.$datos_array_docente_1[5].'||'.$datos_array_docente_1[6];
            }


    }
}



  echo $referencia;





 ?>