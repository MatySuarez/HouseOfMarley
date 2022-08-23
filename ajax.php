<?php
require_once "config/conexion.php";
if (isset($_POST)) {
    if ($_POST['action'] == 'buscar') {
        $array['datos'] = array();
        $total = 0;
        for ($i=0; $i < count($_POST['data']); $i++) { 
            $id = $_POST['data'][$i]['id'];
            $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
            $result = mysqli_fetch_assoc($query);
            $data['id'] = $result['id'];
            if($result['precio_rebajado'] == 0){
                $data['precio'] = $result['precio_normal'];
                $data['precio_final'] = $result['precio_normal'];
            }else{
                $data['precio'] = $result['precio_rebajado'];
                $data['precio_final'] = $result['precio_rebajado'];
            }
            $data['nombre'] = $result['nombre'];
            $total = $total + $data['precio_final'];
            array_push($array['datos'], $data);
        }
        $array['total'] = $total;
        echo json_encode($array);
        die();
    }
}

?>