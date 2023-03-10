<?php
include "connexio.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>botiga2023</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg-12 bg-success d-none d-lg-block">
                <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-4 text-primary text-center  text-light py-5 ">Botiga</h1>
                </a>
            </div>
            
        </div>
    </div>
    <!-- Header End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 ">
        <div id="carousel" class="carousel " data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/frutas.jpg" height="650px" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 col-10" >
                            
                            <div class="col-12 m-0 row d-flex justify-content-around">
                            <form action="" class="border-2px-white" enctype="multipart/form-data" method=post>
                                <?php

                                    if (isset($_REQUEST["registrar"])) {
                                        
                                        $email=$_REQUEST["email"];
                                        $contra=md5($_REQUEST["contra"]);
                                        $nombre=$_REQUEST["nombre"];
                                        $apellidos=$_REQUEST["apellidos"];
                                        $direccion=$_REQUEST["direccion"];
                                        $poblacion=$_REQUEST["poblacion"];
                                        $cPostal=$_REQUEST["cPostal"];
                                        $foto=file_get_contents($_FILES["UImagen"]["tmp_name"]);
                                        $tipus=$_FILES["UImagen"]["type"];
    
                                        $foto= mysqli_real_escape_string($connexio, $foto);

                                        $sql = "INSERT INTO usuari(email, password, nom, cognoms, direccio, poblacio, cPostal, dadesFoto, tipusFoto, admin) VALUES('$email', '$contra', '$nombre','$apellidos','$direccion','$poblacion','$cPostal','$foto','$tipus',0)";

                                        mysqli_query($connexio, $sql);

                                        if (mysqli_affected_rows($connexio) == 1) {
                                            echo '<script language="javascript">alert("Usuario creado");window.location.href="index.php"</script>';
                                        } else {
                                            echo '<script language="javascript">Usuario no creado, correo ya registrado;</script>';
                                        }

                                    }
                                ?>
                                <h3 class="text-light mb-5 text-center">Registro</h3>
                                
                                    <div class="d-flex justify-content-around">
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Email</label>
                                            <input type="email" class="  mb-5 py-1" name="email" placeholder="Usuario" required>
                                        </div>
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Nueva contraseña</label>
                                            <input type="password" class=" py-1 mb-5" name="contra" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Nombre</label>
                                            <input type="text" class=" py-1 mb-5" name="nombre" placeholder="Nombre" required>
                                        </div>
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Apellidos</label>
                                            <input type="text" class=" py-1 mb-5" name="apellidos" placeholder="Apellidos" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Dirección</label>
                                            <input type="text" class=" py-1 mb-5" name="direccion" placeholder="Dirección" required>
                                        </div>
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Población</label>
                                            <input type="text" class=" py-1 mb-5" name="poblacion" placeholder="población" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Código Postal</label>
                                            <input type="number" class=" py-1 " name="cPostal"  placeholder="XXXXX" required>
                                        </div>
                                        <div class="d-flex flex-column col-5">
                                            <label class="mb-1">Imagen perfil</label>
                                            <input type="file" class=" py-1  " name="UImagen" required>
                                        </div>
                                        </div>
                                    <p class="text-center h6 p-3"><a href="index.php" class="text-success">Login</a></p>
                                
                                    <input type="submit" class="btn col-11 btn-success py-2" value="Registrarse" name="registrar">
                                </div>
                            </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
    <!-- Carousel End -->


    
    

    

   

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>