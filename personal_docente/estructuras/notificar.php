<?php

session_start();
$idUsuario=$_SESSION["idUsuario"];

$id_notificaciones = (isset($_POST['id_notificaciones'])) ? $_POST['id_notificaciones'] : '';

require 'bd/libreria-php-json/json-file-decode.class.php';


$read = new json_file_decode();
$datos_array_docente = $read->json("../../elementos/datos/notificaciones/usuario/datos.json");





$id_notificaciones=intval($id_notificaciones);

$data_final=array();



$read = new json_file_decode();
$json = $read->json("../../elementos/datos/notificaciones/usuario/datos.json");


$cadena = implode($json[0]);
$id_notificaciones_dos=0;
 
if ($cadena!='') {

    foreach ($json as $jsonn) { 
        $id_notificaciones_dos=$jsonn[0];

        if ($id_notificaciones_dos==$id_notificaciones) {

            $data_primer=array();

        
                    array_push($data_primer, $jsonn[0]);
                    array_push($data_primer, $jsonn[1]);
                    array_push($data_primer, $jsonn[2]);
                    array_push($data_primer, $jsonn[3]);
                    array_push($data_primer, $jsonn[4]);
                    array_push($data_primer, $jsonn[5]);
                    array_push($data_primer, $jsonn[6]);

                    $usuarios=$jsonn[7];
                    if ($usuarios=='') {
                        $usuarios.=''.$idUsuario;
                    }else{
                        $usuarios.=','.$idUsuario;
                    }
                    array_push($data_primer, $usuarios);

            array_push($data_final, $data_primer);

        }else{

            array_push($data_final, $jsonn);

        }

       

        
    }
}



    

    $handler = fopen('../../elementos/datos/notificaciones/usuario/datos.json', 'w+');
    $json_arr= json_encode($data_final);
    fwrite($handler, $json_arr);
    fclose($handler);

 



       echo 1;



 ?>
