<?php 
    session_start();
    error_reporting(0);
include('../includes/config.php');
include('../includes/configs.php');
include('../includes/helpers.php');
if (empty($_SESSION['login']))
{
    header("location:../login.php");
}

     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
         header('location:dashboard.php');
         exit();
     }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../style.css?version=4">
    <link rel="icon" type="image/svg" sizes="32x32" href="../images/LOGO.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>SIKU FURNITURE HOME</title>
</head>
<body class="indexBody">
    <header>
        <nav class="initialNav">
            <ul>
                <li>
                    <?php if(strlen($_SESSION['login'])){ ?>
                    Welcome <?php echo htmlentities($_SESSION['username']);?><?php } ?> 
                </li>
                <li>
                    <a href="profile.php">My Account</a>
                </li>
                <li>
                    <a href="wishlist.php">Wishlist</a>
                </li>
            </ul>
            <div>
                <a class="loginBtn" href="track.php">Track Order</a>
                <a class="registerBtn" href="logout.php">Logout</a>
            </div>
        </nav>
        <ul class="searchNav">
            <li>
                <img src="../images/LOGO.svg">
            </li>
            <li class="cartLi">
                <p>CART
                    <span>0.00</span>
                </p>
                <a href="cart.php" style="color:#ffffff">
                    <i class="fa fa-shopping-cart cart"></i>
                    <?php 
                        echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']):'';
                    ?>
                </a>
            </li>
        </ul>
        <div class="menu">
            <a class="menuHome" href="dashboard.php#home" style="color: #FCFCFC;">HOME</a>
            <a href="#beds">BEDS</a>
            <a href="#tables">TABLES</a>
            <a href="#chairs">CHAIRS</a>
            <a href="#shelves">SHELVES</a>
        </div>
    </header>
<div class="row" style="margin: 40px;">
    <div class="col-md-12" style="text-align: center;">
        <h1>Thank you!</h1>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
    </div>
</div>
<footer class="indexFooter">
        <img src="../images/LOGO (1).svg">
        <section>
            <article>
                <p>
                    <span>Siku Furniture Home </span>
                    brings you the best furnitures to help bring colour and class to your space. We have a wide range of products to serve you in the different ways you need it
                </p>
            </article>
            <article>
                <a href="profile.php">Profile Details</a>
                <a href="wishlist.php">Wishlist</a>
                <a href="track.php">Track Order</a>
                <a href="logout.php">Logout</a>
            </article>
            <article>
                <a href="#beds">Beds</a>
                <a href="#tables">Tables</a>
                <a href="#shelves">Shelves</a>
                <a href="#chairs">Chairs</a>
            </article>
        </section>
        <div>
            <img src="../images/ic_baseline-facebook.svg">
            <img src="../images/skill-icons_instagram.svg">
            <img src="../images/mdi_linkedin.svg">
        </div>
    </footer>

     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>    
<script src="assets/js/cart.js"></script>
</body>
</html>