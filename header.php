<?php

session_start();

//if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
//{
  //  header("location: login.php");
//}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>HerbsBazaar</title>
        <!-- Bootstarp -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Owl Cara-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
        <!-- Font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
        <link rel="stylesheet" href="style.css">
        <?php
        require('./functions.php');
        
        ?>
      </head>
<body>
    <!--Header-->
    <header id="header">
        <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
            <p class="font-rale font-size-12 text-black-50 m-0">Oswal Indoglobal Ventures G-1 Roopal Regency, Bangali Square,Indore</p>
        <div class="font-rale font-size-14">
            <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
               echo '<a href="login.php" class="px-3 border-right border-left text-dark">Login</a>';
             }else{ 
              echo "Hello ".$_SESSION['first_name'];
             }
            ?>
               <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
            echo'<a href="register.php" class="px-3 border-right border-left text-dark">Sign Up</a>';
            }else{
              echo'<a href="logout.php" class="px-3 border-right border-left text-dark">Logout</a>';
            }
            ?>        

        </div>
        </div>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">HerbsBazaar.com</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
           
            <ul class="navbar-nav m-auto font-rubik">
             
              <li class="nav-item ">
                  <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Products <i class="fas fa-chevron-down"></i></a>
                </li>
                <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
                
                }else{
                  echo'<li class="nav-item"><a class="nav-link" href="my_order.php">My Orders</a></li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">Contact Us</a>
                </li>
              </ul>
           
              <form class="form-inline my-2 my-lg-0 mx-5" method="post" action="search.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_str">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
    </form>
              <form action="#" class="font-size-14 font-rale">
                  <a href="cart.php" class="py-2 bg-secondary rounded">
                      <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                      <span class="px-3 py-2 text-light bg-success rounded"><?php echo $Cart->totalProduct(); ?></span>
                  </a>
              </form>
            </div>
          </nav>
          <!--!Navbar-->
    </header>
    <!--!Header-->
    <!--Main-->
    <main id="main-site">