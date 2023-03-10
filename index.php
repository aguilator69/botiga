<?php
session_start();
include 'connexio.php';
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
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/frutas.jpg" height="700px" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            
                            <div class="col-12 m-0 row d-flex justify-content-between">
                            <form action="" class="border-2px-white" method="post">
                                <?php

                                    

                                    if (isset($_REQUEST["entrar"])) {
                                        
                                        $email=$_REQUEST["email"];
                                        $contra=md5($_REQUEST["contra"]);
                                        $sql = "select * from usuari where email='$email' and password = '$contra'";
                                        
                                        $r=mysqli_query($connexio, $sql);
                                        
                                        if(mysqli_affected_rows($connexio)==1){
                                            echo"despues if";
                                            while ($fila = mysqli_fetch_assoc($r)){
                                                echo"dentro de while";
                                                if($fila["admin"]==1){
                                                    echo "admin";
                                                    $_SESSION["admin"]=1;
                                                    $_SESSION["nom"]=$fila["nom"];
                                                    $_SESSION["email"]=$fila["email"];
                                                    header("location:crearP.php");
                                                }else{
                                                    echo"client";
                                                    $_SESSION["admin"]=0;
                                                    $_SESSION["nom"]=$fila["nom"];
                                                    $_SESSION["email"]=$fila["email"];
                                                    header("location:client.php");
                                                }
                                            }
                                        }
                                        

                                    }
                                ?>
                                    <h3 class="text-light mb-5">Login</h3>
                                    
                                    
                                        <label class="mb-1">Email</label>

                                        <input type="text" class=" col-12 mb-5 py-1" name="email" placeholder="Usuario">
                                   

                                    
                                        <label class="mb-1">Contraseña</label>
                                        <input type="password" class="col-12 py-1 mb-5" name="contra" placeholder="Contraseña">
                                        <p class="text-center"><a href="registre.php" class="text-success">Registrate</a></p>
                                        <input type="submit" class="btn col-12 btn-success py-2" name="entrar">
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