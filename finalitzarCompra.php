<?php 
 session_start();
 include 'connexio.php';
 
 if (isset($_REQUEST["salir"])) {
     session_destroy();
     header("location:index.php");
 }

if($_SESSION["admin"]==0){

if (!empty($_SESSION["arrayP"])) {
    $arrayP=$_SESSION["arrayP"];
    
}

if (isset($_POST["comprar"])) {
    $sql = "SELECT * FROM producte ";
    $r = mysqli_query($connexio, $sql);
    $sinStock=false;
    while ($fila = mysqli_fetch_assoc($r)) {
        $enCesta=0;          
                            
        for ($i=0; $i < count($arrayP); $i++) { 
            if ($arrayP[$i]==$fila["codiProducte"]) {
                $enCesta++;
            }
        }
        if ($enCesta>$fila["stock"]) {
            $sinStock=true;
        }
        
    }

    if ($sinStock) {
        echo"<script>alert('No hi ha Stock suficient per la teva cistella')</script>";
    }else{
        $sql = "SELECT * FROM producte ";
        $r = mysqli_query($connexio, $sql);
        $sinStock=false;
        while ($fila = mysqli_fetch_assoc($r)) {
            $enCesta=0;          
                                
            for ($i=0; $i < count($arrayP); $i++) { 
                if ($arrayP[$i]==$fila["codiProducte"]) {
                    $enCesta++;
                }
            }
            $resta=$fila["stock"]-$enCesta;
            $sql = "UPDATE producte SET stock=$resta  where codiProducte=".$fila["codiProducte"]."";
            $r2 = mysqli_query($connexio, $sql);
            
        }

        
        $email=$_SESSION["email"];
        $sql = "INSERT INTO compra (data,email) VALUES(SYSDATE(),'$email') ";
        $r = mysqli_query($connexio, $sql);

        $sql="SELECT * FROM compra ORDER BY codiCompra DESC LIMIT 1";
        $r = mysqli_query($connexio, $sql);
        
        $codiCompra=0;
        while ($fila = mysqli_fetch_assoc($r)) {
            $codiCompra=$fila["codiCompra"];
        }

       for ($i=0; $i <count($arrayP) ; $i++) { 
        $sql = "INSERT INTO comanda (codiCompra,codiProducte) values('$codiCompra','".$arrayP[$i]."') ";
        $r = mysqli_query($connexio, $sql);
       }

       

       $_SESSION["arrayP"]=[];

       echo "<script>alert('Compra realitzada!')</script>";
    }
}
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

<body class=''>
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
                        <div class="navbar-nav mr-auto py-0 ">
                         
                            <a href="client.php" class="nav-item nav-link ">Productes</a>
                            <a href="finalitzarCompra.php" class="nav-item  my-auto text-light nav-link ">Finalitzar Compra</a>
                        
                            
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

    <!-- Blog Start -->
    <div class="container-fluid p-5">
        <div class="row g-5">
        <div class="col-lg-8 mx-auto">
                <div class="row g-5">
                    <?php 
                        if (!empty($_SESSION["arrayP"])) {
                    
                    ?>
                    <div class="col-12 d-flex">
                        <div class="col-5">
                            <p class="h4 text-center">Producte</p>
                        </div>
                        <div class="col-2">
                            <p class="h4 text-center">Preu</p>
                        </div>
                        <div class="col-2">
                            <p class="h4 text-center">Quantitat</p>
                        </div>
                        
                        <div class="col-3">
                        <p class="h4 text-center">Preu total:</p>
                        </div>
                    </div>
                    <?php 
                     
                        $sql = "SELECT * FROM producte ";
                        $r = mysqli_query($connexio, $sql);
                    
                    $impresos=0;

                    $precioTotal=0;
                    while ($fila = mysqli_fetch_assoc($r)) {
                        $enCesta=0;
                        
                            
                        for ($i=0; $i < count($arrayP); $i++) { 
                            if ($arrayP[$i]==$fila["codiProducte"]) {
                                $enCesta++;
                            }
                        }
                        if ($enCesta>0) {
                            $impresos++;

                            echo"
                            <div class=' d-flex   bg-light py-2'>
                                    <div class=' col-5 text-center' style='height:200px'>
                                        <img class='img-fluid  h-100 rounded' src=\"data:".$fila["tipusImatge"].";base64,".base64_encode($fila["dadesImatge"])."\" alt=''>
                                    </div>
                                    <div class='col-2 my-auto'>
                                        
                                        <p class='h6 my-auto text-uppercase text-center'>".$fila["preu"]." ???</p>
                                        
                                    </div>
                                    <div class='col-2 my-auto'>
                                        
                                        <p class='h6 my-auto text-uppercase text-center'>$enCesta</p>
                                        
                                    </div>
                                    <div class='col-3 my-auto'>
                                        
                                        <p class='h6 my-auto text-uppercase text-center'>".$fila["preu"]*$enCesta." ???</p>
                                        
                                    </div>
                            </div>";

                            $precioTotal+=$fila["preu"]*$enCesta;
                        }
                       
                        
                        
                    }
                
                    if ($impresos>0) {
                        echo"<form method='POST' class='col-12'>
                        <input name='comprar' type='submit' class='btn btn-success py-md-3 px-md-5 me-3 col-12 text-uppercase text-light' value='Comprar per $precioTotal ???'>
                       </form>";
                    }
                    
                    mysqli_close($connexio);

                }else{
                    echo"<div class='col-md-12'>
                            <p class='h1 text-uppercase  text-center'>Cap producte seleccionat</p>
                        </div>";
                }

                    
                    
                    ?>
                    
                  
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark py-3 fs-4 back-to-top col-1"><i class="bi bi-arrow-up"></i></a>

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
?>