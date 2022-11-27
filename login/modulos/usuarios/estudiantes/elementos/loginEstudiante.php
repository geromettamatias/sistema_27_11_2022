<?php
session_start();

include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$password = (isset($_POST['pass'])) ? $_POST['pass'] : '';
$pass= base64_encode($password);



$consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass`, `estado` FROM `datosalumnos` WHERE `dniAlumnos`='$dni' AND `pass`='$pass'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuarioEstudiante"] = $dni;
    $_SESSION["cargo"] = 'Estudiante';

     $_SESSION["notificaciones_cantidad"] = 0;




    foreach($data as $dat1) {  

        $_SESSION["password"] = $dat1['pass'];

       $emailAlumnos = $dat1['emailAlumnos'];
       $cuilAlumnos = $dat1['cuilAlumnos'];
       $domicilioAlumnos = $dat1['domicilioAlumnos'];
       $telefonoAlumnos = $dat1['telefonoAlumnos'];
  
       $_SESSION["actualizar_datos"] = 'NO';

       if (($emailAlumnos=='SIN DATOS') || ($emailAlumnos=='SIN DATO') || ($emailAlumnos=='NO TIENE') || ($emailAlumnos==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

       if (($cuilAlumnos=='SIN DATOS') || ($cuilAlumnos=='SIN DATO') || ($cuilAlumnos=='NO TIENE') || ($cuilAlumnos==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

       if (($domicilioAlumnos=='SIN DATOS') || ($domicilioAlumnos=='SIN DATO') || ($domicilioAlumnos=='NO TIENE') || ($domicilioAlumnos==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

       if (($telefonoAlumnos=='SIN DATOS') || ($telefonoAlumnos=='SIN DATO') || ($telefonoAlumnos=='NO TIENE') || ($telefonoAlumnos==null)) {

            $_SESSION["actualizar_datos"] = 'SI';
           
       }

  
 


       

       $estado = $dat1['estado'];

        if ($estado=='ACTIVO') {


    
        $_SESSION["cuilAlumnos"] = $dat1['cuilAlumnos'];



        date_default_timezone_set("America/Argentina/Buenos_Aires");

            $idUsu=$dat1['idAlumnos'];

            $_SESSION["idUsuario"] = $idUsu;


        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         
        $fecha= $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;


         $hoy = date("g:i a"); 



        $fecha= $hoy.' // '.$fecha;




        $consulta = "INSERT INTO `ingreso_sistema_alumno`(`id_ingreso`, `id_user`, `data`) VALUES (null,'$idUsu','$fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        $res=1; 


    }else{
       
       $_SESSION["s_usuarioEstudiante"] = null;
       $_SESSION["idUsuario"] = null;
       $_SESSION["password"] = null;

        $_SESSION["notificaciones_cantidad"] = null;
       $res=3; 
            
    }    
    }
    


            
}else{
    $_SESSION["s_usuarioEstudiante"] = null;
    $_SESSION["notificaciones_cantidad"] = null;
     $_SESSION["idUsuario"] = null;
     $_SESSION["password"] = null;
    $res=2;
}








if ($res==1) {
    

       $_SESSION["libreta_pregunta"] = 'NO';
     $_SESSION["analitico_pregunta"] = 'NO';
     $_SESSION["inscrpcion_pregunta"] = 'NO';
     $_SESSION["ajustes_pregunta"] = 'NO';
     $_SESSION["inasistencia_pregunta"] = 'NO';

   

    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `usuario`='ALUMNO'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {

            $tipo=$dat['tipo'];


            if ($tipo=='LIBRETA DIGITAL') {

                $_SESSION["libreta_pregunta"] = $dat['pregunta'];

            }else if($tipo=='ANALITICO'){

                 $_SESSION["analitico_pregunta"] = $dat['pregunta'];
    
            }else if($tipo=='INCRIPCIÓN A LAS MESAS'){

                 $_SESSION["inscrpcion_pregunta"] = $dat['pregunta'];   

            }else if($tipo=='AJUSTES'){

                 $_SESSION["ajustes_pregunta"] = $dat['pregunta'];

            }else if($tipo=='INASISTENCIA'){

                 $_SESSION["inasistencia_pregunta"] = $dat['pregunta'];  
            }
       

        
        }
 
}

print json_encode($res);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo