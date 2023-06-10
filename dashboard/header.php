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
			</ul>
			<div>
				<a class="loginBtn" href="profile.php">My Account</a>
				<a class="registerBtn" href="logout.php">Logout</a>
			</div>
		</nav>
		<ul class="searchNav dashnav">
			<li>
				<a href="dashboard.php">
					<img src="../images/LOGO.svg">
				</a>
			</li>
			<li class="cartLi">
				<p>CART
				</p>
				<a href="cart.php">
                    <i class="fa fa-shopping-cart cart">&nbsp &nbsp<?php 
                        echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']):'';
                    ?></i>
                </a>
			</li>
		</ul>
	</header>