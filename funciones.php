<?php

function obtenerProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT productos.id, productos.nombre, productos.precio_normal, productos.precio_rebajado, productos.cantidad, productos.imagen, productos.id_categoria
     FROM productos
     INNER JOIN carrito_usuarios
     ON productos.id = carrito_usuarios.id_producto
     WHERE carrito_usuarios.id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}

function obtenerCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT carrito_usuarios.id_producto, carrito_usuarios.cantidad
     FROM carrito_usuarios
     WHERE carrito_usuarios.id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}


function quitarProductoDelCarrito($idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("DELETE FROM carrito_usuarios WHERE id_sesion = ? AND id_producto = ?");
    return $sentencia->execute([$idSesion, $idProducto]);
}

function obtenerAuriculares($desde , $registros_por_pagina)
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT * FROM productos  WHERE id_categoria = 10 LIMIT $desde, $registros_por_pagina;");
    return $sentencia->fetchAll();
}
function obtenerParlantes($desde,$registros_por_pagina)
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT * FROM productos  WHERE id_categoria = 11 LIMIT $desde, $registros_por_pagina;");
    return $sentencia->fetchAll();
}
function obtenerBandejas($desde,$registros_por_pagina)
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT * FROM productos  WHERE id_categoria = 12 LIMIT $desde, $registros_por_pagina;");
    return $sentencia->fetchAll();
}

function obtenerCategorias()
{
    $bd = obtenerConexion();
    $sentencia2 = $bd->query("SELECT id, categoria FROM categorias");
    return $sentencia2->fetchAll();
}

function productoYaEstaEnCarrito($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarrito();
    foreach ($ids as $id) {
        if ($id == $idProducto) return true;
    }
    return false;
}

function obtenerIdsDeProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT id_producto, cantidad FROM carrito_usuarios WHERE id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function agregarProductoAlCarrito($idProducto)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("INSERT INTO carrito_usuarios(id_sesion, id_producto, cantidad) VALUES (?, ?, ?)");
    return $sentencia->execute([$idSesion, $idProducto, "1"]);
}


function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM productos WHERE id = ?");
    return $sentencia->execute([$id]);
}

function guardarProducto($nombre, $precio)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productos(nombre, precio,) VALUES(?, ?, ?)");
    return $sentencia->execute([$nombre, $precio ]);
}


function cantidadCarrito($cant, $id)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("UPDATE carrito_usuarios SET cantidad ='$cant' WHERE id_producto = '$id' ");
    $idSesion = session_id();
    return $sentencia->execute();
}

function buscarCantidad($idProducto)
{
    $carritos = obtenerCarrito();
    foreach ($carritos as $carrito) {
        if ($carrito->id_producto == $idProducto) {
            echo $carrito->cantidad;
        }
    }
}

function buscarCantidad2($idProducto)
{
    $cant3 = 1;
    $carritos = obtenerCarrito();
    foreach ($carritos as $carrito) {
        if ($carrito->id_producto == $idProducto) {
            $cant3 = $carrito->cantidad;
            return $cant3;
        }
    }
}

function obtenerVariableDelEntorno($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}
function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}