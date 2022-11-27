
<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        session_start();

$operacion=$_SESSION["operacion"];



        $consulta = "SELECT `idAlumnos`, `nombreAlumnos`, `dniAlumnos`, `cuilAlumnos`, `nLegajos`, `pass`, `estado` FROM `datosalumnos`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>



  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">LISTA ALUMNOS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">



<h1>CARGA DE ALUMNO</h1>
                  

             <?php if ($operacion=='Lectura y Escritura'){ ?>

                <button class="btn btn-success" title="CAMBIAR DE ESTADO" onclick="cargamaxiba()"><i class="fas fa-sync fa-spin"></i> CARGAR ALUMNO POR EXCEL (FORMATO: CSV DELIMITADO POR COMAS) </button>

                <hr>

                    <button class="btn btn-info" title="NUEVO ALUMNO" onclick="Agregar()"><i class='fas fa-user-plus'></i> NUEVO ALUMNO</button>
<button class="btn btn-danger" title="EDITAR/ELIMINAR" onclick="editarEliminar()"><i class="fas fa-cog fa-spin"></i> EDITAR/ELIMINAR</button>
<hr>

<button class="btn btn-warning" title="CAMBIAR DE ESTADO" onclick="estadoCambiar()"><i class="fas fa-sync fa-spin"></i> CAMBIAR DE ESTADO</button>



<?php } ?>



<button class="btn btn-info" title="CARGA HORAS/CARGOS" onclick="datos_alumnos()"><i class="fas fa-paperclip"></i>DATOS DEL ALUMNO</button>

<hr>

<div class="table-responsive">
    <table id="tabla_Administradores" class="table table display" style="width:100%">
    <thead>
        <tr>
             <th>N°</th>
             <th>ESTADO</th>
             <th>DNI</th>
             <th>CUIL</th>
             <th>NºLEGAJO</th>
             <th>ALUMNO/A</th>
             <th>CONTRASEÑA</th>  

        </tr>
    </thead>
     <tbody>
        <?php  
         foreach($data as $dat) {
        ?>
        <tr>
            <td><?php echo $dat['idAlumnos'] ?></td>
            <td><?php 

                $estado=$dat['estado'];

                if ($estado=='DESACTIVO') {
                    echo '<font color="red">DESACTIVO</font>';
                }else if($estado=='ACTIVO'){

                    echo '<font color="green">ACTIVO</font>';

                }


                ?></td>
            <td><?php echo $dat['dniAlumnos'] ?></td>
            <td><?php echo $dat['cuilAlumnos'] ?></td>
            <td><?php echo $dat['nLegajos'] ?></td>
            <td><?php echo $dat['nombreAlumnos'] ?></td>
            <td><?php echo base64_decode ($dat['pass']); ?></td>
           
        </tr>
        <?php } ?>
    </tbody>        
    <tfoot>
        <tr>
             <th>N°</th>
             <th>ESTADO</th>
             <th>DNI</th>
             <th>CUIL</th>
             <th>NºLEGAJO</th>
             <th>ALUMNO/A</th>
             <th>CONTRASEÑA</th>
        </tr>
    </tfoot>
