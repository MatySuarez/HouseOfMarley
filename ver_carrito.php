<?php include_once "header.php" ?>
<?php include_once "funciones.php"; ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="d-flex justify-content-center align-items-center" style="background-image:url(img/portada4.jpg); background-size:cover; height: 40vh;";>
            <div class="container text-center">
                <h1 class="display-4 fw-bolder">Carrito</h1>
                <p class="lead fw-normal text-white-50 mb-0">Tus Productos Agregados</p>
            </div>
        </div>
    </header>


<?php
$productos = obtenerProductosEnCarrito();
if (count($productos) <= 0) {
?>
    <section class="hero is-info m-4">
        <div class="hero-body">
            <div class="container">
                <h2 class="title">
                    Todavía no hay productos
                </h2>
                <h3 class="subtitle">
                    Visita la tienda para agregar productos a tu carrito
                </h3>
                <button class="btn btn-warning"><a href="index.php" class="btn  text-decoration-none">Volver a la tienda</a></button>
            </div>
        </div>
    </section>
<?php } else { ?>
    <div class="container columns m-auto">
        <div class="column m-4">
            <h2 class="is-size-2">Mi carrito de compras</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub-Total</th>
                        <th>Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($productos as $producto) {
                        $precio_final = 0;
                        $subtotal = 0;
                        if(($producto->precio_rebajado) == 0 ){$precio_final = $producto->precio_normal;} else {$precio_final = $producto->precio_rebajado;};
                        $cant2 = buscarCantidad2($producto->id);
                        $subtotal = $precio_final * $cant2;
                        
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $producto->nombre ?></td>
                            <td>
                                $<?php echo number_format ($precio_final, 2); ?>
                            </td>
                            <td>
                                <form action="cantidad.php" method="POST">
                                    <input type="number" min="1" max="15" name="cant" id="cant" value="<?php buscarCantidad($producto->id) ?>">
                                    <input type="hidden" name="idpro" id="idpro" value="<?php echo($producto->id) ?>">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i>&nbsp;</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format ($subtotal, 2)?></td>
                            <td>
                                <form action="eliminarAuriculares.php" method="post">
                                    <input type="hidden" name="id_producto" value="<?php echo $producto->id ?>">
                                    <input type="hidden" name="redireccionar_carrito">
                                    <button class="button is-danger btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        <?php } ?>
                        </tr>
                </tbody>
                <tfoot>
                    <tr >
                        <td></td>
                        <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                        <td colspan="2" class="is-size-4">
                            $<?php echo number_format($total, 2) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="container text-center">
            <button class="button is-success is-large btn btn-danger m-2"><a href="auriculares.php" class="btn text-white"><i class="fa fa-cart-plus"></i>&nbsp; Seguir comprando</a></button>
            <button class="button is-success is-large btn btn-danger m-2"><a href="ver_carrito.php" class="btn text-white"><i class="fa fa-refresh"></i>&nbsp; Recargar carrito</a></button>
            <button class="button is-success is-large btn btn-danger m-2"><a href="#" class="btn text-white"><i class="fa fa-check"></i>&nbsp; Terminar compra</a></button>
            
        </div>
    </div>


<?php } ?>
<?php include_once "footer.php" ?>

</body>