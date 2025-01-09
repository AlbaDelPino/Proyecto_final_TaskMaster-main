<?php

include "../header.php";


?>

<section class="principal-listado">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
LISTAR EVENTO
</button>
<?php  
include('modalNuevoEvento.php');

  
  

  

?>
        <table  class="tabla">
            <thead>
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Archivos</th>
                    <th scope="col">Descargar</th>
                    <th scope="col">compartido por:</th>
                    
                </tr>
            </thead>
    
          
        </table>
        
        
    </section> 
</main>
<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>


</section>