</table>

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

 <?php if ($operacion=='Lectura y Escritura'){ ?>


<div class="modal fade bd-example-modal-xl" id="modalCRUD_DOCENTE" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="idAlumnos" hidden='' >
                <input type="text" class="form-control" id="opcion" hidden=''>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                
                                <label for="estado" class="col-form-label">Estado:</label>

                                <select class="form-control" id="estado">
                                    <option>ACTIVO</option>
                                    <option>DESACTIVO</option>
                                </select>

                            </div>

                            <div class="col-md-4">
                                
                                <label for="dniAlumnos" class="col-form-label">DNI:</label>

                                    <div class="input-group mb-3">
                                      <input id="dniAlumnos" type="text" class="form-control" data-inputmask='"mask": "99999999"' data-mask>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-address-card"></span>
                                        </div>
                                      </div>
                                    </div>

                            </div>

                            <div class="col-md-4">
                                
                                <label for="cuilAlumnos" class="col-form-label">CUIL:</label>

                                    <div class="input-group mb-3">
                                      <input id="cuilAlumnos" type="text" class="form-control" data-inputmask='"mask": "99-99999999-9"' data-mask>
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-address-card"></span>
                                        </div>
                                      </div>
                                    </div>

                            </div>
                          
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                
                                <label for="nLegajos" class="col-form-label">Nº Legajo:</label>

                                <input type="number" class="form-control" id="nLegajos">

                            </div>

                            <div class="col-md-4">
                                
                                <label for="nombreAlumnos" class="col-form-label">Alumno:</label>
                                <input type="text" class="form-control" id="nombreAlumnos">

                            </div>

                            <div class="col-md-4">
                                
                               
                                
                                
                                <div class="input-group-append claveVer">

                                    <label for="pass" class="col-form-label">Contraseña: </label>
                                    <div  class="input-group-text">
                                      <span class="fa fa-eye icon cambio"></span>
                                    </div>
                                  </div>

                                  
                        
                                
                                  <input id="pass" type="password" class="form-control" placeholder="Contraseña" required>

                               
                                
                               
                               
                               

                            </div>
                          
                        </div>

                        <hr>
             




                    </div>


  
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>




  <?php } ?>



   
<script type="text/javascript">

$.unblockUI();
$('#imagenProceso').hide();
$('#cargaCiclo').hide();






$('[data-mask]').inputmask()



function mostrarContrasena(){
      var tipo = document.getElementById("pass");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

$( ".claveVer" ).mouseup(function() {

    $(".cambio").removeClass("fa fa-eye-slash icon");
    $(".cambio").addClass("fa fa-eye icon");
    mostrarContrasena();
  }).mousedown(function() {
    $(".cambio").removeClass("fa fa-eye icon");
    $(".cambio").addClass("fa fa-eye-slash icon");
    mostrarContrasena();
  });











    var myTable = $('#tabla_Administradores').DataTable({
        "destroy":true, 
        "pageLength" : 25,  
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
                 "sProcessing":"Procesando...",
            },
            //para usar los botones   
            responsive: "true",
            dom: 'Bfrtilp',       
            buttons:[ 
          {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'
          },
        ]         
        });




var selector=0;
var dataFila=[];
var preguntar=0;

//  selecciono particular o grupal, agrego en un array 

