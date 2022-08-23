<?php
    include_once "funciones.php";

    $cant = $_POST['cant'];
    $idpro = $_POST['idpro'];
    echo "$cant";
    echo "$idpro";
    cantidadCarrito($_POST['cant'], $_POST["idpro"]);
    header("Location: ver_carrito.php");
?>