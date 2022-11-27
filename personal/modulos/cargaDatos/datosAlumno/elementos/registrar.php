<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS 

$insertar='';

$pregunt_incer=0;


$informe='';
session_start();

$plan_estudio=$_SESSION['plan_estudio'];

    foreach ($_FILES as $key => $file) {

        
         $nombre= $file['name'];
         $type = $file['type'];
         $size = $file['size'];
         $archivotmp = $file['tmp_name'];
         
          
    }


$lineas     = file($archivotmp);
$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);


 
          
        $n_legajo= !empty($datos[0])  ? ($datos[0]) : '';
        $n_legajo = trim($n_legajo);
        $n_legajo = utf8_encode($n_legajo);
       
        $dni_alumno= !empty($datos[1])  ? ($datos[1]) : '';
        $dni_alumno = trim($dni_alumno);
        $dni_alumno = utf8_encode($dni_alumno);

        $nombre_Alumno= !empty($datos[2])  ? ($datos[2]) : '';
        $nombre_Alumno = trim($nombre_Alumno);
        $nombre_Alumno = utf8_encode($nombre_Alumno);

        $cuil_alumno= !empty($datos[3])  ? ($datos[3]) : '';
        $cuil_alumno = trim($cuil_alumno);
        $cuil_alumno = utf8_encode($cuil_alumno);

        $domicilio_alumno= !empty($datos[4])  ? ($datos[4]) : '';
        $domicilio_alumno = trim($domicilio_alumno);
        $domicilio_alumno = utf8_encode($domicilio_alumno);

        $email_alumno= !empty($datos[5])  ? ($datos[5]) : '';
        $email_alumno = trim($email_alumno);
        $email_alumno = utf8_encode($email_alumno);

        $telefono_alumno= !empty($datos[6])  ? ($datos[6]) : '';
        $telefono_alumno = trim($telefono_alumno);
        $telefono_alumno = utf8_encode($telefono_alumno);

        $descapacidad_alumno= !empty($datos[7])  ? ($datos[7]) : '';
        $descapacidad_alumno = trim($descapacidad_alumno);
        $descapacidad_alumno = utf8_encode($descapacidad_alumno);

        $fecha_nacimiento= !empty($datos[8])  ? ($datos[8]) : '';
        $fecha_nacimiento = trim($fecha_nacimiento);
        $fecha_nacimiento = utf8_encode($fecha_nacimiento);

        $nacionalidad_alumno= !empty($datos[9])  ? ($datos[9]) : '';
        $nacionalidad_alumno = trim($nacionalidad_alumno);
        $nacionalidad_alumno = utf8_encode($nacionalidad_alumno);

        $procedencia_alumno= !empty($datos[10])  ? ($datos[10]) : '';
        $procedencia_alumno = trim($procedencia_alumno);
        $procedencia_alumno = utf8_encode($procedencia_alumno);

        $dni_tutor= !empty($datos[11])  ? ($datos[11]) : '';
        $dni_tutor = trim($dni_tutor);
        $dni_tutor = utf8_encode($dni_tutor);

        $nombre_tutor= !empty($datos[12])  ? ($datos[12]) : '';
        $nombre_tutor = trim($nombre_tutor);
        $nombre_tutor = utf8_encode($nombre_tutor);

        $telefono_tutor= !empty($datos[13])  ? ($datos[13]) : '';
        $telefono_tutor = trim($telefono_tutor);
        $telefono_tutor = utf8_encode($telefono_tutor);

        $nacionalidad_tutor= !empty($datos[14])  ? ($datos[14]) : '';
        $nacionalidad_tutor = trim($nacionalidad_tutor);
        $nacionalidad_tutor = utf8_encode($nacionalidad_tutor);

        $pas_alumno_sistema= !empty($datos[15])  ? ($datos[15]) : '';
        $pas_alumno_sistema = trim($pas_alumno_sistema);
        $pas_alumno_sistema = utf8_encode($pas_alumno_sistema);
        $pas_alumno_sistema= base64_encode($pas_alumno_sistema);




        $estado= !empty($datos[16])  ? ($datos[16]) : '';
        $estado = trim($estado); //espacio en blanco
        $estado = utf8_encode($estado);

       
   


        if((empty($n_legajo)) || (empty($dni_alumno)) || (empty($nombre_Alumno)) || (empty($cuil_alumno)) || (empty($domicilio_alumno)) || (empty($email_alumno)) || (empty($telefono_alumno)) || (empty($descapacidad_alumno)) || (empty($fecha_nacimiento)) || (empty($nacionalidad_alumno)) || (empty($procedencia_alumno)) || (empty($dni_tutor)) || (empty($nombre_tutor)) || (empty($telefono_tutor)) || (empty($nacionalidad_tutor)) || (empty($pas_alumno_sistema)) || (empty($estado))){

            echo 'Hay columnas o campos imcompletos; fila'.($i+1);
            return false;
        }


        if(($n_legajo=='') || ($dni_alumno=='') || ($nombre_Alumno=='') || ($cuil_alumno=='') || ($domicilio_alumno=='') || ($email_alumno=='') || ($telefono_alumno=='') || ($descapacidad_alumno=='') || ($fecha_nacimiento=='') || ($nacionalidad_alumno=='') || ($procedencia_alumno=='') || ($dni_tutor=='') || ($nombre_tutor=='') || ($telefono_tutor=='') || ($nacionalidad_tutor=='') || ($pas_alumno_sistema=='') || ($estado=='')){

            echo 'Hay campos vacios'.($i+1);
            return false;

        }


        $dni_alumno_cantidad=strlen($dni_alumno);
        if(!($dni_alumno_cantidad==8)){

            echo 'El DNI del alumno esta incompleto (NO debe contener puntos), controle el Excel en la fila (N° de legajo: '.$n_legajo.'; DNI del Alumno: '.$dni_alumno;
            return false;

        }

        $dni_tutor_cantidad=strlen($dni_tutor);
        if(!($dni_tutor_cantidad==8)){

            echo 'El DNI del Tutor esta incompleto (NO debe contener puntos), controle el Excel en la fila (N° de legajo: '.$n_legajo.'; DNI del Alumno: '.$dni_alumno;
            return false;

        }

        $cuil_alumno_cantidad=strlen($cuil_alumno);
        if(!($cuil_alumno_cantidad==13)){

            echo 'El CUIL del Alumno esta incompleto (Ej: 27-32546875-5 , sin puntos), controle el Excel en la fila (N° de legajo: '.$n_legajo.'; DNI del Alumno: '.$dni_alumno;
            return false;

        }


        $cuil_alumno_cantidad=explode("-",$cuil_alumno);
        $cuil_alumno_cantidad=count($cuil_alumno_cantidad);
     
        if(!($cuil_alumno_cantidad==3)){

            echo 'El CUIL del Alumno debe estar conformado por numeros y guines medios (Ej: 27-32546875-5 , sin puntos), controle el Excel en la fila (N° de legajo: '.$n_legajo.'; DNI del Alumno: '.$dni_alumno;
            return false;

        }


        if(($estado!='ACTIVO') && ($estado!='DESACTIVO')){

                echo 'El Estado del Alumno solo puede ser ACTIVO o DESACTIVO, controle el Excel en la fila (N° de legajo: '.$n_legajo.'; DNI del Alumno: '.$dni_alumno;
                return false;
          

        }



            $preguntar=0;

            
            $consulta = "SELECT `idAlumnos` FROM `datosalumnos` WHERE `dniAlumnos`='$dni_alumno'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $dat) {
                $preguntar=1;
            }



            if ($preguntar==1) {
                    
                    $consulta = "UPDATE `datosalumnos` SET `nombreAlumnos`='$nombre_Alumno',`cuilAlumnos`='$cuil_alumno',`domicilioAlumnos`='$domicilio_alumno',`emailAlumnos`='$email_alumno',`telefonoAlumnos`='$telefono_alumno',`discapasidadAlumnos`='$descapacidad_alumno',`nombreTutor`='$nombre_tutor',`dniTutor`='$dni_tutor',`TelefonoTutor`='$telefono_tutor',`fechaNa`='$fecha_nacimiento',`nLegajos`='$n_legajo',`nacido`='$nacionalidad_alumno',`procedencia`='$procedencia_alumno',`nacionalidadTutor`='$nacionalidad_tutor',`pass`='$pas_alumno_sistema',`estado`='$estado' WHERE `dniAlumnos`='$dni_alumno'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();


                    if ($informe=='') {
                        $informe.='<b>Editar el Alumno:</b> '.$nombre_Alumno.'; <b>DNI:</b> '.$dni_alumno;
                    }else{
                        $informe.='<hr><b>Editar el Alumno:</b> '.$nombre_Alumno.'; <b>DNI:</b> '.$dni_alumno;
                    }


            }else if ($preguntar==0) {

                    if ($informe=='') {
                        $informe.='<b>Nuevo Alumno:</b> '.$nombre_Alumno.'; <b>DNI:</b> '.$dni_alumno;
                    }else{
                        $informe.='<hr><b>Nuevo Alumno:</b> '.$nombre_Alumno.'; <b>DNI:</b> '.$dni_alumno;
                    }


                
                    if ($pregunt_incer==0){
                            $insertar.="(null,'".$nombre_Alumno."','".$dni_alumno."','".$cuil_alumno."','".$domicilio_alumno."','".$email_alumno."','".$telefono_alumno."','".$descapacidad_alumno."','".$nombre_tutor."','".$dni_tutor."','".$telefono_tutor."','".$plan_estudio."','".$fecha_nacimiento."','".$n_legajo."','".$nacionalidad_alumno."','".$procedencia_alumno."','".$nacionalidad_tutor."','".$pas_alumno_sistema."','".$estado."')";
                            $pregunt_incer=1;
                    }else{

                            $insertar.=",(null,'".$nombre_Alumno."','".$dni_alumno."','".$cuil_alumno."','".$domicilio_alumno."','".$email_alumno."','".$telefono_alumno."','".$descapacidad_alumno."','".$nombre_tutor."','".$dni_tutor."','".$telefono_tutor."','".$plan_estudio."','".$fecha_nacimiento."','".$n_legajo."','".$nacionalidad_alumno."','".$procedencia_alumno."','".$nacionalidad_tutor."','".$pas_alumno_sistema."','".$estado."')";


                    }
            }


           


        }
        $i++;
}



if ($insertar!='') {

         $consulta = "INSERT INTO `datosalumnos`(`idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio`, `fechaNa`, `nLegajos`, `nacido`, `procedencia`, `nacionalidadTutor`, `pass`, `estado`) VALUES ".$insertar;           
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
}

 echo '<h3>Resultado de Carga</h3>'.$informe;
  
?>