$('#tabla_Administradores tbody').on('click', 'tr', function () {



            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                preguntar=0;
            }else{
                myTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                preguntar=1;
            }
   
            dataFila = myTable.row( this ).data();

console.log(myTable.rows( '.selected' )[0][0]);

} );














  <?php if ($operacion=='Lectura y Escritura'){ ?>



function estadoCambiar(){


    if (preguntar==1) {



   

idAlumnos=dataFila[0];
estado=dataFila[1];
dniAlumnos=dataFila[2];
cuilAlumnos=dataFila[3];
nLegajos=dataFila[4];
nombreAlumnos=dataFila[5];
pass=dataFila[6];

 

        if (estado=='<font color="red">DESACTIVO</font>') {
            estado='<font color="green">ACTIVO</font>';
            estadoF='ACTIVO';
            
        }else if(estado=='<font color="green">ACTIVO</font>'){
            estado='<font color="red">DESACTIVO</font>';
            estadoF='DESACTIVO';
        }


         dataFila=[];
                        dataFila.push(idAlumnos);
                        dataFila.push(estado);
                        dataFila.push(dniAlumnos);
                        dataFila.push(cuilAlumnos);
                        dataFila.push(nLegajos);
                        dataFila.push(nombreAlumnos);
                        dataFila.push(pass);

 

                numero= myTable.rows( '.selected' )[0][0];


               

                myTable.row(":eq("+numero+")").data([idAlumnos,estado,dniAlumnos,cuilAlumnos,nLegajos,nombreAlumnos,pass]);

            
        $.ajax({
            url: "modulos/cargaDatos/datosAlumno/elementos/cambiarEstado.php",
            type: "POST",
            data: {idAlumnos:idAlumnos,estado:estadoF},
               success: function(data){ 

               console.log(data); 
           
            toastr.info('Excelente !!');
            $.unblockUI();   
        } 
        });





    }else{

        toastr.warning('No selecciono ninguno');

    }

}






function editarEliminar(){


    if (preguntar==1) {

  Swal.fire({
          title: 'QUE DESEA HACER CON EL USUARIO?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'EDITAR',
          denyButtonText: `ELIMINAR`,
        }).then((result) => {
          
          if (result.isConfirmed) {

                editar_FINAL();


          } else if (result.isDenied) {

                eliminar_FINAL();
          }
        })


    }else{

        toastr.warning('No selecciono ninguno');

    }

}



function editar_FINAL () {


$("#idAlumnos").val(dataFila[0]);

estado=dataFila[1];



if (estado=='DESACTIVO') {
    estadoF = '<font color="red">DESACTIVO</font>';
    
}else if(estado=='ACTIVO'){

    estadoF = '<font color="green">ACTIVO</font>';
}
                  


$("#dniAlumnos").val(dataFila[2]);
$("#cuilAlumnos").val(dataFila[3]);
$("#nLegajos").val(dataFila[4]);
$("#nombreAlumnos").val(dataFila[5]);
$("#pass").val(dataFila[6]);

$("#opcion").val(2);
    

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar datos del docente");            
    $("#modalCRUD_DOCENTE").modal("show");  


}

function eliminar_FINAL(){

    Swal.fire({
  title: 'Esta seguro',
  text: "Está seguro de eliminar este Alumno/a (Se perderá los datos del Alumno/a, Libretas, Asistencia, etc.) todos los datos…",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar toda la información del alumno'
        }).then((result) => {
          if (result.isConfirmed) {
            eliminar_FINAL_2();


          }
        })




}



function eliminar_FINAL_2() {


Swal.fire({
      title: 'Contraseña para eliminar alumno',
      html:'<div class="col-12"><input type="text" class="form-control" id="contra"></div><br><p>Aclaración: Se borrara todas los datos del alumno/a</p></div>', 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  contra = document.getElementById('contra').value,
                        
                 
                 eliminar_FINAL_3(contra);

                                  
                }
        });



}



function eliminar_FINAL_3(contra){


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




idAlumnos=dataFila[0];
estado=dataFila[1];
dniAlumnos=dataFila[2];
cuilAlumnos=dataFila[3];
nLegajos=dataFila[4];
nombreAlumnos=dataFila[5];
pass=dataFila[6];

 

        if (estado=='<font color="red">DESACTIVO</font>') {
            estado='<font color="green">ACTIVO</font>';
            estadoF='ACTIVO';
            
        }else if(estado=='<font color="green">ACTIVO</font>'){
            estado='<font color="red">DESACTIVO</font>';
            estadoF='DESACTIVO';
        }


        dataFila=[];
        dataFila.push(idAlumnos);
        dataFila.push(estado);
        dataFila.push(dniAlumnos);
        dataFila.push(cuilAlumnos);
        dataFila.push(nLegajos);
        dataFila.push(nombreAlumnos);
        dataFila.push(pass);
        dataFila.push(3);
        dataFila.push(contra);          
        console.log(dataFila)
        
        $.ajax({
            url: "modulos/cargaDatos/datosAlumno/elementos/crud_datos_Plan_Alumnos.php",
            type: "POST",
            data: {dataFila:dataFila},
            success: function(r){

                console.log(r);
            
                if (r==1) {
                    myTable.rows('.selected').remove().draw();
                    toastr.info('Excelente, Se elimino el Alumno definitivamente !!');
                    $.unblockUI(); 
                }else if (r==0) {
                    toastr.warning('Contraseña de Verificación incorrecta');
                    $.unblockUI(); 
                }else{
                     toastr.error('Problema con el servidor');
                    $.unblockUI(); 
                }
               
            }
        });

        



}






