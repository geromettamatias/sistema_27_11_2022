<?php

include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$cicloLectivo=date("Y");

$array_precentacion= array();
$array_finalizacion= array();


$idActa='';
$ciclo='';
$idPlan='';
$nombreAsignatura='';
$precentacion='';
$finalizacion='';
$titulo='';
$tipo='';

$fecha_comparacion_inicio='';
$fecha_comparacion_cierre='';
$asignaturas='';
$contador=0;




$consulta2 = "SELECT DISTINCT `actas_examen_datos_$cicloLectivo`.`precentacion`, `actas_examen_datos_$cicloLectivo`.`finalizacion` FROM `actas_examen_datos_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `actas_examen_datos_$cicloLectivo`.`idAsignatura` INNER JOIN `acta_examen_equipo_pedagogico_$cicloLectivo` ON `acta_examen_equipo_pedagogico_$cicloLectivo`.`id` = `actas_examen_datos_$cicloLectivo`.`id_equipo`";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
    foreach($dat1a2 as $da1t2) {

        
            $precentacion=$da1t2['precentacion'];
            $finalizacion=$da1t2['finalizacion'];




                      array_push($array_precentacion, $precentacion);
                      array_push($array_finalizacion, $finalizacion);
                      
      



          }

    
    
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agenda Institucional <?php echo $cicloLectivo; ?> <button onclick="recargar()" type="button" class="btn btn-tool">
                    <i class="fas fa-reply"></i> Recargar
                  </button>


                </h1>
          </div>
          <div class="col-sm-6">
          

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Eventos arrastrables</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">

                    <div id="arrastables"></div>


                    
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        Remover
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Crear evento</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Titulo del Evento">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Agregar</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title


        }


        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))



    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

   

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');


   



    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {

     
        return {
          title: eventEl.innerText,
         


          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };





      }
    });




    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay',

      },
    locale: 'es',
    themeSystem: 'bootstrap',


