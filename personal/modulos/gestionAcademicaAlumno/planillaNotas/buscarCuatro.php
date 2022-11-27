<?php
  
     include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    session_start();
     $cursoSe=$_SESSION['cursoSe'];
                          $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 


$c2onsulta = "SELECT  `inscrip_curso_alumno_$cicloLectivo`.`idIns`  FROM `inscrip_curso_alumno_$cicloLectivo` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idCurso`='$cursoSe'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idIns=$d2at['idIns'];
                }

$cat='';

      $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre`, `plan_datos_asignaturas`.`idAsig` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      foreach($data as $dat) {
        $id_libretaF=$dat['id_libreta'];

         $idAsig=$dat['idAsig'];
        

         $cat.="<option>".$dat['idAsig'].'||'.$dat['nombre']."</option>";

    
}


                  
?>






  <section id="cont_selec_segu" class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">ASIGNATURA</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover4()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

                <select class="form-control" multiple="multiple" data-placeholder="Seleccione las Asignaturas" style="width: 100%;" id="asignatura">

                
                  <?php echo $cat;  ?>
                </select>
               




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





<div id="tablaFiFIFI"></div>


  
<script type="text/javascript">


    $('#asignatura').select2({
    dropdownParent: "#cont_selec_segu",
    theme: "classic", 

});



  $("#asignatura").change(function(){
    asignatura= $('#asignatura').val();
   
  
    
    if (asignatura!='Seleccione la asignatura') {



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
 

        
     
     $.ajax({
          type:"post",
          data:'asignatura=' + asignatura,
          url:'modulos/gestionAcademicaAlumno/planillaNotas/elementos/seccionCursosPPPFFFFF.php',
          success:function(r){
            console.log(r);
        
                    $('#tablaFiFIFI').load('modulos/gestionAcademicaAlumno/planillaNotas/tablaColu.php');
                    
            
             
    


          }
        });

     }else{

   
        $('#tablaFiFIFI').html('');
      

     }

   });







     function remover4 () {

 

        $('#tablaFiFIFI').html('');
   
        $('#cursoSe').val(0);

        



}



 $.unblockUI();
</script>