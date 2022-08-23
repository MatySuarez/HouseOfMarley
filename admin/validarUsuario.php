<?php
require_once "../config/conexion.php";


function validarUsuario(){
    $usuario = $_POST['usuario'];
        $usuariosreg = mysqli_query($conexion, "SELECT usuario FROM usuarios");
        $repetido = false;
        foreach($usuariosreg as $usuariosr) {
            if($usuariosr['usuario']== $usuario){
                $repetido = true; 
                ?>
                <script>
                    e.preventDefault();
                    alert('El usuario no se encuentra disponible');
                </script>
                <?php
            } 
        };
    return $repetido;
};

?>