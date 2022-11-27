<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();
require '../../../bd/libreria-php-json/json-file-decode.class.php';


$idUsuario=$_SESSION["idUsuario"];
$cargo=$_SESSION["cargo"];



$id_notificaciones=$_SESSION["id_notificaciones"];
$opcion=$_SESSION["opcion"];


$persona_destino = (isset($_POST['persona_destino'])) ? $_POST['persona_destino'] : '';
$asunto_data = (isset($_POST['asunto_data'])) ? $_POST['asunto_data'] : '';
$usuario_id_carga = (isset($_POST['usuario_id_carga'])) ? $_POST['usuario_id_carga'] : '';
$test_data = (isset($_POST['test_data'])) ? $_POST['test_data'] : '';


switch($opcion){
    case 1: 


$ultimo_numero=0;

$data_final=array();

$data_primer=array();


    $read = new json_file_decode();
    $json = $read->json("../../../../../elementos/datos/notificaciones/usuario/datos.json");


    $cadena = implode($json[0]);
    
    if ($cadena!='') {

        foreach ($json as $jsonn) { 
            array_push($data_final, $jsonn);

            foreach ($jsonn as $jsonnn) { 
                $ultimo_numero=$jsonn[0];
            }
        }
    }

    $ultimo_numero++;
    array_push($data_primer, $ultimo_numero);
    array_push($data_primer, $cargo);
    array_push($data_primer, $idUsuario);
    array_push($data_primer, $persona_destino);
    array_push($data_primer, $usuario_id_carga);
    array_push($data_primer, $asunto_data);
    array_push($data_primer, $test_data);
    array_push($data_primer, '');



    array_push($data_final, $data_primer);
    

    $handler = fopen('../../../../../elementos/datos/notificaciones/usuario/datos.json', 'w+');
    $json_arr= json_encode($data_final);
    fwrite($handler, $json_arr);
    fclose($handler);

 



       echo 1;

        break;
    case 2: //modificación
       



$ultimo_numero=intval($id_notificaciones);

$data_final=array();
$data_primer=array();


array_push($data_primer, $ultimo_numero);
array_push($data_primer, $cargo);
array_push($data_primer, $idUsuario);
array_push($data_primer, $persona_destino);
array_push($data_primer, $usuario_id_carga);
array_push($data_primer, $asunto_data);
array_push($data_primer, $test_data);
array_push($data_primer, '');




$read = new json_file_decode();
$json = $read->json("../../../../../elementos/datos/notificaciones/usuario/datos.json");


$cadena = implode($json[0]);
$id_notificaciones_dos=0;
 
if ($cadena!='') {

    foreach ($json as $jsonn) { 
        $id_notificaciones_dos=$jsonn[0];

        if ($id_notificaciones_dos==$id_notificaciones) {
            
            array_push($data_final, $data_primer);

        }else{

            array_push($data_final, $jsonn);

        }

       

        
    }
}



    

    $handler = fopen('../../../../../elementos/datos/notificaciones/usuario/datos.json', 'w+');
    $json_arr= json_encode($data_final);
    fwrite($handler, $json_arr);
    fclose($handler);

 



       echo 1;


        break;        
      
}


$conexion = NULL;          
                  