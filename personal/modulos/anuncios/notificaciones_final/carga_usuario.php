           <label>SELECCIONE LOS USUARIOS</label>

           <select id='usuario_id_carga_d' class="duallistbox" multiple="multiple">

                    
                  

           <?php

           include_once '../../bd/conexion.php';
            $objeto = new Conexion();
            $conexion = $objeto->Conectar();
            session_start();

            $persona_destino=$_SESSION["persona_destino"];

            $id_persona_destino=$_SESSION["id_persona_destino"];


            $id_persona_dest = explode(",", $id_persona_destino);

        


            if ($persona_destino=='Docentes') {
                 

                 $consulta2 = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos`, `estado` FROM `datos_docentes`";
                  $resultado2 = $conexion->prepare($consulta2);
                  $resultado2->execute();
                  $dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a2 as $da1t2) { 

                    $idDocente=$da1t2['idDocente'];
                    $dni=$da1t2['dni'];
                    $nombre=$da1t2['nombre'];


                      $select='';
                   foreach ($id_persona_dest as $id_persona_d) {

                      if ($id_persona_d==$idDocente) {
                         $select='selected';
                      }
                      
                    }

                   

                    echo "<option value='".$idDocente."' ".$select.">".$dni."||".$nombre."</option>";
                 
                    }


            }else if ($persona_destino=='Personales') {
                  

                  $consulta2 = "SELECT `idUsu`, `cargo`, `nombre`, `dni`, `correo`, `nivelCurso`, `operacion`, `pass` FROM `personal_eet16`";
                  $resultado2 = $conexion->prepare($consulta2);
                  $resultado2->execute();
                  $dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a2 as $da1t2) { 

                    $idUsu=$da1t2['idUsu'];
                    $dni=$da1t2['dni'];
                    $nombre=$da1t2['nombre'];
                    $cargo=$da1t2['cargo'];


                       $select='';
                   foreach ($id_persona_dest as $id_persona_d) {

                      if ($id_persona_d==$idUsu) {
                         $select='selected';
                      }
                      
                    }

                   

                    echo "<option value='".$idUsu."' ".$select.">".$cargo."||".$dni."||".$nombre."</option>";
                 
                    }


            }else if ($persona_destino=='Estudiantes') {
                    

                    $consulta2 = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos` FROM `datosalumnos`";
                  $resultado2 = $conexion->prepare($consulta2);
                  $resultado2->execute();
                  $dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a2 as $da1t2) { 

                    $idAlumnos=$da1t2['idAlumnos'];
                    $dniAlumnos=$da1t2['dniAlumnos'];
                    $nombreAlumnos=$da1t2['nombreAlumnos'];
           
                            $select='';
                   foreach ($id_persona_dest as $id_persona_d) {

                      if ($id_persona_d==$idAlumnos) {
                         $select='selected';
                      }
                      
                    }

                   

                    echo "<option value='".$idAlumnos."' ".$select.">".$dniAlumnos."||".$nombreAlumnos."</option>";
                 
                    }


            } 


            

    
                





                        ?>

                  

                  </select>



 <script type="text/javascript">
$.unblockUI();



   $ ( '.duallistbox' ). bootstrapDualListbox ({ 
  nonSelectedListLabel : 'No seleccionado' , 
  selectedListLabel : 'Seleccionado' , 
  preserveSelectionOnMove : 'movido' , 
  moveOnSelect : false, 
  nonSelectedFilter : '',
  preserveSelectionOnMove : 'all',
 
  selectorMinimalHeight: 400, }) ;  







</script>                 