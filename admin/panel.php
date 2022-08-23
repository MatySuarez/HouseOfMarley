<?php
require_once "../config/conexion.php";
require_once "../helpers/helper_paginador.php";


$articulos=mysqli_query($conexion, "SELECT * FROM productos ;");
$num_registros=@mysqli_num_rows($articulos);

$pag = $_GET['pag'] ?? 1;
$registros_por_pagina = 6;
$cantidad_registros = $num_registros;
$paginas = paginador($pag, $cantidad_registros, $registros_por_pagina);
$desde = ($pag - 1) * $registros_por_pagina;






/*
if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre2'];
        $cantidad = $_POST['cantidad2'];
        $descripcion = $_POST['descripcion2'];
        $p_normal = $_POST['p_normal2'];
        $p_rebajado = $_POST['p_rebajado2'];
        $categoria = $_POST['categoria2'];
        $img = $_FILES['foto2'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../assets/img/" . $foto;
        $query = mysqli_query($conexion, "INSERT INTO productos(nombre, descripcion, precio_normal, precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre', '$descripcion', '$p_normal', '$p_rebajado', $cantidad, '$foto', $categoria)");
        if ($query) {
            if (move_uploaded_file($tmpname, $destino)) {
                header('Location: panel.php');
            }
        }
    }
}
*/
include("includes/header.php"); ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <h1 class="h3 mb-0 text-800">Productos</h1>
    <button class="d-none d-sm-inline-block btn btn btn-primary shadow-sm" id="abrirProducto"><i
            class="fas fa-plus fa-sm text-white-50"></i> Nuevo</button>
</div>
<?php if($_SESSION['rol'] == 0) { ?>
<h4>Usted es administrador</h4>
<?php } else if ($_SESSION['rol'] == 1) { ?>
<h4>Usted es editor</h4>
<?php } else { ?>
<h4>Usted es usuario</h4>
<?php } ?>
<h5>Cantidad total de productos: (<?php echo $num_registros; ?>)</h5>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered " style="width: 100%; background-color: rgba(10,10,10,0.8);">
                <thead class="thead-white text-white">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio Normal</th>
                        <th>Precio Rebajado</th>
                        <th>Cantidad</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC LIMIT $desde, $registros_por_pagina;");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr class="text-white" style="background-color: rgba(10,10,10,0.8);">
                        <td><img class="img-thumbnail" src="../assets/img/<?php echo $data['imagen']; ?>" width="50">
                        </td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $data['precio_normal']; ?></td>
                        <td><?php echo $data['precio_rebajado']; ?></td>
                        <td><?php echo $data['cantidad']; ?></td>
                        <td><?php echo $data['categoria']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" id="editarProducto" data-toggle="modal"
                                data-target="#editar<?php echo $data['id']; ?>"
                                onclick="valor(<?php echo $data['id']; ?>), mostrar(<?php echo $data['id']; ?>)">Editar</button>

                        </td>
                        <td>
                            <button type="button" class="btn btn-danger eliminarProducto" data-toggle="modal"
                                data-target="#eliminar<?php echo $data['id']; ?>"
                                onclick="valor(<?php echo $data['id']; ?>)">Eliminar</button>

                        </td>
                    </tr>
                    <?php include('modalEditar.php'); ?>
                    <?php include('modalEliminar.php'); ?>

                    <?php } ?>
                </tbody>
            </table>

            <div class="m-auto">
                <nav aria-label="..." class="align-center">
                    <ul class="pagination text-white justify-content-center">
                        <?php if($paginas['anterior']){?>
                        <li class="page-item m-1">
                            <a class="btn btn-danger" href="?pag-<?php echo $paginas['primera'] ?>"
                                tabindex="-1">Primera </a>
                        </li>
                        <li class="page-item m-1">
                            <a class="btn btn-danger"
                                href="?pag=<?php echo $paginas ['anterior'] ?>"><?php echo $paginas['anterior']; ?></a>
                        </li>
                        <?php } ?>
                        <li class="page-item active m-1">
                            <a class="btn btn-light disabled" href="#"><?php echo $paginas['actual'] ?></a>
                        </li>
                        <?php if($paginas['siguiente']){?>
                        <li class="page-item m-1">
                            <a class="btn btn-danger"
                                href="?pag=<?php echo $paginas['siguiente'] ?>"><?php echo $paginas['siguiente']; ?></a>
                        </li>
                        <li class="page-item m-1">
                            <a class="btn btn-danger" href="?pag=<?php echo $paginas['ultima'] ?>">Última </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
<div id="productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg border border-light" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: rgba(10,10,10,1);">
                <form role="form" action="" method="POST" enctype="multipart/form-data" autocomplete="off"
                    id="nuevoProducto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" id="lbNombre">Nombre</label>
                                <input id="nombre2" class="form-control" type="text" name="nombre2"
                                    placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad" id="lbCantidad">Cantidad</label>
                                <input id="cantidad2" class="form-control" type="number" name="cantidad2"
                                    placeholder="Cantidad">
                            </div>
                        </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="p_normal" id="lbPnormal">Precio Normal</label>
                            <input id="p_normal2" class="form-control" type="number" name="p_normal2"
                                placeholder="Precio Normal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="p_rebajado" id="lbPrebajado">Precio Rebajado</label>
                            <input id="p_rebajado2" class="form-control" type="number" name="p_rebajado2"
                                placeholder="Precio Rebajado">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select id="categoria2" class="form-control" name="categoria2">
                                <?php
                                    $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
                                    foreach ($categorias as $cat) { ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="imagen">Foto</label>
                            <input type="file" class="form-control" name="archivo">
                        </div>
                    </div>
            </div>
            <button class="btn btn-primary" type="submit" id="submit" name="submit">Registrar</button>
            </form>
        </div>
    </div>
</div>
</div>

<script>
$("#nombre2").change(function() {
    if ($("#nombre2").val() != '') {
        $("#lbNombre").html("Nombre");
    } else {
        $('#lbNombre').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
    };
});

$("#cantidad2").change(function() {
    if ($("#cantidad2").val() != '') {
        $("#lbCantidad").html("Cantidad");
    } else {
        $('#lbCantidad').html("Cantidad <br> <span style='color:red;'> * Complete el campo cantidad </span>");
    }
});

$("#p_normal2").change(function() {
    if ($("#p_normal2").val() != '') {
        $("#lbPnormal").html("Precio Normal");
    } else {
        $('#lbPnormal').html(
            "Precio Normal <br> <span style='color:red;'> * Complete el campo precio normal </span>");
    }
});

$("#p_rebajado2").change(function() {
    if ($("#p_rebajado2").val() != '') {
        $("#lbPrebajado").html("Precio Rebajado");
    } else {
        $('#lbPrebajado').html(
            "Precio Rebajado <br> <span style='color:red;'> * Complete el campo precio rebajado </span>");
    }
});

document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('nuevoProducto');
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        subir_archivos(this);
    });
});

