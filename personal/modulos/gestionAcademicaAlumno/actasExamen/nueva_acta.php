<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$operacion=$_SESSION["operacion"];
$buscarTipo=$_SESSION['buscarTipo'];
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


?>



  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-danger">
              
              <div class="card-header">
                <h3 class="card-title">Nuevas Actas</h3>

                <div class="card-tools">
                  <button onclick="regresar_mesas()" type="button" class="btn btn-tool"  title="Regresar lista de Alumno del curso">
                    <i class='fas fa-reply-all'></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="regresar_mesas()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

     
              <div id="cont_dos" class="card-body">
                <div class="chart">


                              <div class="row">

                     <div class="col-md-9">
                        <div class="form-group">
                      <label>Equipo Pedagógico:</label>

                  <div class="input-group">
                  
                     <select class="form-select" id="equipo" >
                             <option value="0">Seleccione el Equipo Pedagógico</option>
                             <?php

                                $c1onsulta = "SELECT `id`, `titulo`, `id_docente`, `obser` FROM `acta_examen_equipo_pedagogico_$cicloLectivo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {
                                ?>
                                <option value="<?php echo $d1at['id'] ?>"><?php echo $d1at['titulo']; ?></option>
                                <?php } ?>
                        </select>

                  </div>

                </div>
        
                </div>


                            <div class="col-md-3">
                        <div class="form-group">
                      <label>Auto Matriculación:</label>

                  <div class="input-group">
                  
                     <select class="form-select" id="matricula" >
                             <option>SI</option>
                             <option>NO</option>
                             
                             
                        </select>

                  </div>

                </div>
        
                </div>

       

              <!-- /.col -->
                <div class="col-md-6">
                        <div class="form-group">
                      <label>FECHA INICIO</label>

                  <div class="input-group">
                  
                     <input class="form-control" type="date" id="fechaActa">

                  </div>

                </div>
        
                </div>

                <div class="col-md-6">
                        <div class="form-group">
                      <label>FECHA CIERRE</label>

                  <div class="input-group">
                  
                     <input class="form-control" type="date" id="fechaActaCierre">

                  </div>

                </div>
        
                </div>
           
             
                <div class="col-md-12">
        
          
                      <label>SELECCIONE LAS ASIGNATURAS</label>

               
                  <select id='asignaturas_ingreso' class="duallistbox" multiple="multiple">
                 


                             <?php

            

                            $c1onsulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` ORDER BY `ciclo`";
                                $r1esultado = $conexion->prepare($c1onsulta);
                                $r1esultado->execute();
                                $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) {

                                         $idAsig = $d1at['idAsig'];
                                         $nombre = $d1at['nombre'];
                                         $ciclo = $d1at['ciclo'];
                                         $idPlan = $d1at['idPlan'];

                               
                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                                 ?>
                                <option value="<?php echo $idAsig; ?>"><?php echo $ciclo.'--'.$nombre.'--'.$idPlan; ?></option>
                                <?php } ?>
        
                  </select>
          
              </div>
                <!-- /.form-group -->
                <hr>
 
           <div class="col-md-12">
                    <div class="form-group">
                      <button class="btn btn-outline-success btn-block" onclick="nuevas_actas()">Register Nuevas Actas</button>
                    </div>
                  </div>

          


              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>

          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

 <script type="text/javascript">


     $('#equipo').select2({
        dropdownParent: "#cont_dos",
        theme: "bootstrap-5",
    });
    $('#equipo').val(0).trigger('change.select2');



$ ( '#asignaturas_ingreso' ). bootstrapDualListbox ({ 
  nonSelectedListLabel : 'No seleccionado' , 
  selectedListLabel : 'Seleccionado' , 
  preserveSelectionOnMove : 'movido' , 
  moveOnSelect : false , 
  nonSelectedFilter : '',
  selectorMinimalHeight: 100, }) ;    


$.unblockUI();
    

function regresar_mesas () {


    
      $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 
 


   
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();



}

function nuevas_actas () { 

           $.blockUI({ 
                message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            } }); 


    equipo= $.trim($("#equipo").val());
    fechaActa = $.trim($("#fechaActa").val());
    fechaActaCierre = $.trim($("#fechaActaCierre").val());
    asignaturas_ingreso=$.trim($("#asignaturas_ingreso").val());

    matricula=$.trim($("#matricula").val());

    if (equipo==0) {
      toastr.warning('No esta seleccionado el Equipo');
      $.unblockUI(); 
      return false;
    }

    if (fechaActa=='') {
      toastr.warning('No esta seleccionado la fecha de Inicio');
      $.unblockUI(); 
      return false;
    }

    if (fechaActaCierre=='') {
      toastr.warning('No esta seleccionado la fecha de Cierre');
      $.unblockUI(); 
      return false;
    }

    if (asignaturas_ingreso=='') {
      toastr.warning('No esta seleccionado la/s signatura/s');
      $.unblockUI(); 
      return false;
    }



    dataFila=[];
    dataFila.push(equipo);
    dataFila.push(fechaActa);
    dataFila.push(fechaActaCierre);
    dataFila.push(asignaturas_ingreso);
    dataFila.push(asignaturas_ingreso);

    dataFila.push(1);




         $.ajax({
            url:"modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
            type: "POST",
            data: {dataFila:dataFila,matricula:matricula},
            success: function(r){

                console.log(r)
            
                if (r==1) {
                   
                    toastr.info('Excelente !!');

                    $('#equipo').val(0).trigger('change.select2');
                    $("#fechaActa").val('')
                    $("#fechaActaCierre").val('')
                    $('#asignaturas_ingreso').val('').trigger('bootstrapDualListbox');


                    $.unblockUI(); 
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });

}


</script>