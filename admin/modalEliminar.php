<div id="eliminar<?php echo $data['id']; ?>" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog border border-dark" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Eliminar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: rgba(10,10,10,1);">
                <p>¿Esta seguro de eliminar el producto <?php echo $data['nombre']; ?> ?</p> 
            </div>
            <div class="modal-footer" style="background-color: rgba(10,10,10,1);">
                <form method="post" onsubmit="return setAction(this)"  class="d-inline"> 
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>