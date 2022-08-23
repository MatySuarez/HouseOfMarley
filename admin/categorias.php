<?php
require_once "../config/conexion.php";
/*if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $query = mysqli_query($conexion, "INSERT INTO categorias(categoria) VALUES ('$nombre')");
        if ($query) {
            header('Location: categorias.php');
        };
    };
};*/
include("includes/header.php");
?>

<!-- Bootstrap core JavaScript-->
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/js/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>
<script src="../assets/js/all.min.js"></script>
<script src="../assets/js/scripts.js"></script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-white-800">Categorias</h1>
    <button class="d-none d-sm-inline-block btn btn btn-primary shadow-sm" id="abrirCategoria"><i class="fas fa-plus fa-sm text-white-50"></i> Nuevo</button>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width: 100%;">
                <thead class="text-white" style="background-color: rgba(10,10,10,0.8);">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT * FROM categorias ORDER BY id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr style="background-color: rgba(10,10,10,0.8);">
                            <td class="text-white"><?php echo $data['id']; ?></td>
                            <td class="text-white"><?php echo $data['categoria']; ?></td>
                            <td>
                                <button class="btn btn-danger eliminarCategoria" onclick="valor(<?php echo $data['id']; ?>)" type="submit">Eliminar</button>
                                <div id="eliminarModal" class="modal text-dark" tabindex="-1" role="dialog" >
                                    <div class="modal-dialog border border-dark" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-gradient-primary text-white">
                                                <h5 class="modal-title">Eliminar categoria</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-white" style="background-color: rgba(10,10,10,1);">
                                                <p>¿Esta seguro de eliminar la categoria?  </p>
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
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="categorias" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog border border-dark" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="title">Nueva Categoria</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: rgba(10,10,10,1);">
                <form role="form" action="" method="POST" autocomplete="off" id="nuevaCategoria">
                    <div class="form-group">
                        <label for="nombre" id="lbNombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Categoria">
                    </div>
                    <button class="btn btn-primary" type="submit" id="submit" name="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#nombre").change(function(){
        if($("#nombre").val() != ''){
            $("#lbNombre").html("Nombre");
        } else {
            $('#lbNombre').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
        }
    });


    $("#nuevaCategoria").submit(function(e){
        e.preventDefault();
        var nombre = $("#nombre").val();

        if(nombre == ''){
            $('#lbNombre').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
        } else {
            $.ajax({
                method: "POST",
                url: "agregarCategoria.php",

                data: {"nombre": nombre},
                
                success: function(data){
                    $('#categorias').modal('hide');

                    $('#nuevaCategoria').trigger('reset');

                    document.location.reload();
                }

            });
        };
    });

    $(document).on('click', '#editarCategoria', function(){
        $('#editar').modal('show');

    });
    $(document).on('click', '.eliminarCategoria', function(){
        $('#eliminarModal').modal('show');
        
    });

    $('#abrirCategoria').click(function(){
        $('#categorias').modal('show');
    })

    var valueId;
    function valor (value){
            valueId=value;
    }

    function setAction(form) {
        var actionEliminar = "eliminar.php?accion=cli&id=";
        actionEliminar = actionEliminar.concat(valueId);
        form.action = actionEliminar;
    return;
    }


</script>


<?php include("includes/footer.php"); ?>