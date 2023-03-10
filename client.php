<?php 
 session_start();
 include 'connexio.php';
 
 if (isset($_REQUEST["salir"])) {
     session_destroy();
     header("location:index.php");
 }

if($_SESSION["admin"]==0){
 if(!empty($_SESSION["arrayP"])){
   
    $arrayP=$_SESSION["arrayP"];
    
 }else{
    $arrayP=[];
 }

 if(!empty($_REQUEST["select"])&&!empty($_REQUEST["busqueda"])&&!empty($_REQUEST['paginacio'])){
    $inici=0;

}else if (isset($_REQUEST['paginacio']) ) {
    
    $inici=$_REQUEST['paginacio'];
}else{
    $inici=0;
}
$lineas=2;

if (isset($_POST["anadir"])) {
    $id=$_POST["idP"];
    array_push($arrayP,$id);
    $_SESSION["arrayP"]=$arrayP;
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
                            <a href="finalitzarCompra.php" class="nav-item  my-auto  nav-link ">Finalitzar Compra</a>
                        
                            
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
                     
                        $sql = "SELECT * FROM producte  order by codiProducte DESC limit $inici,$lineas";
                        $r = mysqli_query($connexio, $sql);
                    
                    $impresos=0;
                    while ($fila = mysqli_fetch_assoc($r)) {
                        $enCesta=0;
                        
                            
                        
                        for ($i=0; $i < count($arrayP) ; $i++) { 
                            if ($arrayP[$i]==$fila["codiProducte"]) {
                                $enCesta++;
                            }
                        }
                    
                        $resta=$fila["stock"]-$enCesta;
                        if ($resta<=0) {
                            $botonAnadir= "<div name='anadir'  class='btn btn-success py-md-3 px-md-5 me-3 text-uppercase text-light text-center col-12'>Sin stock</div>";
                            
                        }else{
                            $botonAnadir=" <input name='anadir' type='submit' class='btn btn-success py-md-3 px-md-5 me-3 col-12 text-uppercase text-light' value='Afegir a cistella'>";
                            
                        }
                        $stock=$resta;
                        $impresos++;
                        echo"<div class='col-md-12'>
                        <div class=''>
                            <div class='bg-success d-flex align-items-center rounded-top p-4'>
                                
                                <div class='d-flex justify-content-between col'>
                                
                                    <span class='h5 text-uppercase text-light my-auto' href=''> Codi: ".$fila["codiProducte"]." - ".$fila["nom"]."</h4></span>
                                    <div class='d-flex justify-content-between col-7'>
                                    <span class='h5 text-uppercase text-light my-auto ms-3'> Preu: ".$fila["preu"]."€ </span>
                                    <span class='h5 text-uppercase text-light my-auto'> Stock: ".$stock."</span>
                                    </div>
                                </div>
                            </div>
                            <div class=' d-flex   bg-light'>
                                <div class='position-relative blog-item overflow-hidden  col-5'>
                                    <img class='img-fluid w-100 rounded-start' src=\"data:".$fila["tipusImatge"].";base64,".base64_encode($fila["dadesImatge"])."\" alt=''>
                                </div>
                                <div class='col p-4 d-flex flex-column justify-content-between'>
                                    
                                    <p class='h6 my-auto text-uppercase text-justify'>".$fila["descripcio"]."</p>
                                    <form method='POST' class='col-12'>
                                    <input type='hidden' name='idP' value='".$fila["codiProducte"]."'>
                                   ".$botonAnadir."
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>";
                        
                    }
                    
                    mysqli_close($connexio);

                    if ($impresos==0 && $inici==0) {
                        echo"<div class='col-md-12'>
                            <p class='h1 text-uppercase text-center'>Sense resultat</p>
                        </div>";
                    }else{
                        ?>
                        <section class='col-md-12 d-flex justify-content-between'>
                        <?php
                        if ($inici==0 ) {
                            echo"<p class='my-auto'>Anteriors<p>";
                        }else if (!empty($_REQUEST["select"])) {
                            $anterior=$inici-$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$anterior&select=".$_REQUEST["select"]."\">Anteriors</a>";
                        }else if (!empty($_REQUEST["lupa"])) {
                            $anterior=$inici-$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$anterior&lupa=".$_REQUEST["lupa"]."&busqueda=".$_REQUEST["busqueda"]."\">Anteriors</a>";
                        }else {
                            $anterior=$inici-$lineas;
                            echo"<a  class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$anterior\">Anteriors</a>";
                        }
                        if ($lineas==$impresos && !empty($_REQUEST["select"])) {
                            $proper=$inici+$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$proper&select=".$_REQUEST["select"]."\">Següents</a>";
                        
                        }else if ($lineas==$impresos && !empty($_REQUEST["lupa"])) {
                            $proper=$inici+$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$proper&lupa=".$_REQUEST["lupa"]."&busqueda=".$_REQUEST["busqueda"]."\">Següents</a>";
                        
                        }else  if(empty($_REQUEST["select"])&&empty($_REQUEST["lupa"])&&$lineas==$impresos){
                            $proper=$inici+$lineas;
                            echo"<a class='btn btn-primary py-md-3 px-md-5 me-3' href=\"client.php?paginacio=$proper\">Següents</a>";
                        
                        } else {
                            echo"<div><p class='my-auto '>Següents<p></div>";
                        }
                        
                    }

                    
                    
                    ?>
                    </section>
                  
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