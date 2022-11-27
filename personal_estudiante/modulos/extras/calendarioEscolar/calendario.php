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
            <h1>Agenda Institucional <?php echo $cicloLectivo; ?></h1>
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
        
          <!-- /.col -->
          <div class="col-md-12">
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

    var calendarEl = document.getElementById('calendar');


   


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
              $precentacion_2_mes=$precentacion_2[1];
              $precentacion_2_dia=$precentacion_2[2];

              $precentacion_2_mes=intval($precentacion_2_mes);
              $precentacion_2_mes=$precentacion_2_mes-1;
              $precentacion_2_dia=intval($precentacion_2_dia);


              $finalizacion_1 = $array_finalizacion[$i];
              $finalizacion_2 = explode("-", $finalizacion_1);
              $finalizacion_2_mes=$finalizacion_2[1];
              $finalizacion_2_dia=$finalizacion_2[2];


              $finalizacion_2_mes=intval($finalizacion_2_mes);
              $finalizacion_2_mes=$finalizacion_2_mes-1;
              $finalizacion_2_dia=intval($finalizacion_2_dia);

               
               
               ?>



        {
          id:'P_I',
          title          : 'Periodo de intensificación',
          start          : new Date(y, <?php  echo $precentacion_2_mes;  ?>, <?php  echo $precentacion_2_dia;  ?>),
          end            : new Date(y, <?php  echo $finalizacion_2_mes;  ?>, <?php  echo $finalizacion_2_dia;  ?>),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },

        <?php } ?>











      ],


  

      editable  : false,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
  


      },




       eventClick: function(info) {




  
        
   
      },




    });





    calendar.render();



  })

  
$.unblockUI();

</script>


