<?php require_once "config/conexion.php"; ?>
<?php require_once "header.php"; ?>
<?php 
      if (isset($_POST)) {
        if (!empty($_POST)) {	    
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
	    $email = $_POST['email'];
        $comentario = $_POST['comentario'];
	    $consulta = "INSERT INTO contacto(nombre, telefono, email, comentario) VALUES ('$nombre','$telefono','$email','$comentario')";
	    $resultado = mysqli_query($conexion,$consulta);
	    
    }   
 } 
 
?>

<html lang="en">

<body>

    <main style="background-image: url(img/fondo_contacto.jpg);background-size:cover; height: 100vh;">
        <div class="d-flex justify-content-center align-items-center" style="height: 10rem;">
            <div class="container text-center">
                <h2 class="fs-1">Contacto</h2>
            </div>
        </div>
        <div class="container m-auto p-3 mb-5"
            style="width: 80%; background-color: rgba(179, 161, 161, 0.6);border-radius: 20px;">
            <h3>Formulario de contacto:</h3>
            <form action="" method="POST" autocomplete="off" id="formularioContacto">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="name" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder=""
                        required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Teléfono</label>
                    <input type="number" name="telefono" class="form-control" id="exampleFormControlInput1"
                        placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder=""
                        required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios</label>
                    <textarea class="form-control" name="comentario" id="exampleFormControlTextarea1" rows="3"
                        required></textarea>
                </div>
                <div>
                    <input class="bg-primary" id="enviar" type="submit" style="border-radius: 6px;" value="Enviar consulta">
                </div>
            </form>
        </div>

    </main>


    <?php require_once "footer.php"; ?>
    <script>
    $(document).on('click', '#enviar', function() {
        alert('El formulario se ha enviado correctamente!');

    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>