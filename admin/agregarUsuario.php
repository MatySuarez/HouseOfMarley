<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        $usuario = $_POST['usuario2'];
        $nombre = $_POST['nombre2'];
        $clave = $_POST['clave2'];
        $clave1 = password_hash($clave, PASSWORD_DEFAULT);
        $rol = $_POST['rol2'];
        $usuariosreg = mysqli_query($conexion, "SELECT usuario FROM usuarios");
        $repetido = false;
        foreach($usuariosreg as $usuariosr) {
            if($usuariosr['usuario']== $usuario){
                $repetido = true; 
                echo "$usuario";
            }; 
        };
        if($repetido == false){
            $query = mysqli_query($conexion, "INSERT INTO usuarios(usuario, nombre, clave, rol) VALUES ('$usuario', '$nombre', '$clave1' , '$rol')");
        };
    return $repetido;
    };
};

?>
