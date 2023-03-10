<?php 
session_start();
if (isset($_REQUEST["salir"])) {
    session_destroy();
    header("location:index.php");
}



include 'connexio.php';

if($_SESSION["admin"]==1){


if (!empty($_POST["modificarP"])) {
    $nom = $_REQUEST["MNombre"];
    $preu = $_REQUEST["MPrecio"];
    $descripcio = $_REQUEST["MDescripcion"];
    $stock = $_REQUEST["MStock"];
    
    $idP=$_REQUEST["idP"];
    if ($_FILES["MImagen"]["tmp_name"]==NULL) {
        
        $sql="UPDATE producte
        SET nom='$nom', descripcio='$descripcio',preu='$preu', stock='$stock'
        WHERE codiProducte='$idP'";
    
       
    } else {
        
    
    
        $dadesImatge=file_get_contents($_FILES["MImagen"]["tmp_name"]);
        $tipusImatge=$_FILES["MImagen"]["type"];
        
        $dadesImatge= mysqli_real_escape_string($connexio, $dadesImatge);
        
    
        $sql="UPDATE producte
        SET nom='$nom', descripcio='$descripcio',preu='$preu', stock='$stock', dadesImatge='$dadesImatge', tipusImatge='$tipusImatge'
        WHERE codiProducte='$idP'";
    }
    mysqli_query($connexio, $sql);

    
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GYMSTER - Gym HTML Template</title>
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

<body class="bg-secondary">
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
    <?php
    if (!empty($_POST["ElegirP"])) {
          ?>
              <div class="row p-5 g-0">
            <div class="col-lg-9 mx-auto">
                <div class="bg-success rounded p-5">
                    <h3 class="text-light text-uppercase text-center mb-4">Modificant "<?php 
                            $sql = "SELECT * FROM producte where codiProducte='".$_POST["nomMP"]."'";
                            $r = mysqli_query($connexio, $sql);
                            while ($fila = mysqli_fetch_assoc($r)) {
                                echo "".$fila["nom"];
                            }
                        ?>"
                    </h3>
      
                    <form class='mx-auto text-center ' method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            
                            <div class="col-6 mx-auto">
                                <h6 for="" class="text-light  py-2 my-auto fs-5">Nom:</h6>
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Nom" name="MNombre"  style="height: 55px;"
                                <?php
                                $sql = "SELECT * FROM producte where codiProducte ='".$_POST["nomMP"]."' ";
                                $r = mysqli_query($connexio, $sql);
                                while ($fila = mysqli_fetch_assoc($r)) {
                                    echo"value=".$fila["nom"];
                                    
                                }
                                
                                ?>
                                >
                            </div>

                            <div class="col-6 mx-auto">
                                <h6 for="" class="text-light  py-2 my-auto fs-5">Preu:</h6>
                                <input type="number" class="form-control bg-light border-0 px-4" placeholder="Preu" step="0.01" name="MPrecio"  style="height: 55px;"
                                <?php
                                $sql = "SELECT * FROM producte where codiProducte ='".$_POST["nomMP"]."' ";
                                $r = mysqli_query($connexio, $sql);
                                while ($fila = mysqli_fetch_assoc($r)) {
                                    echo"value=".$fila["preu"];
                                    
                                }
                                
                                ?>
                                >
                            </div>
                            
                            <div class="col-12">
                            <h6 for="" class="text-light  py-2 my-auto fs-5">Descripcio:</h6>
                                <textarea class="form-control bg-light border-0 px-4 py-3" rows="4" name="MDescripcion"  placeholder="Descripcio"><?php
                                $sql = "SELECT * FROM producte where codiProducte ='".$_POST["nomMP"]."' ";
                                $r = mysqli_query($connexio, $sql);
                                while ($fila = mysqli_fetch_assoc($r)) {
                                    echo "".$fila["descripcio"];
                                    
                                }
                                ?></textarea>
                            </div>
                            
                            <div class="col-6 mx-auto">
                                <h6 for="" class="text-light  py-2 my-auto fs-5">Stock:</h6>
                                <input type="number" class="form-control bg-light border-0 px-4" placeholder="Stock" name="MStock"  style="height: 55px;"
                                <?php
                                $sql = "SELECT * FROM producte where codiProducte ='".$_POST["nomMP"]."' ";
                                $r = mysqli_query($connexio, $sql);
                                while ($fila = mysqli_fetch_assoc($r)) {
                                    echo"value=".$fila["stock"];
                                    
                                }
                                
                                ?>
                                >
                            </div>

                            <div class="col-6  mx-auto">
                                <h6 for="" class="text-light  py-2 my-auto fs-5">Imatge:</h6>
                                <div class="my-auto py-2 px-1 text-start">
                                <input  type="file" name="MImagen" id="" class=" border-0 text-light" >
                            </div>
                            </div>
                            <?php
                                $sql = "SELECT * FROM producte where codiProducte ='".$_POST["nomMP"]."' ";
                                $r = mysqli_query($connexio, $sql);
                                while ($fila = mysqli_fetch_assoc($r)) {

                                    echo "<div class='mx-auto py-3 text-center'><img class='mx-auto' height='250px' width='200px' src=\"data:".$fila["tipusImatge"].";base64,".base64_encode($fila["dadesImatge"])."\"></div>";
                                }
                                echo "<input type='hidden' name='idP' value='".$_POST["nomMP"]."'>";
                            ?>
                            <div class="col-12">
                                <input type="submit" class="btn btn-light text-success w-100 py-3" name="modificarP"  value="Modificar producte">
                            </div>
                        </div>
                    </form>
                      
                    
                  </div>
                </div>
              </div>
      
          <?php
              }else{
      
          ?>
    <div class="row p-5  g-0 ">
            <div class="col-lg-9  mx-auto">
                <div class="bg-success rounded p-5">
                <h3 class="text-light text-uppercase ">Eliminar Producte</h3>
                    <form method="post" enctype="multipart/form-data">
                        
                        <div class='row p-0 bg-success rounded d-flex justify-content-center'>
                        <?php
                            $sql = "SELECT * FROM producte order by codiProducte DESC";
                            $r = mysqli_query($connexio, $sql);

                            while ($fila = mysqli_fetch_assoc($r)) {

                                echo"<div class='col-6 py-2 my-2'><div class='d-flex overflow-hidden col-12 bg-light col-2 h2 rounded  py-3'> <input class='form-check-input my-auto ms-3' type='radio' name='nomMP' value=".$fila["codiProducte"]." required><div class='flex-shrink-0 text-center text-secondary border-end border-secondary pe-3 mx-3 my-auto'><p class='h5 my-auto'>".$fila["codiProducte"]."</p> </div ><h5 class='my-auto'>".$fila["nom"]."</h5> </div></div>";
                                
                                
                            }
                            
    ?>
                        </div>
                        <div class="col-12">
                                <input type="submit" class="btn btn-light text-success w-100 py-3" name="ElegirP"  value="Seleccionar Producte">
                        </div>
                    </form>
                </div>
            </div>
    </div>

    <?php
              }
    ?>

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
}else{
    header("location:index.php");
}
?>