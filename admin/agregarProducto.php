<?php
require_once "../config/conexion.php";


if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre2'];
        $cantidad = $_POST['cantidad2'];
        $p_normal = $_POST['p_normal2'];
        $p_rebajado = $_POST['p_rebajado2'];
        $categoria = $_POST['categoria2'];
        //$img = $_FILES['foto'];
        //$name = $img['name'];
        //$tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        //$destino = "../assets/img/" . $foto;

        

        $query = mysqli_query($conexion, "INSERT INTO productos(nombre,  precio_normal, precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre',  '$p_normal', '$p_rebajado', $cantidad, '$foto', $categoria)");
        //if ($query) {
        //    if (move_uploaded_file($tmpname, $destino)) {
        //        header('Location: panel.php');
        //    };
        //};
    };
};


?>