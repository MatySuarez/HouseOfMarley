<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: panel.php');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario1']) || empty($_POST['clave1'])) {
            $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "../config/conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['usuario1']);
            $clave = mysqli_real_escape_string($conexion, $_POST['clave1']);
            $usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");
            foreach ($usuarios as $usuario) {
                $hash = $usuario['clave'];
                if (password_verify($clave, $hash)){
                    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$hash'");
                    mysqli_close($conexion);
                    $resultado = mysqli_num_rows($query);
                    if ($resultado > 0) {
                        $dato = mysqli_fetch_array($query);
                        $_SESSION['active'] = true;
                        $_SESSION['id'] = $dato['id'];
                        $_SESSION['nombre'] = $dato['nombre'];
                        $_SESSION['user'] = $dato['usuario'];
                        $_SESSION['rol'] = $dato['rol'];
                        header('Location: panel.php');
                    };
                } else {
                    $correcto = false;
                };
            };
            if($correcto == false){
                $alert = '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                            Contraseña incorrecta
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'; 
            };
        };
    };
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sb-admin-2.min.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" />
</head>

<body style="background-image: url(../img/fondo_contacto.jpg);background-size:cover; height: 100vh;">
    <header class=" container-fluid d-flex m-auto bg-white">
        <div class="container ">
            <a href="#" class="mobileMenu-toggle" data-mobile-menu-toggle="menu" aria-controls="menu"
                aria-expanded="false"></a>
            <div class="header-logo header-logo-left ">
                <a href="../index.php"><img src="../img/logo-rasta.png" alt="logo"> </a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-expand-md navbar-light  ">
            <div class="container-fluid ">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link " href="../auriculares.php">Auriculares</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../parlantes.php">Parlantes</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../bandejas.php">Bandejas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="../proyecto.php">Proyecto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="../materiales.php">Materiales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="../contacto.php">Contacto</a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br><br><br><br><br><br>

    <div class="container m-auto p-3 mb-5 mt-4"
        style="width: 50%; background-color: rgba(179, 161, 161, 0.6);border-radius: 20px;">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Bienvenido al Panel de Administración </h1>
            <?php echo (isset($alert)) ? $alert : ''; ?>
        </div>
        <form action="" class="user" method="POST" autocomplete="off">
            <div class="mb-3">
                <input type="text" name="usuario1" class="form-control " id="usuario1" aria-describedby="emailHelp"
                    placeholder="Usuario">
                <div id="emailHelp" class="form-text text-gray-900">Ingrese su usuario</div>
            </div>
            <div class="mb-3">
                <input type="password" name="clave1" class="form-control" id="clave1" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary" style="border-radius: 10px;">Ingresar</button>
        </form>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>