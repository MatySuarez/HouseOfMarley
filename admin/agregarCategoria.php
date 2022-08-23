<?php 
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $query = mysqli_query($conexion, "INSERT INTO categorias(categoria) VALUES ('$nombre')");
        if ($query) {
            header('Location: categorias.php');
        };
    };
};


?>