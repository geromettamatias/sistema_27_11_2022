<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
require '../../../bd/libreria-php-json/json-file-decode.class.php';


$id_notificaciones = (isset($_POST['id_notificaciones'])) ? $_POST['id_notificaciones'] : '';
$id_notificaciones=intval($id_notificaciones);

$data_final=array();
$data_final_emerg=array();
$cantidad=0;

$read = new json_file_decode();
$json = $read->json("../../../../../elementos/datos/notificaciones/usuario/datos.json");
$cadena = implode($json[0]);

 $id_notificaciones_dos=0;
if ($cadena!='') {

    foreach ($json as $jsonn) { 
        $id_notificaciones_dos=$jsonn[0];

        if ($id_notificaciones_dos!=$id_notificaciones) {
            
            array_push($data_final, $jsonn);
            $cantidad++;

        }      
    }
}

if ($cantidad==0) {
	array_push($data_final, $data_final_emerg);
}

    

    $handler = fopen('../../../../../elementos/datos/notificaciones/usuario/datos.json', 'w+');
    $json_arr= json_encode($data_final);
    fwrite($handler, $json_arr);
    fclose($handler);

 



       echo 1;


$conexion = NULL;          
                          
                  