<?php
require_once "../config/conexion.php";
require_once "../helpers/helper_paginador.php";
include("includes/header.php");
if ($_SESSION['rol'] != 0){
    session_destroy();
};


$articulos=mysqli_query($conexion, "SELECT * FROM usuarios ;");
$num_registros=@mysqli_num_rows($articulos);

$pag = $_GET['pag'] ?? 1;
$registros_por_pagina = 6;
$cantidad_registros = $num_registros;
$paginas = paginador($pag, $cantidad_registros, $registros_por_pagina);
$desde = ($pag - 1) * $registros_por_pagina;
        





?>



<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <h1 class="h3 mb-0 text-800">Usuarios</h1>
    <button class="d-none d-sm-inline-block btn btn btn-primary shadow-sm" id="abrirUsuario"><i
            class="fas fa-plus fa-sm text-white-50"></i> Nuevo</button>
</div>
<?php if($_SESSION['rol'] == 0) { ?>
<h4>Usted es administrador</h4>
<?php } else if ($_SESSION['rol'] == 1) { ?>
<h4>Usted es editor</h4>
<?php } else { ?>
<h4>Usted es usuario</h4>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered " style="width: 100%; background-color: rgba(10,10,10,0.8);">
                <thead class="thead-white text-white">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT * FROM usuarios");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr class="text-white" style="background-color: rgba(10,10,10,0.8);">
                        <td class="text-white"><?php echo $data['id']; ?></td>
                        <td class="text-white"><?php echo $data['usuario']; ?></td>
                        <td class="text-white"><?php echo $data['nombre']; ?></td>
                        <td class="text-white"><?php 
                                if($data['rol']==0){
                                    echo "Administrador";
                                }
                                if($data['rol']==1){
                                    echo "Editor";
                                }
                                if($data['rol']==2){
                                    echo "Usuario";
                                } ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" id="editarUsuario" data-toggle="modal"
                                data-target="#editarUsu<?php echo $data['id']; ?>"
                                onclick="valor(<?php echo $data['id']; ?>), mostrar(<?php echo $data['id']; ?>)">Editar</button>
                            <div id="editarUsu<?php echo $data['id']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="my-modal-title" aria-hidden="true">
                                <div class="modal-dialog modal-lg border border-light" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-primary text-white">
                                            <h5 class="modal-title" id="title">Editar Usuario</h5>
                                            <button class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="background-color: rgba(10,10,10,1);">
                                            <form role="from" action="modificarUsuario.php" method="POST"
                                                enctype="multipart/form-data" autocomplete="off" id="modificarUsuario">
                                                <div class="row">
                                                    <input id="id1" class="form-control" type="hidden" name="id1"
                                                        value="<?php echo $data['id']; ?>">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="usuario" id="lbUsuario1">Usuario</label>
                                                            <input id="usuario" class="form-control" type="text"
                                                                name="usuario1" value="<?php echo $data['usuario']; ?>"
                                                                placeholder="Usuario" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre" id="lbNombre1">Nombre Completo</label>
                                                            <input id="nombre1" class="form-control" type="text"
                                                                name="nombre1" value="<?php echo $data['nombre']; ?>"
                                                                placeholder="Nombre Completo" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="clave" id="lbClave1">Generar nueva clave</label>
                                                            <input id="clave" class="form-control" type="password"
                                                                name="clave1" value="<?php echo $data['clave']; ?>"
                                                                placeholder="Clave">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="form-group">
                                                            <input id="claveActual" class="form-control" type="hidden"
                                                                name="claveActual" value="<?php echo $data['clave']; ?>"
                                                                placeholder="Clave">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="rol">Rol</label>
                                                            <select id="rol" class="form-control" name="rol1" required>
                                                                <?php
                                                                    $roles = mysqli_query($conexion, "SELECT * FROM roles");
                                                                    $data1 = mysqli_fetch_assoc($roles);
                                                                    
                                                                    if($data['rol'] == 0){ ?>
                                                                <option value="<?php echo 0; ?>" selected>
                                                                    <?php echo "Administrador";; ?></option>
                                                                <option value="<?php echo 1; ?>"><?php echo "Editor"; ?>
                                                                </option>
                                                                <option value="<?php echo 2; ?>">
                                                                    <?php echo "Usuario"; ?></option>
                                                                <?php } else if($data['rol'] == 1){ ?>
                                                                <option value="<?php echo 0; ?>">
                                                                    <?php echo "Administrador";; ?></option>
                                                                <option value="<?php echo 1; ?>" selected>
                                                                    <?php echo "Editor"; ?></option>
                                                                <option value="<?php echo 2; ?>">
                                                                    <?php echo "Usuario"; ?></option>
                                                                <?php } else if($data['rol'] == 2){ ?>
                                                                <option value="<?php echo 0; ?>">
                                                                    <?php echo "Administrador";; ?></option>
                                                                <option value="<?php echo 1; ?>"><?php echo "Editor"; ?>
                                                                </option>
                                                                <option value="<?php echo 2; ?>" selected>
                                                                    <?php echo "Usuario"; ?></option>
                                                                <?php } ?>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit" name="submit">Modificar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>


                            <button class="btn btn-danger eliminarUsuario" onclick="valor(<?php echo $data['id']; ?>)"
                                type="submit">Eliminar</button>
                            <div id="eliminarModalUsuario" class="modal text-dark" tabindex="-1" role="dialog">
                                <div class="modal-dialog border border-dark" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-primary text-white">
                                            <h5 class="modal-title">Eliminar Usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-white" style="background-color: rgba(10,10,10,1);">
                                            <p>¿Esta seguro de eliminar el usuario? </p>
                                        </div>
                                        <div class="modal-footer" style="background-color: rgba(10,10,10,1);">
                                            <form method="post" onsubmit="return setAction(this)" class="d-inline">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php include('modalEditar.php'); ?>

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
<div id="usuarios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg border border-light" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: rgba(10,10,10,1);">
                <form role="form" action="" method="POST" enctype="multipart/form-data" autocomplete="off"
                    id="nuevoUsuario">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" id="lbUsuario">Usuario</label>
                                <input id="usuario2" class="form-control" type="text" name="usuario2"
                                    placeholder="Usuario">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" id="lbNombre">Nombre Completo</label>
                                <input id="nombre2" class="form-control" type="text" name="nombre2"
                                    placeholder="Nombre Completo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave" id="lbClave">Clave</label>
                                <input id="clave2" class="form-control" type="password" name="clave2"
                                    placeholder="Clave">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select id="rol2" class="form-control" name="rol2">
                                    <?php
                                $roles = mysqli_query($conexion, "SELECT * FROM roles");
                                foreach ($roles as $rol) { ?>
                                    <option value="<?php echo $rol['id']; ?>"><?php echo $rol['descripcion']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
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
/*
//CHANGE - MODIFICAR USUARIO EXISTENTE
$("#usuario1").change(function(){
        if($("#usuario1").val() != ''){
            $("#lbUsuario1").html("Usuario");
        } else {
            $('#lbUsuario1').html("Usuario <br> <span style='color:red;'> * Complete el campo usuario </span>");
        };
    });
    

    $("#nombre1").change(function(){
        if($("#nombre1").val() != ''){
            $("#lbNombre1").html("Nombre");
        } else {
            $('#lbNombre1').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
        }
    });

    $("#clave1").change(function(){
        if($("#clave1").val() != ''){
            $("#lbClave1").html("Clave");
        } else {
            $('#lbClave1').html("Clave <br> <span style='color:red;'> * Complete el campo clave </span>");
        }
    });

    $("#modificarUsuario").submit(function(e){
        e.preventDefault();
        var resultado1 = true;
        var id1 = $("#id1").val();
        var usuario1 = $("#usuario1").val();
        var nombre1 = $("#nombre1").val();
        var claveActual = $("#claveActual").val();
        var clave1 = $("#clave1").val();
        var rol1 = $("#rol1").val();

        if(usuario1 == ''){
            $('#lbUsuario1').html("Usuario <br> <span style='color:red;'> * Complete el campo usuario </span>");
            resultado1 = false;
        };
        if(nombre1 == '') {
            $('#lbNombre1').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
            resultado1 = false;
        }; 
        if(clave1 == '') {
            $('#lbClave1').html("Clave <br> <span style='color:red;'> * Complete el campo clave </span>");
            resultado1 = false;
        } else {
            if(clave1.length < 8){
                $('#lbClave1').html("Clave <br> <span style='color:red;'> * La clave debe ser mayor o igual a 8 caracteres </span>");
                resultado1 = false;
            };
        };
        
        if(resultado1 == true) {
            $.ajax({
                method: "POST",
                url: "modificarUsuario.php",

                data: {"id1": id1,"usuario1": usuario1, "nombre1": nombre1, "claveActual": claveActual, "clave1": clave1, "rol1": rol1},

                
                success: function(data){

                        $('#editarUsu').modal('hide');

                        $('#modificarUsuario').trigger('reset');

                        document.location.reload();

                    
                }

            });
        };
    });
*/
//change formulario nuevo usuario
$("#usuario2").change(function() {
    if ($("#usuario2").val() != '') {
        $("#lbUsuario").html("Usuario");
    } else {
        $('#lbUsuario').html("Usuario <br> <span style='color:red;'> * Complete el campo usuario </span>");
    };
});


$("#nombre2").change(function() {
    if ($("#nombre2").val() != '') {
        $("#lbNombre").html("Nombre");
    } else {
        $('#lbNombre').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
    }
});

$("#clave2").change(function() {
    if ($("#clave2").val() != '') {
        $("#lbClave").html("Clave");
    } else {
        $('#lbClave').html("Clave <br> <span style='color:red;'> * Complete el campo clave </span>");
    }
});

var respuesta = true;

$("#nuevoUsuario").submit(function(e) {
    e.preventDefault();
    var resultado = true;
    var usuario2 = $("#usuario2").val();
    var nombre2 = $("#nombre2").val();
    var clave2 = $("#clave2").val();
    var rol2 = $("#rol2").val();

    if (usuario2 == '') {
        $('#lbUsuario').html("Usuario <br> <span style='color:red;'> * Complete el campo usuario </span>");
        resultado = false;
    } else {
        if (respuesta == false) {
            $('#lbUsuario').html("Usuario <br> <span style='color:red;'> * Usuario ocupado </span>");

        };
    };
    if (nombre2 == '') {
        $('#lbNombre').html("Nombre <br> <span style='color:red;'> * Complete el campo nombre </span>");
        resultado = false;
    };
    if (clave2 == '') {
        $('#lbClave').html("Clave <br> <span style='color:red;'> * Complete el campo clave </span>");
        resultado = false;
    } else {
        if (clave2.length < 8) {
            $('#lbClave').html(
                "Clave <br> <span style='color:red;'> * La clave debe ser mayor o igual a 8 caracteres </span>"
                );
            resultado = false;
        };
    };



    if (resultado == true) {
        $.ajax({
            method: "POST",
            url: "agregarUsuario.php",

            data: {
                "usuario2": usuario2,
                "nombre2": nombre2,
                "clave2": clave2,
                "rol2": rol2
            },


            success: function(data) {
                if (data == usuario2) {
                    respuesta = false;
                    //alert("El usuario ingresado ya esta en uso. Volver a intentar.");
                }

                if (data != usuario2) {

                    $('#productos').modal('hide');

                    $('#nuevoUsuario').trigger('reset');

                    document.location.reload();

                }
            }

        });
    };
});


$(document).on('click', '#editarUsuario', function() {
    $('#editarUsu').modal('show');

});
$(document).on('click', '.eliminarUsuario', function() {
    $('#eliminarModalUsuario').modal('show');

});


function mostrar(num) {
    document.getElementById('id1').value = num;
}

var valueId;

function valor(value) {
    valueId = value;
}

function setAction(form) {
    var actionEliminar = "eliminar.php?accion=usu&id=";
    actionEliminar = actionEliminar.concat(valueId);
    form.action = actionEliminar;
    return;
}
</script>


<?php include("includes/footer.php"); ?>