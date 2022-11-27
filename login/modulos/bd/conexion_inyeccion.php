<?php
$hostname='localhost';
$database='eet16_db';
$username='eet16sql';
$password='ESCUELA16';

$conexion=new mysqli($hostname,$username,$password,$database);
if($conexion->connect_errno){
    echo "El sitio web está experimentado problemas";
}
?>