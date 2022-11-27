<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();

$idAsig_titulo=$_SESSION['idAsig_titulo'];
$tipo_titulo=$_SESSION['tipo_titulo'];
$idPlan_titulo=$_SESSION['idPlan_titulo'];
$ciclo_titulo=$_SESSION['ciclo_titulo'];
$nombreAsignatura_titulo=$_SESSION['nombreAsignatura_titulo'];
$titulo_titulo=$_SESSION['titulo_titulo'];
$fecha_inicio=$_SESSION['fecha_inicio'];

$date_finalizacion = date_create($fecha_inicio);


$fechaMes=date_format($date_finalizacion, 'm');





$fechaAño=date_format($date_finalizacion, 'Y');
                           
$fecha_inicio = date_format($date_finalizacion, 'Y-m-d');




$cicloF=$_SESSION['cicloLectivo'];
$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$id_inscripcion = (isset($_POST['id_inscripcion'])) ? $_POST['id_inscripcion'] : '';
$id_alumnos = (isset($_POST['id_alumnos'])) ? $_POST['id_alumnos'] : '';
$notaEsc = (isset($_POST['notaEsc'])) ? $_POST['notaEsc'] : '';
$notaOral = (isset($_POST['notaOral'])) ? $_POST['notaOral'] : '';
$promNumérico = (isset($_POST['promNumérico'])) ? $_POST['promNumérico'] : '';
$promLetra = (isset($_POST['promLetra'])) ? $_POST['promLetra'] : '';



