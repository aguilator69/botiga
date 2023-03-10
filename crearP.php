<?php 
session_start();
include 'connexio.php';

if (isset($_REQUEST["salir"])) {
    session_destroy();
    header("location:index.php");
}


if($_SESSION["admin"]==1){
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

<body class="">
    <!-- Header Start -->
    <div class="container-fluid bg-success px-0">
        <div class="row gx-0">
            <div class="col-lg-3 bg-success d-none d-lg-block">
                <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-4 text-light ">BOTIGA</h1>
                </a>
            </div>
            <div class="col-lg-9">
                
            <nav class="navbar navbar-expand-lg bg-success navbar-dark p-3 p-lg-0 px-lg-5">
                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary text-uppercase">Botiga</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Admin</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="crearP.php" class="dropdown-item ">Crear Producte</a>
                                    <a href="borrarP.php" class="dropdown-item ">Eliminar Producte</a>
                                    <a href="modificarP.php" class="dropdown-item">Modificar Producte</a>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <div>
                            <form action="" method="POST">
                                <input name="salir" type="submit" class='btn btn-light py-md-3 px-md-5 me-3 text-uppercase text-success' value="Log out">
                            </form>
                        </div>
                       
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="row  p-5 g-0">
            <div class="col-lg-9 mx-auto">
                <div class="bg-success rounded p-5">
                <h3 class="text-light text-uppercase mb-4">Crear Producte</h3>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Nom" name="CNombre" required style="height: 55px;">
                            </div>
                            <div class="col-6">
                            <input type="number" class="form-control bg-light border-0 px-4" placeholder="Preu ej:2,34" name="CPrecio" step="0.01" required style="height: 55px;">
                            
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-light border-0 px-4 py-3" rows="4" name="CDescripcion" required placeholder="Descripcio"></textarea>
                            </div>
                            
                            <div class="col-6">
                                <input type="number" class="form-control bg-light border-0 px-4" name="CStock" required placeholder="Stock" style="height: 55px;">
                            </div>

                            <div class="col-6 d-flex my-auto pt-3">
                                <label for="" class="text-light  pe-4 my-auto fs-5">Imatge:</label>
                                <input type="file" name="CImagen" id="" class="border-0 text-light" required>
                            </div>
                            <div class="col-12">
                                <input type="submit" class="btn btn-light text-success w-100 py-3" name="CProducto"  value="Crear Producte">
                            </div>
                        </div>
                    </form>
                    <?php
                    
                    if (!empty($_POST["CProducto"])) {
                        
    $nom = $_REQUEST["CNombre"];
    $descripcio = $_REQUEST["CDescripcion"];
    $preu = $_REQUEST["CPrecio"];
    $stock=$_REQUEST["CStock"];
    $dadesImatge=file_get_contents($_FILES["CImagen"]["tmp_name"]);
    $tipusImatge=$_FILES["CImagen"]["type"];
    
    $dadesImatge= mysqli_real_escape_string($connexio, $dadesImatge);

    
    $sql = "INSERT INTO producte(nom, descripcio, preu, stock, dadesImatge,tipusImatge) VALUES('$nom', '$descripcio','$preu', '$stock','$dadesImatge','$tipusImatge')";

    mysqli_query($connexio, $sql);

    if (mysqli_affected_rows($connexio) == 1) {
        echo "<p class='text-info text-center p-3'>PRODUCTE CREAT</p>";
    } else {
        echo "<p class='text-info text-center p-3'>ERROR EN INSERT</p>";
    }
}
?>
                </div>
            </div>

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
<?php
}
else{
    header("location:index.php");
}