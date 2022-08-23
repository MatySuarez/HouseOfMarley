

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>House of Marley</title>
    <link rel="shortcut icon" href="img/logo-titulo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/estilos.css" rel="stylesheet" />

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<header class=" container-fluid d-flex m-auto">
        <div class="container ">
            <a href="#" class="mobileMenu-toggle" data-mobile-menu-toggle="menu" aria-controls="menu" aria-expanded="false"></a>
            <div class="header-logo header-logo-left container">
               <a  href="index.php"><img src="./img/logo-rasta.png" alt="logo"> </a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-expand-md navbar-light">
            <div class="container ">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                  <li class="nav-item">
                    <a class="nav-link " href="auriculares.php">Auriculares</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="parlantes.php">Parlantes</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link"  href="bandejas.php">Bandejas</a>       
                  </li>
                  <li class="nav-item">
                    <a class="nav-link "  href="proyecto.php" >Proyecto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link "  href="materiales.php" >Materiales</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link "  href="contacto.php" >Contacto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link "  href="admin" >Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link button is-success" href="ver_carrito.php">&nbsp;<i class="fa fa-shopping-cart"></i><?php include_once "funciones.php"; $conteo = count(obtenerIdsDeProductosEnCarrito());
                    if ($conteo > 0) {
                      printf("(%d)", $conteo);
                    }
                  ?>
                  </a>
                  </li>
                </ul>  
              </div>
            </div>
          </nav>
    </header>