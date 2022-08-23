<?php
session_start();
$link = mysqli_connect("localhost", "root","", "card");

if($link === false){
    die("ERROR: Could not connect. " 
                . mysqli_connect_error());
}

if (isset($_POST)) {
    if (!empty($_POST)) {
        $id1 = $_POST['id1'];
        $usuario1 = $_POST['usuario1'];
        $nombre1 = $_POST['nombre1'];
        $claveActual = $_POST['claveActual'];
        $clave = $_POST['clave1'];
        $rol1 = $_POST['rol1'];
        if($claveActual != $clave) {
            $clave1 = password_hash($clave, PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET usuario = '$usuario1', nombre = '$nombre1', clave = '$clave1', rol = '$rol1' WHERE id='$id1'";
        }
        if($claveActual == $clave){
            $query = "UPDATE usuarios SET usuario = '$usuario1', nombre = '$nombre1', clave = '$clave', rol = '$rol1' WHERE id='$id1'";
        }
        $query_run = mysqli_query($link, $query);
        if ($query) {
            header('Location: usuarios.php');
        }
    }
}

?>