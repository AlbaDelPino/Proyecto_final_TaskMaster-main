<div class="modal fade" id="chat_<?php echo $registro4['id_chat']; ?>" tabindex="-1" role="dialog" aria-labelledby="chat_<?php echo $registro4['id_chat']; ?>" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chat_<?php echo $registro4['id_chat']; ?>">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php 
      $registro4['id_chat']; 
    
      ?>
      <td data-label="Borrar"> 
    <a href="deletechat.php?id=<?= $registro4['id_chat']; ?>">
        <i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> 
    </a>
</td>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>