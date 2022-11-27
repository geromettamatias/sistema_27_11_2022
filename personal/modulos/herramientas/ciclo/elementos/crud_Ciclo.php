
<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
$ejecucion='';
$dataFila = (isset($_POST['dataFila'])) ? $_POST['dataFila'] : '';

$id_ciclo = $dataFila[0];
$ciclo =$dataFila[1];
$edicion =$dataFila[2];
$ciclo_Copiar =$dataFila[3]; 
$opcion =$dataFila[4];


$pregunta=0;

if ($opcion!=3) {

$c1onsulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` WHERE `ciclo`='$ciclo'";
$r1esultado = $conexion->prepare($c1onsulta);
$r1esultado->execute();
$d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
foreach($d1ata as $d1at) {

    $pregunta =1;

}

}

if ($pregunta==0) {
  



switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `ciclo_lectivo`(`id_ciclo`, `ciclo`, `edicion`) VALUES (null,'$ciclo','$edicion')";			
     
$ejecucion.=$consulta;

if ($ciclo_Copiar!='NO COPIAR(NUEVA BASE DE DATO)') {
    
   // Copia bd Inscripcion curso

        $consulta = "CREATE TABLE `eet16_db`.`inscrip_curso_alumno_$ciclo` SELECT * FROM `inscrip_curso_alumno_$ciclo_Copiar`";
        
        $ejecucion.=';'.$consulta;

        $consulta = "ALTER TABLE `inscrip_curso_alumno_$ciclo` CHANGE `idIns` `idIns` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idIns`)";
        


        $ejecucion.=';'.$consulta;



     // Copia bd libreta digital


        $consulta = "CREATE TABLE `eet16_db`.`libreta_digital_$ciclo` SELECT `id_libreta`, `idIns`, `idAsig` FROM `libreta_digital_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `libreta_digital_$ciclo` CHANGE `id_libreta` `id_libreta` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_libreta`)";
        


        $ejecucion.=';'.$consulta;



    // Copia bd copia Cursos

        $consulta = "CREATE TABLE `eet16_db`.`curso_$ciclo` SELECT * FROM `curso_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `curso_$ciclo` CHANGE `idCurso` `idCurso` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idCurso`)";
        


        $ejecucion.=';'.$consulta;



    // copia bd designacion


          $consulta = "CREATE TABLE `eet16_db`.`descripasig_$ciclo` SELECT * FROM `descripasig_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `descripasig_$ciclo` CHANGE `idDescrip` `idDescrip` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idDescrip`)";
        


        $ejecucion.=';'.$consulta;





    // copia designaciones docentes

        $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_$ciclo` SELECT * FROM `asignacion_asignatura_docente_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



    $consulta = "ALTER TABLE `asignacion_asignatura_docente_$ciclo` CHANGE `idAsig` `idAsig` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idAsig`)";
        


        $ejecucion.=';'.$consulta;





        $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_cargo_$ciclo` SELECT * FROM `asignacion_asignatura_docente_cargo_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



    $consulta = "ALTER TABLE `asignacion_asignatura_docente_cargo_$ciclo` CHANGE `id_asig_cargo` `id_asig_cargo` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_asig_cargo`)";
        


        $ejecucion.=';'.$consulta;





         $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_proyecto_$ciclo` SELECT * FROM `asignacion_asignatura_docente_proyecto_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `asignacion_asignatura_docente_proyecto_$ciclo` CHANGE `id_asig_proyecto` `id_asig_proyecto` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_asig_proyecto`)";
        


        $ejecucion.=';'.$consulta;




      // Copia Datos de la ficha del alumno


         $consulta = "CREATE TABLE `eet16_db`.`datosficha_$ciclo` SELECT * FROM `datosficha_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `datosficha_$ciclo` CHANGE `idDatoExtraFicha` `idDatoExtraFicha` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idDatoExtraFicha`)";
        


        $ejecucion.=';'.$consulta;



    // Copia de Datos Asignatura pendiente

             $consulta = "CREATE TABLE `eet16_db`.`asignaturas_pendientes_$ciclo` SELECT * FROM `asignaturas_pendientes_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `asignaturas_pendientes_$ciclo` CHANGE `idAsigPendiente` `idAsigPendiente` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idAsigPendiente`)";
        


        $ejecucion.=';'.$consulta;




    // copiar informe


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_$ciclo` SELECT * FROM `confi_informe_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `confi_informe_$ciclo` CHANGE `id_informe` `id_informe` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_informe`)";
        


        $ejecucion.=';'.$consulta;





        // copiar informe pagina 2


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_2_$ciclo` SELECT * FROM `confi_informe_2_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `confi_informe_2_$ciclo` CHANGE `id_informe` `id_informe` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_informe`)";
        


        $ejecucion.=';'.$consulta;




        // copiar informe titulo


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_$ciclo` SELECT * FROM `confi_informe_titulo_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `confi_informe_titulo_$ciclo` CHANGE `id_titulo` `id_titulo` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_titulo`)";
        


        $ejecucion.=';'.$consulta;







        // copiar informe titulo 2 pagina


          $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_2_$ciclo` SELECT * FROM `confi_informe_titulo_2_$ciclo_Copiar`";
        


        $ejecucion.=';'.$consulta;



        $consulta = "ALTER TABLE `confi_informe_titulo_2_$ciclo` CHANGE `id_titulo` `id_titulo` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_titulo`)";
        


        $ejecucion.=';'.$consulta;








    //  Examen datos


          $consulta = "CREATE TABLE `eet16_db`.`actas_examen_datos_$ciclo` SELECT * FROM `actas_examen_datos_$ciclo_Copiar`";
        

         $sentencia.=';'.$consulta;


        $consulta = "ALTER TABLE `actas_examen_datos_$ciclo` CHANGE `idActa` `idActa` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idActa`)";
        

         $sentencia.=';'.$consulta;


    //  Examen Inscrip


          $consulta = "CREATE TABLE `eet16_db`.`acta_examen_inscrip_$ciclo` SELECT * FROM `acta_examen_inscrip_$ciclo_Copiar`";
        

         $sentencia.=';'.$consulta;


        $consulta = "ALTER TABLE `acta_examen_inscrip_$ciclo` CHANGE `idInscripcion` `idInscripcion` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idInscripcion`)";
        

         $sentencia.=';'.$consulta;



    //  Equipo Pedagogico


          $consulta = "CREATE TABLE `eet16_db`.`acta_examen_equipo_pedagogico_$ciclo` SELECT * FROM `acta_examen_equipo_pedagogico_$ciclo_Copiar`";
        

         $sentencia.=';'.$consulta;


        $consulta = "ALTER TABLE `acta_examen_equipo_pedagogico_$ciclo` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`)";
        

         $sentencia.=';'.$consulta;




         //  nombre de secciones de las asignaturas


          $consulta = "CREATE TABLE `eet16_db`.`nombres_secciones_asig_$ciclo` SELECT * FROM `nombres_secciones_asig_$ciclo_Copiar`";
        

         $sentencia.=';'.$consulta;


        $consulta = "ALTER TABLE `nombres_secciones_asig_$ciclo` CHANGE `id_seccion` `id_seccion` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_seccion`)";
        

         $sentencia.=';'.$consulta;


         //  secciones de las asignaturas


          $consulta = "CREATE TABLE `eet16_db`.`secciones_asignaturas_$ciclo` SELECT * FROM `secciones_asignaturas_$ciclo_Copiar`";
        

         $sentencia.=';'.$consulta;


        $consulta = "ALTER TABLE `secciones_asignaturas_$ciclo` CHANGE `id_nota_seccion` `id_nota_seccion` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id_nota_seccion`)";
        

         $sentencia.=';'.$consulta;



}else{



     // secciones de las asignaturas

    $consulta = "CREATE TABLE `eet16_db`.`secciones_asignaturas_$ciclo` (`id_nota_seccion` INT NULL AUTO_INCREMENT , `id_alumno` TEXT NOT NULL , `columnar` TEXT NOT NULL , PRIMARY KEY (`id_nota_seccion`))";
        
    $sentencia.=';'.$consulta;



    //  nombre de secciones de las asignaturas

    $consulta = "CREATE TABLE `eet16_db`.`nombres_secciones_asig_$ciclo` (`id_seccion` INT NOT NULL AUTO_INCREMENT , `asignatura` TEXT NOT NULL , `nombre_seccion` TEXT NOT NULL , `id_profesores` TEXT NOT NULL , `periodo` TEXT NOT NULL , `obs` TEXT NOT NULL , `id_curso` TEXT NOT NULL , PRIMARY KEY (`id_seccion`))";
        
    $sentencia.=';'.$consulta;



    // Equipo Pedagogico

    $consulta = "CREATE TABLE `eet16_db`.`acta_examen_equipo_pedagogico_$ciclo` (`id` INT NOT NULL AUTO_INCREMENT , `titulo` TEXT NOT NULL , `id_docente` TEXT NOT NULL , `obser` TEXT NOT NULL , PRIMARY KEY (`id`))";
        
    $sentencia.=';'.$consulta;

    //  Examen Inscrip

     $consulta = "CREATE TABLE `eet16_db`.`acta_examen_inscrip_$ciclo` ( `idInscripcion` INT NULL AUTO_INCREMENT , `idActa` TEXT NOT NULL,`idAlumno` TEXT NOT NULL,`notaEsc` TEXT NOT NULL,`notaOral` TEXT NOT NULL,`promNumérico` TEXT NOT NULL,`promLetra` TEXT NOT NULL, PRIMARY KEY (`idInscripcion`))";
        
        $sentencia.=';'.$consulta;


     //  Examen datos

     $consulta = "CREATE TABLE `eet16_db`.`actas_examen_datos_$ciclo` ( `idActa` INT NULL AUTO_INCREMENT , `tipo` TEXT NOT NULL,`idAsignatura` TEXT NOT NULL,`precentacion` TEXT NOT NULL,`id_equipo` TEXT NOT NULL,`finalizacion` TEXT NOT NULL,`edicion_docente` TEXT NOT NULL, PRIMARY KEY (`idActa`))";
        
        $sentencia.=';'.$consulta;




    //  config informe titulo

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_$ciclo` ( `id_titulo` INT NULL AUTO_INCREMENT , `tituloGenera` TEXT NOT NULL, PRIMARY KEY (`id_titulo`))";
        


        $ejecucion.=';'.$consulta;




        //  config informe titulo

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_titulo_2_$ciclo` ( `id_titulo` INT NULL AUTO_INCREMENT , `tituloGenera` TEXT NOT NULL, PRIMARY KEY (`id_titulo`))";
        


        $ejecucion.=';'.$consulta;





    //  config informe 

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_$ciclo` ( `id_informe` INT NULL AUTO_INCREMENT , `tipo` TEXT NOT NULL,`titulo` TEXT NOT NULL,`pregunta` TEXT NOT NULL,`aclaracion` TEXT NOT NULL,`respuestas_posible` TEXT NOT NULL,`modalidad` TEXT NOT NULL,`id_titologeneral` TEXT NOT NULL, PRIMARY KEY (`id_informe`))";
        


        $ejecucion.=';'.$consulta;





//  config informe 2 hoja

     $consulta = "CREATE TABLE `eet16_db`.`confi_informe_2_$ciclo` ( `id_informe` INT NULL AUTO_INCREMENT , `tipo` TEXT NOT NULL,`titulo` TEXT NOT NULL,`pregunta` TEXT NOT NULL,`aclaracion` TEXT NOT NULL,`respuestas_posible` TEXT NOT NULL,`modalidad` TEXT NOT NULL,`id_titologeneral` TEXT NOT NULL, PRIMARY KEY (`id_informe`))";
        


        $ejecucion.=';'.$consulta;





    // Nueva bd Inscripcion curso
        
        $consulta = "CREATE TABLE `eet16_db`.`inscrip_curso_alumno_$ciclo` ( `idIns` INT NULL AUTO_INCREMENT , `idCurso` TEXT NOT NULL , `idAlumno` TEXT NOT NULL , PRIMARY KEY (`idIns`))";
        


        $ejecucion.=';'.$consulta;



    // Nueva bd libreta digital

        $consulta = "CREATE TABLE `eet16_db`.`libreta_digital_$ciclo` ( `id_libreta` INT NULL AUTO_INCREMENT , `idIns` TEXT NOT NULL , `idAsig` TEXT NOT NULL , PRIMARY KEY (`id_libreta`))";
        


        $ejecucion.=';'.$consulta;




     // Nueva bd copia Cursos

         $consulta = "CREATE TABLE `eet16_db`.`curso_$ciclo` ( `idCurso` INT NULL AUTO_INCREMENT , `idPlan` TEXT NOT NULL , `ciclo` TEXT NOT NULL , `nombre` TEXT NOT NULL , PRIMARY KEY (`idCurso`))";
        


        $ejecucion.=';'.$consulta;



     // Nueva bd designacion

           $consulta = "CREATE TABLE `eet16_db`.`descripasig_$ciclo` (
          `idDescrip` int(11) NOT NULL AUTO_INCREMENT,
          `idAsignatura` text NOT NULL,
          `dia` text NOT NULL,
          `horario` text NOT NULL,
          `ciclo` text NOT NULL,
          `corresponde` text NOT NULL,
          `curso` text NOT NULL,
          `idCurso` text NOT NULL, PRIMARY KEY (`idDescrip`))";
                

                $ejecucion.=';'.$consulta;

    // Nueva  asgnaciones docentes



         $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_$ciclo` ( `idAsig` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `idCurso` TEXT NOT NULL , `idAsignatura` TEXT NOT NULL, `situacion` TEXT NOT NULL, `desde` TEXT NOT NULL, `hasta` TEXT NOT NULL , `obserbaci` TEXT NOT NULL , PRIMARY KEY (`idAsig`))";
        


        $ejecucion.=';'.$consulta;



        $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_cargo_$ciclo` ( `id_asig_cargo` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `cargo` TEXT NOT NULL , `situacion` TEXT NOT NULL , `desde` TEXT NOT NULL , `hasta` TEXT NOT NULL , `lunes` TEXT NOT NULL , `martes` TEXT NOT NULL , `miercoles` TEXT NOT NULL , `jueves` TEXT NOT NULL , `viernes` TEXT NOT NULL , PRIMARY KEY (`id_asig_cargo`))";
            $ejecucion.=';'.$consulta;


            $consulta = "CREATE TABLE `eet16_db`.`asignacion_asignatura_docente_proyecto_$ciclo` ( `id_asig_proyecto` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `cHoras` TEXT NOT NULL , `situacion` TEXT NOT NULL , `desde` TEXT NOT NULL , `hasta` TEXT NOT NULL , `lunes` TEXT NOT NULL , `martes` TEXT NOT NULL , `miercoles` TEXT NOT NULL , `jueves` TEXT NOT NULL , `viernes` TEXT NOT NULL , `licencia` TEXT NOT NULL , PRIMARY KEY (`id_asig_proyecto`))";
            $ejecucion.=';'.$consulta;

        // Nueva Datos de la ficha del alumno

            $consulta = "CREATE TABLE `eet16_db`.`datosficha_$ciclo` ( `idDatoExtraFicha` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `Libro` TEXT NOT NULL , `Folio` TEXT NOT NULL , `auxiliar` TEXT NOT NULL , `piePagina` TEXT NOT NULL , PRIMARY KEY (`idDatoExtraFicha`))";
        


        $ejecucion.=';'.$consulta;




        // Nueva Datos de Asignaturas pendientes

         $consulta = "CREATE TABLE `eet16_db`.`asignaturas_pendientes_$ciclo` ( `idAsigPendiente` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `asignaturas` TEXT NOT NULL , `calFinal_1` TEXT NOT NULL , `fecha_1` TEXT NOT NULL , `libro_1` TEXT NOT NULL , `folio_1` TEXT NOT NULL, `calFinal_2` TEXT NOT NULL , `fecha_2` TEXT NOT NULL , `libro_2` TEXT NOT NULL , `folio_2` TEXT NOT NULL, `calFinal_3` TEXT NOT NULL , `fecha_3` TEXT NOT NULL , `libro_3` TEXT NOT NULL , `folio_3` TEXT NOT NULL, `calFinal_4` TEXT NOT NULL , `fecha_4` TEXT NOT NULL , `libro_4` TEXT NOT NULL , `folio_4` TEXT NOT NULL, `calFinal_5` TEXT NOT NULL , `fecha_5` TEXT NOT NULL , `libro_5` TEXT NOT NULL , `folio_5` TEXT NOT NULL, `situacion` TEXT NOT NULL, `bloque1` TEXT NOT NULL, `bloque2` TEXT NOT NULL, `bloque3` TEXT NOT NULL, `bloque4` TEXT NOT NULL, `bloque5` TEXT NOT NULL , PRIMARY KEY (`idAsigPendiente`))";
        


        $ejecucion.=';'.$consulta;


        

        }  


        // Nueva bd cabezado


        $consulta = "CREATE TABLE `eet16_db`.`cabezera_libreta_digital_$ciclo` ( `idCabezera` INT NULL AUTO_INCREMENT , `nombre` TEXT NOT NULL , `descri` TEXT NOT NULL , `editarDocente` TEXT NOT NULL , `corresponde` TEXT NOT NULL , `tipo` TEXT NOT NULL , PRIMARY KEY (`idCabezera`))";
                

                $ejecucion.=';'.$consulta;

        //  Nueva base asistencia


    
              
        $consulta = "CREATE TABLE `eet16_db`.`asistenciaalumno_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `fecha` TEXT NOT NULL , `cantidad` TEXT NOT NULL , `justificado` TEXT NOT NULL , `observacion` TEXT NOT NULL , `encabezado` TEXT NOT NULL  , PRIMARY KEY (`id_Asistencia`))";
        
        $ejecucion.=';'.$consulta;


        //  asistencia Docente HC

        $consulta = "CREATE TABLE `eet16_db`.`asistenciadocente_$ciclo` ( `id_Asistencia` INT NULL AUTO_INCREMENT , `idDocente` TEXT NOT NULL , `idCurso` TEXT NOT NULL , `idAsignatura` TEXT NOT NULL , `idParte` TEXT NOT NULL , `fecha` TEXT NOT NULL , `estado` TEXT NOT NULL , `horario` TEXT NOT NULL , PRIMARY KEY (`id_Asistencia`))";
        
        $ejecucion.=';'.$consulta;

        //  asistencia Docente Cargo

        $consulta = "CREATE TABLE `eet16_db`.`asistenciadocente_cargo_$ciclo` (
          `id_Asistencia` int(11) NOT NULL AUTO_INCREMENT,
          `idDocente` text NOT NULL,
          `cargo` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `idParte` text NOT NULL,
          `fecha` text NOT NULL,
          `estado` text NOT NULL,
          PRIMARY KEY (`id_Asistencia`))";
        
        $ejecucion.=';'.$consulta;

        //  asistencia Docente horas Proyecto

        $consulta = "CREATE TABLE `eet16_db`.`asistenciadocente_proyecto_$ciclo` (
          `id_Asistencia` int(11) NOT NULL AUTO_INCREMENT,
          `idDocente` text NOT NULL,
          `choras` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `idParte` text NOT NULL,
          `fecha` text NOT NULL,
          `estado` text NOT NULL,
          PRIMARY KEY (`id_Asistencia`))";
        
        $ejecucion.=';'.$consulta;


      


        //  Datos Libreta
            
        $consulta = "CREATE TABLE `eet16_db`.`datoslibreta_$ciclo` ( `idDatosFicha` INT NULL AUTO_INCREMENT , `idAlumno` TEXT NOT NULL , `promovido` TEXT NOT NULL , `ob` TEXT NOT NULL , `lugarFecha` TEXT NOT NULL , PRIMARY KEY (`idDatosFicha`))";
        
        $ejecucion.=';'.$consulta;

        //  Datos Licencia hs
            
        $consulta = "CREATE TABLE `eet16_db`.`asistencia_licencia_permisos_$ciclo` (
          `id_asistenciaLicenciaPermiso` INT NULL AUTO_INCREMENT ,
          `idDocente` text NOT NULL,
          `sexo` text NOT NULL,
          `codigoCargo` text NOT NULL,
          `DescripcionCargo` text NOT NULL,
          `idCurso` text NOT NULL,
          `Turno` text NOT NULL,
          `CantidadHora` text NOT NULL,
          `idAsignatura` text NOT NULL,
          `situacionRevista` text NOT NULL,
          `codigoLicencia` text NOT NULL,
          `articuloLicencia` text NOT NULL,
          `descripcionLicencia` text NOT NULL,
          `codigoPermiso` text NOT NULL,
          `articuloPermiso` text NOT NULL,
          `descripcionPermiso` text NOT NULL,
          `codigoInasistencia` text NOT NULL,
          `articuloInasistencia` text NOT NULL,
          `descripcionInasistencia` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `fechaInasistencia` text NOT NULL,
          `horario` text NOT NULL, PRIMARY KEY (`id_asistenciaLicenciaPermiso`))";
        
        $ejecucion.=';'.$consulta;

        //  Datos Licencia Cargo

        $consulta = "CREATE TABLE `eet16_db`.`asistencia_licencia_permisos_cargos_$ciclo` (
          `id_asistenciaLicenciaPermiso` INT NULL AUTO_INCREMENT ,
          `idDocente` text NOT NULL,
          `sexo` text NOT NULL,
          `codigoCargo` text NOT NULL,
          `DescripcionCargo` text NOT NULL,
          `cargo` text NOT NULL,
          `Turno` text NOT NULL,
          `CantidadHora` text NOT NULL,
          `situacionRevista` text NOT NULL,
          `codigoLicencia` text NOT NULL,
          `articuloLicencia` text NOT NULL,
          `descripcionLicencia` text NOT NULL,
          `codigoPermiso` text NOT NULL,
          `articuloPermiso` text NOT NULL,
          `descripcionPermiso` text NOT NULL,
          `codigoInasistencia` text NOT NULL,
          `articuloInasistencia` text NOT NULL,
          `descripcionInasistencia` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `fechaInasistencia` text NOT NULL,
          `horario` text NOT NULL, PRIMARY KEY (`id_asistenciaLicenciaPermiso`))";
        
        $ejecucion.=';'.$consulta;

        //  Datos Licencia Horas Proyecto

          $consulta = "CREATE TABLE `eet16_db`.`asistencia_licencia_permisos_proyecto_$ciclo` (
          `id_asistenciaLicenciaPermiso` INT NULL AUTO_INCREMENT ,
          `idDocente` text NOT NULL,
          `sexo` text NOT NULL,
          `codigoCargo` text NOT NULL,
          `DescripcionCargo` text NOT NULL,
          `cargo` text NOT NULL,
          `Turno` text NOT NULL,
          `CantidadHora` text NOT NULL,
          `situacionRevista` text NOT NULL,
          `codigoLicencia` text NOT NULL,
          `articuloLicencia` text NOT NULL,
          `descripcionLicencia` text NOT NULL,
          `codigoPermiso` text NOT NULL,
          `articuloPermiso` text NOT NULL,
          `descripcionPermiso` text NOT NULL,
          `codigoInasistencia` text NOT NULL,
          `articuloInasistencia` text NOT NULL,
          `descripcionInasistencia` text NOT NULL,
          `situacion` text NOT NULL,
          `desde` text NOT NULL,
          `hasta` text NOT NULL,
          `fechaInasistencia` text NOT NULL,
          `horario` text NOT NULL, PRIMARY KEY (`id_asistenciaLicenciaPermiso`))";
        
        $ejecucion.=';'.$consulta;

         $resultado = $conexion->prepare($ejecucion);
        $resultado->execute();




    $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `id_ciclo` DESC LIMIT 1";
        


        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        break;

       
    case 3://baja

      

    
         $consulta = "DELETE FROM `ciclo_lectivo` WHERE `id_ciclo`='$id_ciclo';DROP TABLE `confi_informe_2_$ciclo`,`confi_informe_titulo_2_$ciclo`,`confi_informe_titulo_$ciclo`,`confi_informe_$ciclo`,`inscrip_curso_alumno_$ciclo`, `libreta_digital_$ciclo`,`cabezera_libreta_digital_$ciclo`,`curso_$ciclo`,`asignacion_asignatura_docente_$ciclo`,`datosficha_$ciclo`,`asignaturas_pendientes_$ciclo`,`asistenciadocente_$ciclo`,`asistenciaalumno_$ciclo`,`datoslibreta_$ciclo`,`asistencia_licencia_permisos_$ciclo`,`descripasig_$ciclo`,`asignacion_asignatura_docente_cargo_$ciclo`,`asistencia_licencia_permisos_cargos_$ciclo`,`asignacion_asignatura_docente_proyecto_$ciclo`,`asistenciadocente_cargo_$ciclo`,`asistenciadocente_proyecto_$ciclo`,`asistencia_licencia_permisos_proyecto_$ciclo`,`acta_examen_equipo_pedagogico_$ciclo`,`acta_examen_inscrip_$ciclo`,`actas_examen_datos_$ciclo`,`secciones_asignaturas_$ciclo`,`nombres_secciones_asig_$ciclo`"; 


        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

     
        echo 1;


        break;        
}


 



}else{

    echo 0;
}
$conexion = NULL;





