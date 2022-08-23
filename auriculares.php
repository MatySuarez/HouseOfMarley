
<?php require_once "config/conexion.php"; ?>
<?php require_once "header.php"; ?>

<?php
require_once "helpers/helper_paginador.php";

$articulos=mysqli_query($conexion, "SELECT * FROM productos WHERE id_categoria = 10");
$num_registros=@mysqli_num_rows($articulos);

$pag = $_GET['pag'] ?? 1;
$registros_por_pagina = 4;
$cantidad_registros = $num_registros;
$paginas = paginador($pag, $cantidad_registros, $registros_por_pagina);
$desde = ($pag - 1) * $registros_por_pagina;

?>
<?php
include_once "funciones.php";
$productos = obtenerAuriculares($desde,$registros_por_pagina);
$categorias = obtenerCategorias();
?>

<html lang="en">


<body>

    <main>
        <div class="container mt-5 mb-5">
            <img src="auriculares/portada-auriculares.png" alt="portada" width="100%" height="100%">
        </div>
        
    </main>
    
   
    
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 border-radius: 30px">
                <?php
                $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id_categoria = 10");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    foreach ($productos as $producto ){ ?>
                <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>">
                    <div class="card  h-100">
                        <!-- Sale badge-->
                        <?php
                                if($producto->precio_rebajado != 0){ ?>
                        <h5 class="rounded p-1 bg-danger text-white position-absolute"
                            style="top: 0.5rem; right: 0.5rem"> Oferta </h5>
                        <?php }
                                ?>
                        <!-- Product image-->
                        <img class="card-img-top" src="assets/img/<?php echo $producto->imagen; ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-3">
                            <div>
                                <!-- Product name-->
                                <h5 class="fw-bolder text-center"><?php echo $producto->nombre ?></h5>
                                
                            </div>
                        </div>
                        <div class="text-center p-1">
                            <!-- Product price-->
                            <h3 class=""><?php if(($producto->precio_rebajado) == 0 ){?>$<?php echo $producto->precio_normal;}?>
                             </h3>
                            <h3 class="text-decoration-line-through"><?php if(($producto->precio_rebajado) != 0 ){?>$<?php echo $producto->precio_normal;}?>
                              </h3>
                             <h3 class=""><?php if(($producto->precio_rebajado) != 0 ){?>$<?php echo $producto->precio_rebajado;}?>
                              </h3>
                        </div>
                        <!-- Product actions-->
                        <?php if (productoYaEstaEnCarrito($producto->id)) { ?>
                                    <form action="eliminarAuriculares.php" method="post" class="text-center">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id ?>">
                                        <span class="button is-success">
                                        <i class="fa fa-check"></i>&nbsp;En el carrito
                                        </span>
                                        <button class="button is-danger btn btn-danger m-3">
                                            <i class="fa fa-trash-o"></i>&nbsp;Quitar
                                        </button>
                                    </form>
                                <?php } else { ?>
                                    <form action="agregarAuriculares.php" method="post" class="text-center">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id ?>">
                                        <button class="button is-primary btn btn-danger m-3"><i class="fa fa-cart-plus"></i>&nbsp;Agregar al carrito</button>
                                    </form>
                                <?php } ?>
                    </div>
                </div>
                <?php  }
                } ?>
            </div>
            <div class="m-auto">
            <nav aria-label="..." class="align-center">
                <ul class="pagination">
                    <?php if($paginas['anterior']){?>
                        <li class="page-item">
                            <a class="page-link" href="?pag-<?php echo $paginas['primera'] ?>"tabindex="-1">Primera </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pag=<?php echo $paginas ['anterior'] ?>"><?php echo $paginas['anterior']; ?></a>
                        </li>
                    <?php } ?>
                        <li class="page-item active">
                            <a class="page-link disabled"href="#"><?php echo $paginas['actual'] ?></a>
                        </li>
                    <?php if($paginas['siguiente']){?>
                        <li class="page-item">
                            <a class="page-link" href="?pag=<?php echo $paginas['siguiente'] ?>"><?php echo $paginas['siguiente']; ?></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pag=<?php echo $paginas['ultima'] ?>">Última </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            </div>
        </div>
    </section>


    


    <?php require_once "footer.php"; ?>

   
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</html>