function subir_archivos(form) {
    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'subir.php');
    peticion.send(new FormData(form));
};

$("#nuevoProducto").submit(function(e) {
    e.preventDefault();
    var resultado = true;
    var nombre2 = $("#nombre2").val();
    var cantidad2 = $("#cantidad2").val();
    var p_normal2 = $("#p_normal2").val();
    var p_rebajado2 = $("#p_rebajado2").val();
    var categoria2 = $("#categoria2").val();
    var foto = $("#archivo").val();


    if (nombre2 == '') {
        $('#lbNombre').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
        resultado = false;
    };
    if (cantidad2 == '') {
        $('#lbCantidad').html("Cantidad <br> <span style='color:red;'> * Complete el campo cantidad </span>");
        resultado = false;
    };

    if (p_normal2 == '') {
        $('#lbPnormal').html(
            "Precio Normal <br> <span style='color:red;'> * Complete el campo precio normal </span>");
        resultado = false;
    };
    if (p_rebajado2 == '') {
        $('#lbPrebajado').html(
            "Precio Rebajado <br> <span style='color:red;'> * Complete el campo precio rebajado </span>");
        resultado = false;
    };

    if (resultado == true) {
        $.ajax({
            method: "POST",
            url: "agregarProducto.php",

            data: {
                "nombre2": nombre2,
                "cantidad2": cantidad2,
                "p_normal2": p_normal2,
                "p_rebajado2": p_rebajado2,
                "categoria2": categoria2,
                "foto": foto
            },

            success: function(data) {
                $('#productos').modal('hide');

                $('#nuevoUsuario').trigger('reset');

                document.location.reload();

            }

        });
    };

});



$(document).on('click', '#editarProducto', function() {
    $("#editarModal").modal('show');

});

$(document).on('click', '.eliminarProducto', function() {
    $("#eliminarModal").modal('show');

});

function mostrar(num) {
    document.getElementById('id1').value = num;
}

var valueId;

function valor(value) {
    valueId = value;
}

function setAction(form) {
    var actionEliminar = "eliminar.php?accion=pro&id=";
    actionEliminar = actionEliminar.concat(valueId);
    form.action = actionEliminar;
    return;
}
</script>


<?php include("includes/footer.php"); ?>