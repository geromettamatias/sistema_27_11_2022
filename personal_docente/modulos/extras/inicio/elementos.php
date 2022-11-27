

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-primary">
              
              <div class="card-header">
                <h3 class="card-title">INFORMACIÓN</h3>

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

                  <h2>Datos Personales:</h2>
                  
                    <div id="infoPersonal"></div>
                
                    <hr><hr>

                    <h2>Publicaciones:</h2>

                     <div id="anunciosLeer"></div>




<script type="text/javascript">
  anuncioDocente();


  datosPersonal();


function anuncioDocente() {


  
        $.ajax({
        url: "modulos/extras/inicio/elementos/anuncioLeerDocente.php",
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




function datosPersonal() {


  
        $.ajax({
        url: "estructuras/bd/datosDocente.php",
        type: "POST",
        dataType: "json",
        data: {},
         success: function(data){  
            

            idDocente = data[0].idDocente;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            domicilio = data[0].domicilio;
            email = data[0].email;
            telefono = data[0].telefono;
            titulo = data[0].titulo;


            $("#infoPersonal").html('<b>USUARIO: </b>'+nombre+'; <b>DNI: </b>'+dni+'<br><b>Domicilio: </b>'+domicilio+'<br><b>Correo: </b>'+email+'; <b>Telefono: </b>'+telefono+'<br><b>Titulo: </b>'+titulo);
            

                  
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







