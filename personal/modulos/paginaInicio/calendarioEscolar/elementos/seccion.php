<?php
 
session_start();

$datos_fin = (isset($_POST['datos_fin'])) ? $_POST['datos_fin'] : '';

$_SESSION["datos_fin"]=$datos_fin;

$ciclo_lect = (isset($_POST['ciclo_lect'])) ? $_POST['ciclo_lect'] : '';

$_SESSION["ciclo_lect"]=$ciclo_lect;


echo 1;

?>
