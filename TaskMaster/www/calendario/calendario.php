<?php include('../header.php'); ?>
<section class="principal-calendario">
    <?php include('msjs.php'); ?>
    <div class="mt-5"></div>
    <div class="container">
        <div class="row">
            <div class="col msjs">
                <!-- Mensajes -->
            </div>
        </div>
    </div>
    <div id="calendar"></div>
    <?php include('modalNuevoEvento.php'); ?>
    <?php include('modalUpdateEvento.php'); ?>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/moment.min.js"></script>   
    <script type="text/javascript" src="../js/fullcalendar.min.js"></script>
    <script src='../locales/es.js'></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#calendar").fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            locale: 'es',
            defaultView: "month",
            navLinks: true, 
            editable: true,
            eventLimit: true, 
            selectable: true,
            selectHelper: false,
            // Nuevo Evento
            select: function(start, end){
                $("#exampleModal").modal();
                $("input[name=fecha_inicio]").val(start.format('YYYY-MM-DD HH:mm'));
              
                $('input[name=fecha_fin').val(end.format('YYYY-MM-DD HH:mm'));
                if (event) {
                    $("input[name=evento]").val(event.evento);
                    $("input[name=descripcion]").val(event.descripcion);
                    $("select[name=id_estado]").val(event.id_estado);
                    $("select[name=id_etiqueta]").val(event.id_etiqueta);
                  
                }
            },
            events: [
                <?php
                include('../login/config.php');
                $sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
                $res2 = mysqli_query($conn, $sql2);
                $fila = mysqli_fetch_assoc($res2);
                $usuario = $fila['nombre'];
                if ($usuario == "admin"){
                    $SqlEventos3  = "SELECT * FROM eventoscalendar ev 
            
                inner join estado es on es.id_estado=ev.id_estado 
                inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas 
                -- inner join archivo_evento ae on ae.id_evento = ev.id
                -- inner join archivos ar on ae.id_archivo= ar.id_archivo
             "; // Seleccionar solo eventos del usuario actual 
                $resulEventos3 = mysqli_query($conexion, $SqlEventos3);
                }
                else{
                    $SqlEventos3  = "SELECT * FROM eventoscalendar ev 
                inner join usuario_evento ue on ue.id_evento = ev.id
                inner join usuario us on ue.id_usuario=us.id_usuario 
                inner join estado es on es.id_estado=ev.id_estado 
                inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas 
                -- inner join archivo_evento ae on ae.id_evento = ev.id
                -- inner join archivos ar on ae.id_archivo= ar.id_archivo
                where us.id_usuario = $id_usuario"; // Seleccionar solo eventos del usuario actual 
                $resulEventos3 = mysqli_query($conexion, $SqlEventos3);
                }
               
           
                while($dataEvento = mysqli_fetch_array($resulEventos3)){ ?>
                    {
                        id: '<?php echo $dataEvento['id']; ?>',
                        title: '<?php echo $dataEvento['evento']; ?>',
                        start: '<?php echo $dataEvento['fecha_inicio']; ?>',
                        end:   '<?php echo $dataEvento['fecha_fin']; ?>',
                        color: '<?php echo $dataEvento['color_evento']; ?>',
                        descripcion: '<?php echo $dataEvento['descripcion']; ?>',
                        id_etiqueta: '<?php echo $dataEvento['id_etiquetas']; ?>',
                        id_estado: '<?php echo $dataEvento['id_estado']; ?>'
                    },
                <?php } ?>
            ],
            // Eliminar Evento
            eventRender: function(event, element) {
                element.find(".fc-content").prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
                // Eliminar evento
                element.find(".closeon").on("click", function() {
                    var pregunta = confirm("¿Deseas Borrar este Evento?");   
                    if (pregunta) {
                        $("#calendar").fullCalendar("removeEvents", event.id);
                        $.ajax({
                            type: "POST",
                            url: 'deleteEvento.php',
                            data: {id: event.id},
                            success: function(datos) {
                                $(".alert-danger").show();
                                setTimeout(function () {
                                    $(".alert-danger").slideUp(500);
                                }, 3000); 
                            }
                        });
                    }
                });
            },
            // Moviendo Evento Drag - Drop
            eventDrop: function (event, delta) {
                var idEvento = event.id;
                var start = event.start.format('YYYY-MM-DD HH:mm');
                var end = event.end.format('YYYY-MM-DD HH:mm');
                $.ajax({
                    url: 'drag_drop_evento.php',
                    data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
                    type: "POST",
                    success: function (response) {
                        // $("#respuesta").html(response);
                    }
                });
            },
            // Modificar Evento del Calendario 
            eventClick: function(event) {
                var idEvento = event.id;
                $('input[name=idEvento]').val(idEvento);
                $('input[name=evento]').val(event.title);
                $('input[name=descripcion]').val(event.descripcion);
          
              
                $('input[name=fecha_inicio]').val(event.start.format('YYYY-MM-DD HH:mm'));
                $('input[name=fecha_fin]').val(event.end.format('YYYY-MM-DD HH:mm'));
                $('select[name=id_etiqueta]').val(event.id_etiqueta);
                $('select[name=id_estado]').val(event.id_estado);
                $('select[name=id_usuario]').val(event.id_usuario);
                $('input[name=color]').val(event.color);
                $("#modalUpdateEvento").modal();
            }
        });
        // Oculta mensajes de Notificacion
        setTimeout(function () {
            $(".alert").slideUp(300);
        }, 3000); 
    });
</script>
</section>
</main>
</body>
</html>