events:[ <?php 


$consulta2 = "SELECT `id_calendario`, `allDay`, `date`, `innerHTML`, `background_color`, `color_fin`, `id_usuario` FROM `calendario_ins`";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$dat1a2=$resultado2->fetchAll(PDO::FETCH_ASSOC);


 foreach($dat1a2 as $da1t2) { 


?>
   {

                                id: '<?php echo $da1t2['id_calendario']; ?>',
                                title          : '<?php echo $da1t2['innerHTML']; ?>',
                                start          : new Date('<?php echo $da1t2['date']; ?>'),

                                backgroundColor: '<?php echo $da1t2['background_color']; ?>', //red
                                borderColor    : '<?php echo $da1t2['background_color']; ?>', //red
                                allDay         : <?php echo $da1t2['allDay']; ?>, //Primary (light-blue)
                                
                               
                              },

                            <?php   


            
          

  } 


   


     for ($i=0; $i < count($array_precentacion); $i++) {    

            

              $precentacion_1 = $array_precentacion[$i];
              $precentacion_2 = explode("-", $precentacion_1);
              $precentacion_2_ciclo=$precentacion_2[0];
              $precentacion_2_mes=$precentacion_2[1];
              $precentacion_2_dia=$precentacion_2[2];

              $precentacion_2_mes=intval($precentacion_2_mes);
              $precentacion_2_mes=$precentacion_2_mes-1;
              $precentacion_2_dia=intval($precentacion_2_dia);


              $finalizacion_1 = $array_finalizacion[$i];
              $finalizacion_2 = explode("-", $finalizacion_1);
              $finalizacion_2_ciclo=$finalizacion_2[0];
              $finalizacion_2_mes=$finalizacion_2[1];
              $finalizacion_2_dia=$finalizacion_2[2];


              $finalizacion_2_mes=intval($finalizacion_2_mes);
              $finalizacion_2_mes=$finalizacion_2_mes-1;
              $finalizacion_2_dia=intval($finalizacion_2_dia);

               
               
               ?>



        {
          
          title          : 'Periodo de intensificación',
          start          : new Date(<?php  echo $precentacion_2_ciclo;  ?>, <?php  echo $precentacion_2_mes;  ?>, <?php  echo $precentacion_2_dia;  ?>, 6, 0),
          end            : new Date(<?php  echo $finalizacion_2_ciclo;  ?>, <?php  echo $finalizacion_2_mes;  ?>, <?php  echo $finalizacion_2_dia;  ?>, 7, 0),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },

        <?php } ?>











      ],


  

      editable  : false,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list

            id=info.draggedEl.id;

        

                $.ajax({
                        type:"post",
                        data:{id:id},
                        url:'modulos/paginaInicio/calendarioEscolar/elementos/botones_calendarios_remover_dos.php',
                        success:function(r){
                            console.log(r)
                          if (r==1) {
                              toastr.info('Se elimino el evento !!');
                           
                          }else if (r==0) {
                              toastr.warning('Usted no puede eliminar');
                           
                          }else{
                              toastr.info('Error de sistema !!');
                          
                          } 
                          

                        }
                      });



          info.draggedEl.parentNode.removeChild(info.draggedEl);


          
          
        }

        

        

        miCadena=info.draggedEl.outerHTML


              divisiones = miCadena.split("border-color: ",2);
              miCadena_dos=divisiones[1];
              divisiones = miCadena_dos.split("; position:",2);
              miCadena_tres=divisiones[0];
              divisiones = miCadena_tres.split(";",2);

              color=divisiones[1];
              color_dos = color.split(": ");



              //primer color
              background_color=divisiones[0];
              //segundo color
              color_fin=color_dos[1];




        //console.log(info)


        // cuando ajendamos un nuevo evento

        //si es dia o no
        console.log(info.allDay)
        dias_completo=info.allDay;
        //fecha
        console.log(info.date)
        fecha=info.date;
        //nombre
        console.log(info.draggedEl.innerHTML)
        nombre=info.draggedEl.innerHTML;

        //colores
        console.log(background_color)
        console.log(color_fin)

          
          
          
        
            $.ajax({
                        type:"post",
                        data:{dias_completo:dias_completo, fecha:fecha, nombre:nombre, background_color:background_color, color_fin:color_fin},
                        url:'modulos/paginaInicio/calendarioEscolar/elementos/ajendar_calendario_dos.php',
                        success:function(r){

                        
                          
                          if (r==1) {
                              toastr.info('Se agendo el evento !!');
                           
                          }else{
                              toastr.info('Error de sistema !!');
                          
                          } 
                          

                        }
                      });



      },




       eventClick: function(info) {




   
 
        id=info.event._def.publicId;
        nombre=info.event._def.title;


        if (id=='') {
          toastr.warning('Debe refrescar la página para poder eliminar');
          return false;
        }

        console.log(info);
        var event = calendar.getEventById(id) // an event object!

        
         conta=id.split('_');

         if (conta.length==2) {
          toastr.warning('NO puede eliminar este evento');
          return false;
         } 

      
        Swal.fire({
                  title: 'Evento',
                  text: "Nombre: "+nombre,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI, Eliminar Evento!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    
                           $.ajax({
                                type:"post",
                                data:{id:id},
                                url:'modulos/paginaInicio/calendarioEscolar/elementos/borrar_evento_calendario_dos.php',
                                success:function(r){

                                  if (r==1) {
                                      toastr.success('Se elimino el evento !!');
                                      event.remove();
                                   
                                  }else{
                                      toastr.error('Error de sistema !!');
                                  
                                  } 
                                  

                                }
                              });


                    




                  }
                })
        
   
      },




    });





    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })



    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

   

      var nombre_boton = $('#new-event').val();
    
    $.ajax({
                url:'modulos/paginaInicio/calendarioEscolar/elementos/botones_calendarios_agregar_dos.php',
                type:"post",
                data:{nombre_boton:nombre_boton,currColor:currColor},
                dataType: "json",
                success:function(data){
                  
                  id_cale = data[0].id_cale;
                  nombre = data[0].nombre;
                  color = data[0].color;

                  console.log(id_cale)
                                      // Create events
                  var event = $('<div id="boton_'+id_cale+'" />')
                  event.css({
                    'background-color': color,
                    'border-color'    : color,
                    'color'           : '#fff'
                  }).addClass('external-event')
                  event.text(nombre)
                  $('#external-events').prepend(event)


                 
                  nombre=event[0].outerHTML;

                   ini_events(event);

                  // Remove event from text input
                  $('#new-event').val('')





                  toastr.warning('Se agrego el evento !!');
                  

                }
              })


           


  
    })
  })

arrastables();

function arrastables(){

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
          data:[],
          url:'modulos/paginaInicio/calendarioEscolar/elementos/botones_calendarios_dos.php',
          success:function(r){

            
          
            $('#arrastables').html(r); 
            


            $.unblockUI();


          }
        });




}

  

function recargar(){
         
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

    
         
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/paginaInicio/calendarioEscolar/calendario.php');

       
}



$.unblockUI();

</script>


