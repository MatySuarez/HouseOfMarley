<?php

$nombre_temporal = $_FILES['archivo']['tmp_name'];
$nombre = $_FILES['archivo']['name'];

$fecha = date("YmdHis");
$foto = $fecha . ".jpg";
$destino = "../assets/img/" . $foto;

//move_uploaded_file($nombre_temporal,'../assets/img/'.$nombre);
move_uploaded_file($nombre_temporal, $destino);

?>