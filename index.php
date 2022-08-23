<?php require_once "header.php"; ?>
<?php require_once "config/conexion.php"; ?>


<html>

<body>

    <main>
        <div class="shg-box-vertical-align-wrapper">
            <img src="img/marco.png" alt="marco" width="100%">
        </div>
        <div id="container" style="padding-bottom:42.5%; position:relative ; display: block; width: 100%;">
            <iframe id="PVXL-ANC-home" width="100%" height="100%"
                src="https://player.vimeo.com/video/717693026?autoplay=1&loop=1?autoplay=1&muted=1"
                frameborder="0" allowfullscreen style="position: absolute; top:0; left:0"></iframe>
        </div>
    </main>
    <section class="container">
        <div>
            <h1 class="container text-center  text-decoration-none mt-5 mb-5 fs-1 fw-bolder ">
                AMPLIFICA TUS SENTIDOS
            </h1>
        </div>
        <section class="container-fluid ">
            <div class="container mt-5 mb-5 ">
                <div class=" justify-content-lg-around row">
                    <div class="text-center col-lg-4">
                        <a href="auriculares.php"><img src="grilla/auriculares.png"
                                style="border: 1px solid black;" alt="auriculares"></a>
                    </div>
                    <div class="text-center col-lg-4">
                        <a href="parlantes.php"><img src="grilla/parlantes.png"
                                style="border: 1px solid black;" alt="parlantes"></a>
                    </div>
                    <div class="text-center col-lg-4">
                        <a href="bandejas.php"><img src="grilla/bandejas.jpg"
                                style="border: 1px solid black;" alt="bandejas"></a>
                    </div>
                </div>
            </div>
        </section>

    </section>
    <section>
        <div class="container">
            <div>
                <a href="proyecto.php"><img src="img/bob marley.png" alt="marley" width="100%" vh="100%"
                        style="border: 1px solid black;"></a>
            </div>
            <div class="row text-center mt-5">
                <span class="fs-2 fw-bolder">NUESTRA MISIÓN</span>
                <span class="fw-bold">La identidad ecológica de House of Marley se creó en colaboración con la familia
                    Marley para continuar el legado de amor de Bob Marley por la música y el planeta. Apoyamos la
                    reforestación global y la preservación de los océanos a través de asociaciones con One Tree Planted
                    y Surfrider.</span>
                <a href="proyecto.php"><span class=" fw-bold bg-dark">APRENDE MAS</span></a>
            </div>
        </div>
    </section>
    <section class=" container  mt-5  ">
        <div class="  justify-content-center row mt-5">
            <a class="d-flex justify-content-center" href="materiales.html"><iframe width="800px"
                    height="450px" src="img/materials.gif" frameborder="0"></iframe></a>
        </div>
        <div class="row text-center ">
            <span class="fs-2 fw-boder">LOS MATERIALES IMPORTAN</span>
            <span class="fw-bold">Los productos de House of Marley están elaborados con materiales de origen
                consciente.</span>
            <a href="materiales.php"><span class=" fw-bold bg-dark">APRENDE MAS</span></a>
        </div>
    </section>
    <section class=" container mt-5  mb-5">
        <div class=" justify-content-center row mt-5">
            <iframe width="700px" height="480px" src="https://www.youtube.com/embed/mvLBac_WAqI"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </section>
    

    <?php require_once "footer.php"; ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</html>