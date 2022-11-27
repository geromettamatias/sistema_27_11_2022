<?php
session_start();

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$passwordDocente = (isset($_POST['passwordDocente'])) ? $_POST['passwordDocente'] : '';


$password= base64_encode($passwordDocente);
$res=0;

$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes` WHERE `dni`='$dni' AND `passwordDocente`='$password'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
   
     foreach($data as $dat1) {

        $estado = $dat1['estado'];

        if ($estado=='ACTIVO') {
        
                $_SESSION["idUsuario"] = $dat1['idDocente'];
                $_SESSION["dni"] = $dat1['dni'];
                $_SESSION["nombre"] = $dat1['nombre'];
                $_SESSION["cargo"] ='Profesor';
                $_SESSION["nivelCurso"] ='TODOS';
                $_SESSION["operacion"] ='Lectura y Escritura';
                $_SESSION["password"] = $dat1['passwordDocente'];
                $_SESSION["notificaciones_cantidad"] = 0;

                $res=1;



                $email = $dat1['email'];
                $telefono = $dat1['telefono'];
                $nombre = $dat1['nombre'];
                $titulo = $dat1['titulo'];
              




                 $_SESSION["actualizar_datos"] = 'NO';

       if (($email=='SIN DATOS') || ($email=='SIN DATO') || ($email=='NO TIENE') || ($email==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

       if (($telefono=='SIN DATOS') || ($telefono=='SIN DATO') || ($telefono=='NO TIENE') || ($telefono==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

       if (($nombre=='SIN DATOS') || ($nombre=='SIN DATO') || ($nombre=='NO TIENE') || ($nombre==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

       if (($titulo=='SIN DATOS') || ($titulo=='SIN DATO') || ($titulo=='NO TIENE') || ($titulo==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }


                date_default_timezone_set("America/Argentina/Buenos_Aires");

                    $idUsu=$dat1['idDocente'];


        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         
        $fecha= $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;


        $hoy = date("g:i a"); 


        $fecha= $hoy.' // '.$fecha;




        $consulta = "INSERT INTO `ingreso_sistema_docente`(`id_ingreso`, `id_user`, `data`) VALUES (null,'$idUsu','$fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();










                

                echo 3;

        }else{

                $_SESSION["idUsuario"] = null;
                $_SESSION["dni"] = null ;
                $_SESSION["nombre"] = null;
                $_SESSION["cargo"] =null;
                $_SESSION["nivelCurso"] =null;
                $_SESSION["operacion"] =null;
                 $_SESSION["password"]  =null;
                 $_SESSION["notificaciones_cantidad"] =null;

                 $res=0;


                unset($_SESSION["idUsuario"]);
                unset($_SESSION["dni"]);
                unset($_SESSION["nombre"]);
                unset($_SESSION["cargo"]);
                unset($_SESSION["nivelCurso"]);
                unset($_SESSION["operacion"]);
                unset($_SESSION["password"]);
                 unset($_SESSION["notificaciones_cantidad"]);
                session_destroy();


                echo 1;
        }
      
    }

}else{


    $_SESSION["idUsuario"] = null;
    $_SESSION["dni"] = null ;
    $_SESSION["nombre"] = null;
    $_SESSION["cargo"] =null;
    $_SESSION["nivelCurso"] =null;
    $_SESSION["operacion"] =null;
     $_SESSION["password"]  =null;

     $res=0;


    unset($_SESSION["idUsuario"]);
    unset($_SESSION["dni"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["cargo"]);
    unset($_SESSION["nivelCurso"]);
    unset($_SESSION["operacion"]);
    unset($_SESSION["password"]);
    session_destroy();


    $data=null;

     echo 2;
}




if ($res==1) {
    

       $_SESSION["libreta_pregunta"] = 'NO';
       $_SESSION["inscrpcion_pregunta"] = 'NO';
       $_SESSION["ajustes_pregunta"] = 'NO';
       $_SESSION["inasistencia_pregunta"] = 'NO';
       $_SESSION["inasistencia_no_asig_pregunta"] = 'NO';
       $_SESSION["d_j_pregunta"] = 'NO';
     
    

    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {

            $tipo=$dat['tipo'];


            if ($tipo=='LIBRETA DIGITAL') {

                $_SESSION["libreta_pregunta"] = $dat['pregunta'];

            }else if($tipo=='INASISTENCIA NO ASIG'){

                 $_SESSION["inasistencia_no_asig_pregunta"] = $dat['pregunta'];
    
            }else if($tipo=='INCRIPCIÓN A LAS MESAS'){

                 $_SESSION["inscrpcion_pregunta"] = $dat['pregunta'];   

            }else if($tipo=='AJUSTES'){

                 $_SESSION["ajustes_pregunta"] = $dat['pregunta'];

            }else if($tipo=='INASISTENCIA'){

                 $_SESSION["inasistencia_pregunta"] = $dat['pregunta']; 

            }else if($tipo=='GESTIÓN D.J.'){

                 $_SESSION["d_j_pregunta"] = $dat['pregunta'];  
            }
       

        
        }
 
}


$conexion=null;