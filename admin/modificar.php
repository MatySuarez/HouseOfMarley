<?php
session_start();
$link = mysqli_connect("localhost", "root","", "card");

if($link === false){
    die("ERROR: Could not connect. " 
                . mysqli_connect_error());
}

if (isset($_POST)) {
    if (!empty($_POST)) {
        $id = $_POST['id1'];
        $nombre1 = $_POST['nombre1'];
        $cantidad1 = $_POST['cantidad1'];
        $p_normal1 = $_POST['p_normal1'];
        $p_rebajado1 = $_POST['p_rebajado1'];
        $categoria1 = $_POST['categoria1'];
        $fecha = date("YmdHis");
        $query = "UPDATE productos SET nombre = '$nombre1', precio_normal = '$p_normal1', precio_rebajado = '$p_rebajado1', cantidad = '$cantidad1', id_categoria = '$categoria1' WHERE id='$id'";
        $query_run = mysqli_query($link, $query);
        if ($query) {
            header('Location: panel.php');
        }
    }
}

?>