function Agregar () {


$("#dniAlumnos").val('');
$("#cuilAlumnos").val('');
$("#nLegajos").val('');
$("#nombreAlumnos").val('');
$("#pass").val('');



    
    $(".modal-header").css("background-color", "#FF33E9");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar datos del ALUMNO"); 
    $("#idAlumnos").val(null);
    $("#opcion").val(1);
    $("#modalCRUD_DOCENTE").modal("show"); 



}





function agregar_editar () {
            

           $("#modalCRUD_DOCENTE").modal("hide"); 

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



idAlumnos=$("#idAlumnos").val();
estado=$("#estado").val();
dniAlumnos=$("#dniAlumnos").val();
cuilAlumnos=$("#cuilAlumnos").val();
nLegajos=$("#nLegajos").val();
nombreAlumnos=$("#nombreAlumnos").val();
pass=$("#pass").val();

opcion= $("#opcion").val();





    dataFila=[];
    dataFila.push(idAlumnos);
    dataFila.push(estado);
    dataFila.push(dniAlumnos);
    dataFila.push(cuilAlumnos);
    dataFila.push(nLegajos);
    dataFila.push(nombreAlumnos);
    dataFila.push(pass);

    dataFila.push(opcion);

    console.log(dataFila)

    $.ajax({
        url: "modulos/cargaDatos/datosAlumno/elementos/crud_datos_Plan_Alumnos.php",
        type: "POST",
        dataType: "json",
        data: {dataFila:dataFila},
        success: function(data){  
            console.log(data);
            idAlumnos = data[0].idAlumnos;            
            estado = data[0].estado;
            dniAlumnos = data[0].dniAlumnos;
            cuilAlumnos = data[0].cuilAlumnos;
            nLegajos = data[0].nLegajos;
            nombreAlumnos = data[0].nombreAlumnos;
            
            pass = data[0].pass;
            pass=atob(pass);

         
 

                  

                        if (estado=='DESACTIVO') {
                            estadoF = '<font color="red">DESACTIVO</font>';

                        }else if(estado=='ACTIVO'){

                            estadoF = '<font color="green">ACTIVO</font>';
                        }


                          dataFila=[];
                            dataFila.push(idAlumnos);
                            dataFila.push(estadoF);
                            dataFila.push(dniAlumnos);
                            dataFila.push(cuilAlumnos);
                            dataFila.push(nLegajos);
                            dataFila.push(nombreAlumnos);
                            dataFila.push(pass);

                  
   
            if (opcion==1) {
                myTable.row.add([idAlumnos,estadoF,dniAlumnos,cuilAlumnos,nLegajos,nombreAlumnos,pass]).draw();
            }else{

                // myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
                // saber el numero de fila
                numero= myTable.rows( '.selected' )[0][0]

                myTable.row(":eq("+numero+")").data([idAlumnos,estadoF,dniAlumnos,cuilAlumnos,nLegajos,nombreAlumnos,pass]);

            }

            
            toastr.info('Excelente !!');
            $.unblockUI();   
        }        
    });

}



 function cargamaxiba(){

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



        $('#contenidoCursos').html('');     
        $('#buscarTablaInstitucional').load('modulos/cargaDatos/datosAlumno/buscar_plan_excel.php');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').html('');
        $('#imagenProceso').hide();


 }




 <?php } ?>




function datos_alumnos(){



    if (preguntar==1) {


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




        idAlumnos=dataFila[0];  
           
   $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos,
          url:'modulos/cargaDatos/datosAlumno/elementos/seccionAlumno.php',
          success:function(r){ 

              if (r==1) {

                 $('#contenidoCursos').html('');
                $('#tablaInstitucional').html('');
                
                $('#buscarTablaInstitucional').html('');
                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').load('modulos/cargaDatos/datosAlumno/alumnos_datos.php');
                 $('#imagenProceso').hide();

              }else{
                toastr.warning('Problema de Servidor, comunicarse con el administrador');
                 $.unblockUI();
              }


      }
        });





    }else{

        toastr.warning('No selecciono ninguno');

    }

}






</script>



