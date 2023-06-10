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

if(isset($_GET['product']) && !empty($_GET['product']) && is_numeric($_GET['product']))
    {
        $sql = "SELECT p.*,pdi.img from products p
            INNER JOIN product_images pdi ON pdi.product_id = p.id WHERE pdi.is_featured =:featured AND p.id =:productID";
        $handle = $db->prepare($sql);
        $params = [
                ':featured'=>1,
                ':productID' =>$_GET['product'],
            ];
        $handle->execute($params);
        if($handle->rowCount() == 1 )
        {
            $getProductData = $handle->fetch(PDO::FETCH_ASSOC);
            $imgUrl = PRODUCT_IMG_URL.str_replace(' ','-',strtolower($getProductData ['product_name']))."/".$getProductData ['img'];
        }
        else
        {
            $error = '404! No record found';
        }

    }
    else
    {
        $error = '404! No record found';
    }

    if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == 'add to cart')
    {
        $productID = intval($_POST['product_id']);
        $productQty = intval($_POST['product_qty']);
        
        $sql = "SELECT p.*,pdi.img from products p
            INNER JOIN product_images pdi ON pdi.product_id = p.id WHERE pdi.is_featured =:featured AND p.id =:productID";

        $prepare = $db->prepare($sql);
        
        $params = [
                ':featured'=>1,
                ':productID' =>$productID,
            ];
        
        $prepare->execute($params);
        $fetchProduct = $prepare->fetch(PDO::FETCH_ASSOC);

        $calculateTotalPrice = number_format($productQty * $fetchProduct['price'],2);
        
        $cartArray = [
            'product_id' =>$productID,
            'qty' => $productQty,
            'product_name' =>$fetchProduct['product_name'],
            'product_price' => $fetchProduct['price'],
            'total_price' => $calculateTotalPrice,
            'product_img' =>$fetchProduct['img']
        ];
        
        if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
        {
            $productIDs = [];
            foreach($_SESSION['cart_items'] as $cartKey => $cartItem)
            {
                $productIDs[] = $cartItem['product_id'];
                if($cartItem['product_id'] == $productID)
                {
                    $_SESSION['cart_items'][$cartKey]['qty'] = $productQty;
                    $_SESSION['cart_items'][$cartKey]['total_price'] = $calculateTotalPrice;
                    break;
                }
            }

            if(!in_array($productID,$productIDs))
            {
                $_SESSION['cart_items'][]= $cartArray;
            }

            $successMsg = true;
            
        }
        else
        {
            $_SESSION['cart_items'][]= $cartArray;
            $successMsg = true;
        }

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
	<main class="row mt-3" style="margin: 40px;">

	<?php if(isset($getProductData) && is_array($getProductData)){?>
        <?php if(isset($successMsg) && $successMsg == true){?>
            <div class="row mt-3" style="margin: 40px;">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <img src="<?php echo $imgUrl ?>" class="rounded img-thumbnail mr-2" style="width:40px;"><?php echo $getProductData['product_name']?> is added to cart. <a href="cart.php" class="alert-link">View Cart</a>
                    </div>
                </div>
            </div>
         <?php }?>

        <div class="row mt-3">
            <div class="col-md-5">
                <img src="<?php echo $imgUrl;?>">
            </div>
            <div class="col-md-7">
                <h1><?php echo $getProductData['product_name']?></h1>
                <p><?php echo $getProductData['short_description']?></p>
                <h4>$<?php echo $getProductData['price']?></h4>
                
                <form class="form-inline" method="POST">
                    <div class="form-group mb-2">
                        <input type="number" name="product_qty" id="productQty" class="form-control" placeholder="Quantity" min="1" max="1000" value="1">
                        <input type="hidden" name="product_id" value="<?php echo $getProductData['id']?>">
                    </div>
                    <div class="form-group mb-2 ml-2">
                        <button type="submit" class="btn btn-primary" name="add_to_cart" value="add to cart">Add to Cart</button>
                    </div>
                </form>
                
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php echo $getProductData['full_description']?>
            </div>
        </div>

    <?php
    }
    ?>
	</main>
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