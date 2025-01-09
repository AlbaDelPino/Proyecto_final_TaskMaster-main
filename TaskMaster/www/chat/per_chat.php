<?php include('../header.php'); ?>
<section class="principal-chat">
    <article class="perfil">
        <?php
            include('../conexion/config.php');
            $id_evento = $_GET['id'];
       
            $SqlEventos2 = "SELECT * FROM eventoscalendar ev INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
            INNER JOIN usuario us ON ue.id_usuario=us.id_usuario WHERE ev.id = $id_evento";
            $resulEventos2 = mysqli_query($conn, $SqlEventos2);
            $registro2 = mysqli_fetch_assoc($resulEventos2);
        ?>
        <h3><?php echo $registro2['evento']; ?></h3>
    </article>
    <div id="chat">
        <?php
         $SqlEventos3   = "SELECT * FROM eventoscalendar e LEFT JOIN chat c ON e.id = c.id_evento INNER JOIN usuario u ON c.id_usuario = u.id_usuario WHERE c.id_evento = $id_evento ORDER BY fecha_envio DESC";
         $resulEventos3 = mysqli_query($conn, $SqlEventos3);
        while($registro4 = mysqli_fetch_assoc($resulEventos3)) {
            $nombre_compartir = $registro4['id_usuario'];
            if($nombre_compartir == $id_usuario) {
        ?>
        <article class="mensaje me">
        <h6>Yo</h6>
  
        <div>
            <p><?php echo $registro4['mensaje']; ?></p>
            <img src="../<?php echo $registro4['imagen']; ?>" alt="j">
            <a href="deletechat.php?id=<?= $registro4['id_chat']; ?>">
        </div>
        </article>
        <?php
// echo $id_usuario ;
include('modalchat.php');
?>
        <?php
            } else {
        ?> 
        <article class="mensaje">
      
        <h6><?php echo $registro4['nombre']; ?><6>
        <div>
            <img src="../<?php echo $registro4['imagen']; ?>" alt="j">
            <p><?php echo $registro4['mensaje']; ?></p>
        </div>
        </article>
        <?php
            }
        }
        ?>
    </div>
    <form name="formchat" id="formchat" class="formchat" enctype="multipart/form-data" action="mensaje.php" method="POST" onsubmit="return enviarMensaje(event)">
        <input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $id_evento; ?>">      
        <input type="hidden" class="form-control" name="idusuario" id="idusuario" value="<?php echo $id_usuario; ?>">      
        <textarea name="mensaje" id="mensaje" cols="1" rows="1" style="border: none;"></textarea> 
        <button type="submit"  class="btn "><i class="bi bi-send"></i></button>
    </form> 
</section> 
</main>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    function enviarMensaje(event) {
        event.preventDefault(); // Evitar el envío normal del formulario
        var form = document.getElementById('formchat');
        var formData = new FormData(form);

        // Enviar los datos del formulario mediante AJAX
        fetch('mensaje.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Recargar la página después de enviar el mensaje
            cargarMensajes();
            // Borrar el contenido del textarea
            document.getElementById('mensaje').value = '';
          
        })
        .catch(error => console.error('Error:', error));

        return false;
    }

    function cargarMensajes() {
        var idEvento = document.getElementById('idEvento').value;

        fetch('cargar_mensajes.php?id=' + idEvento)
        .then(response => response.text())
        .then(data => {
            document.getElementById('chat').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }

    // Recargar los mensajes cada 5 segundos
    setInterval(cargarMensajes, 5000);

    // Cargar los mensajes inicialmente
    cargarMensajes();
</script>
</body>
</html>
