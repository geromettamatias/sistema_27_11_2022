

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Datos del Estudiante</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button  type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">

                  <h3>Datos Personales</h3>
                  

             <?php  

              include_once '../../bd/conexion.php';
              $objeto = new Conexion();
              $conexion = $objeto->Conectar();

              session_start();
        

         
                $s_usuarioEstudiante=$_SESSION["s_usuarioEstudiante"];


                      $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `domicilioAlumnos`, `emailAlumnos`, `telefonoAlumnos`, `discapasidadAlumnos`, `nombreTutor`, `dniTutor`, `TelefonoTutor`, `idPlanEstudio` FROM `datosalumnos` WHERE `dniAlumnos`='$s_usuarioEstudiante'";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach($d1ata as $d1at) { 

                                    $nombreAlumnos=$d1at['nombreAlumnos'];
                                    $dniAlumnos=$d1at['dniAlumnos'];
                                    $cuilAlumnos=$d1at['cuilAlumnos'];
                                    $domicilioAlumnos=$d1at['domicilioAlumnos'];
                                    $emailAlumnos=$d1at['emailAlumnos'];
                                    $telefonoAlumnos=$d1at['telefonoAlumnos'];
                                    $nombreTutor=$d1at['nombreTutor'];
                                    $dniTutor=$d1at['dniTutor'];
                                    $TelefonoTutor=$d1at['TelefonoTutor'];
                                   
                                }

                                echo '<p>Estudiante: '.$nombreAlumnos.'; DNI: '.$dniAlumnos.'; CUIL: '.$cuilAlumnos.'<br>Email: '.$emailAlumnos.'; TEL: '.$telefonoAlumnos.'<br>Domicilio: '.$domicilioAlumnos.'<br>Tutor: '.$nombreTutor.'; DNI: '.$dniTutor.'; TEL: '.$TelefonoTutor;




        ?>    
                
                <hr>

                <h3>Publicaciones</h3>

                <div id="anunciosLeer" ></div>


                <script type="text/javascript">
  anuncioDocente();

function anuncioDocente() {


  
        $.ajax({
        url: "modulos/extras/inicio/elementos/anuncioLeerAlumno.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            info = data.anuncio.informe;
           

            
            $("#anunciosLeer").html(info);
            

                  
        }        
    });
}






</script>

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