for ($i=0; $i < count($id_inscripcion); $i++) { 

    $id_inscripcion_0=$id_inscripcion[$i];
    $id_alumnos_0=$id_alumnos[$i];
    $notaEsc_0=$notaEsc[$i];
    $notaOral_0=$notaOral[$i];
    $promNumérico_0=$promNumérico[$i];
    $promLetra_0=$promLetra[$i];
    


    if (($promNumérico_0=='') && ($promLetra_0!='')) {
        $promNumérico_0=1;
    }

    $consulta = "UPDATE `acta_examen_inscrip_$cicloLectivo` SET `notaEsc`='$notaEsc_0',`notaOral`='$notaOral_0',`promNumérico`='$promNumérico_0',`promLetra`='$promLetra_0' WHERE `idInscripcion`='$id_inscripcion_0'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 




    $idAsigPendiente=0;
    $calFinal_1=0;
    $fecha_1=0;
    $calFinal_2=0;
    $fecha_2=0;
    $calFinal_3=0;
    $fecha_3=0;
    $calFinal_4=0;
    $fecha_4=0;
    $calFinal_5=0;
    $fecha_5=0;
    $pregunta=0;
    


       $consulta = "SELECT `idAsigPendiente`, `idAlumno`, `asignaturas`, `calFinal_1`, `fecha_1`, `libro_1`, `folio_1`, `calFinal_2`, `fecha_2`, `libro_2`, `folio_2`, `calFinal_3`, `fecha_3`, `libro_3`, `folio_3`, `calFinal_4`, `fecha_4`, `libro_4`, `folio_4`, `calFinal_5`, `fecha_5`, `libro_5`, `folio_5`, `situacion`, `bloque1`, `bloque2`, `bloque3`, `bloque4`, `bloque5` FROM `asignaturas_pendientes_$cicloLectivo` WHERE `idAlumno`='$id_alumnos_0' AND `asignaturas`='$idAsig_titulo'"; 

        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
         $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $idAsigPendiente=$dat['idAsigPendiente'];
            $calFinal_1=$dat['calFinal_1'];
            $fecha_1=$dat['fecha_1'];
            $calFinal_2=$dat['calFinal_2'];
            $fecha_2=$dat['fecha_2'];
            $calFinal_3=$dat['calFinal_3'];
            $fecha_3=$dat['fecha_3'];
            $calFinal_4=$dat['calFinal_4'];
            $fecha_4=$dat['fecha_4'];
            $calFinal_5=$dat['calFinal_5'];
            $fecha_5=$dat['fecha_5'];

        } 

        if ($idAsigPendiente!=0) {

            if (($calFinal_1=='') && ($calFinal_2=='') && ($calFinal_3=='') && ($calFinal_4=='') && ($calFinal_5==''))  {
                $pregunta=1;
                
            }else{
                if ($fecha_1==$fecha_inicio) {
                    $pregunta=1;
                    
                }else if (($calFinal_2=='') && ($calFinal_3=='') && ($calFinal_4=='') && ($calFinal_5=='')) {
                            $pregunta=2;
                            
                        }else{
                            if ($fecha_2==$fecha_inicio) {
                                $pregunta=2;
                                
                            }else if (($calFinal_3=='') && ($calFinal_4=='') && ($calFinal_5=='')) {
                                        $pregunta=3;
                                        
                                    }else{
                                        if ($fecha_3==$fecha_inicio) {
                                            $pregunta=3;
                                            
                                        }else if (($calFinal_4=='') && ($calFinal_5=='')) {
                                                    $pregunta=4;
                                                    
                                                }else{
                                                    if ($fecha_4==$fecha_inicio) {
                                                        $pregunta=4;
                                                        
                                                    }else if ($calFinal_5=='') {
                                                                $pregunta=5;
                                                                
                                                            }else{
                                                                if ($fecha_5==$fecha_inicio) {
                                                                    $pregunta=5;
                                                                    
                                                                }
                                                            }
                                                }
                                    } 
                        } 
            } 





            if ($pregunta!=0) {
               

                    $consulta = "UPDATE `asignaturas_pendientes_$cicloLectivo` SET `calFinal_$pregunta`='$promNumérico_0',`fecha_$pregunta`='$fecha_inicio',`libro_$pregunta`='SIN-DATOS',`folio_$pregunta`='SIN-DATOS',`bloque$pregunta`='SI' WHERE `idAsigPendiente`='$idAsigPendiente'";           
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(); 
                    
                  
                    

            }






        }




         if ($promNumérico_0>=6) {

                           $nota=$promNumérico_0;



                            if ($nota==10) {
                              $notaEscr='diez';
                            }else if ($nota==9) {
                              $notaEscr='nueve';
                            }else if ($nota==8) {
                              $notaEscr='ocho';
                            }else if ($nota==7) {
                              $notaEscr='siete';
                            }else if ($nota==6) {
                              $notaEscr='seis';
                            }

                            if ($tipo_titulo=='ACTAS- PARA REGULAR') {
                                $condicion='Regular';
                            }else if ($tipo_titulo=='ACTAS- PARA LIBRE') {
                                $condicion='Libre';
                            }else if ($tipo_titulo=='ACTAS- PARA EQUIVALENCIA') {
                                $condicion='Equival.';
                            }else if ($tipo_titulo=='ACTAS- PARA TERMINAL') {
                                $condicion='Terminal';
                            }


                            if ($fechaMes==1) {
                                $fechaMes_F='ENE';
                            }else if ($fechaMes==2) {
                                $fechaMes_F='FEB';
                            }else if ($fechaMes==3) {
                                $fechaMes_F='MAR.';
                            }else if ($fechaMes==4) {
                                $fechaMes_F='ABR';
                            }else if ($fechaMes==5) {
                                $fechaMes_F='MAY';
                            }else if ($fechaMes==6) {
                                $fechaMes_F='JUN';
                            }else if ($fechaMes==7) {
                                $fechaMes_F='JUL';
                            }else if ($fechaMes==8) {
                                $fechaMes_F='AGO';
                            }else if ($fechaMes==9) {
                                $fechaMes_F='SEP';
                            }else if ($fechaMes==10) {
                                $fechaMes_F='OCT';
                            }else if ($fechaMes==11) {
                                $fechaMes_F='NOV';
                            }else if ($fechaMes==12) {
                                $fechaMes_F='DIC';
                            }


                
                           $establecimiento='Este Establecimiento';
                          


                        
                        $consulta = "UPDATE `analitico` SET `nota`='$nota', `notaEscr`='$notaEscr', `fechaMes`='$fechaMes_F', `fechaAño`='$fechaAño', `condicion`='$condicion', `establecimiento`='$establecimiento' WHERE `idAsig`='$idAsig_titulo' and `idAlumno`='$id_alumnos_0' ";

                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(); 



                    }else{

                         $consulta = "UPDATE `analitico` SET `nota`='', `notaEscr`='', `fechaMes`='', `fechaAño`='', `condicion`='', `establecimiento`='' WHERE `idAsig`='$idAsig_titulo' and `idAlumno`='$id_alumnos_0' ";

                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(); 




                    }


                    echo 1;      
        

}





$conexion = NULL;