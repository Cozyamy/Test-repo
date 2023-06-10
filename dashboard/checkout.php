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

    if(!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items']))
    {
        header('location:dashboard.php');
        exit();
    }  
    $cartItemCount = count($_SESSION['cart_items']);

    //pre($_SESSION);

    if(isset($_POST['submit']))
    {
        if(isset($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['address'],$_POST['country'],$_POST['state'],$_POST['zipcode']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['country']) && !empty($_POST['state']) && !empty($_POST['zipcode']))
        {
           $firstName = $_POST['first_name'];

           if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false)
           {
                 $errorMsg[] = 'Please enter valid email address';
           }
           else
           {
               //validate_input is a custom function
               //you can find it in helpers.php file
                $firstName  = validate_input($_POST['first_name']);
                $lastName   = validate_input($_POST['last_name']);
                $email      = validate_input($_POST['email']);
                $address    = validate_input($_POST['address']);
                $address2   = (!empty($_POST['address'])?validate_input($_POST['address']):'');
                $country    = validate_input($_POST['country']);
                $state      = validate_input($_POST['state']); 
                $zipcode    = validate_input($_POST['zipcode']);

                $sql = 'insert into orders (first_name, last_name, email, address, address2, country, state, zipcode, order_status,created_at, updated_at) values (:fname, :lname, :email, :address, :address2, :country, :state, :zipcode, :order_status,:created_at, :updated_at)';
                $statement = $db->prepare($sql);
                $params = [
                    'fname' => $firstName,
                    'lname' => $lastName,
                    'email' => $email,
                    'address' => $address,
                    'address2' => $address2,
                    'country' => $country,
                    'state' => $state,
                    'zipcode' => $zipcode,
                    'order_status' => 'confirmed',
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                ];

                $statement->execute($params);
                if($statement->rowCount() == 1)
                {
                    
                    $getOrderID = $db->lastInsertId();

                    if(isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items']))
                    {
                        $sqlDetails = 'insert into order_details (order_id, product_id, product_name, product_price, qty, total_price) values(:order_id,:product_id,:product_name,:product_price,:qty,:total_price)';
                        $orderDetailStmt = $db->prepare($sqlDetails);

                        $totalPrice = 0;
                        foreach($_SESSION['cart_items'] as $item)
                        {
                            $totalPrice+=$item['total_price'];

                            $paramOrderDetails = [
                                'order_id' =>  $getOrderID,
                                'product_id' =>  $item['product_id'],
                                'product_name' =>  $item['product_name'],
                                'product_price' =>  $item['product_price'],
                                'qty' =>  $item['qty'],
                                'total_price' =>  $item['total_price']
                            ];

                            $orderDetailStmt->execute($paramOrderDetails);
                        }
                        
                        $updateSql = 'update orders set total_price = :total where id = :id';

                        $rs = $db->prepare($updateSql);
                        $prepareUpdate = [
                            'total' => $totalPrice,
                            'id' =>$getOrderID
                        ];

                        $rs->execute($prepareUpdate);
                        
                        unset($_SESSION['cart_items']);
                        $_SESSION['confirm_order'] = true;
                        header('location:thank-you.php');
                        exit();
                    }
                }
                else
                {
                    $errorMsg[] = 'Unable to save your order. Please try again';
                }
           }
        }
        else
        {
            $errorMsg = [];

            if(!isset($_POST['first_name']) || empty($_POST['first_name']))
            {
                $errorMsg[] = 'First name is required';
            }
            else
            {
                $fnameValue = $_POST['first_name'];
            }

            if(!isset($_POST['last_name']) || empty($_POST['last_name']))
            {
                $errorMsg[] = 'Last name is required';
            }
            else
            {
                $lnameValue = $_POST['last_name'];
            }

            if(!isset($_POST['email']) || empty($_POST['email']))
            {
                $errorMsg[] = 'Email is required';
            }
            else
            {
                $emailValue = $_POST['email'];
            }

            if(!isset($_POST['address']) || empty($_POST['address']))
            {
                $errorMsg[] = 'Address is required';
            }
            else
            {
                $addressValue = $_POST['address'];
            }

            if(!isset($_POST['country']) || empty($_POST['country']))
            {
                $errorMsg[] = 'Country is required';
            }
            else
            {
                $countryValue = $_POST['country'];
            }

            if(!isset($_POST['state']) || empty($_POST['state']))
            {
                $errorMsg[] = 'State is required';
            }
            else
            {
                $stateValue = $_POST['state'];
            }

            if(!isset($_POST['zipcode']) || empty($_POST['zipcode']))
            {
                $errorMsg[] = 'Zipcode is required';
            }
            else
            {
                $zipCodeValue = $_POST['zipcode'];
            }


            if(isset($_POST['address2']) || !empty($_POST['address2']))
            {
                $address2Value = $_POST['address2'];
            }

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
<div class="row mt-3" style="margin: 40px;">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill"><?php echo $cartItemCount;?></span>
          </h4>
          <ul class="list-group mb-3">
            <?php
                $total = 0;
                foreach($_SESSION['cart_items'] as $cartItem)
                {
                    $total+=$cartItem['total_price'];
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
                            <small class="text-muted">Quantity: <?php echo $cartItem['qty'] ?> X Price: <?php echo $cartItem['product_price'] ?></small>
                        </div>
                        <span class="text-muted">$<?php echo $cartItem['total_price'] ?></span>
                    </li>
            <?php
                }
            ?>
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$<?php echo number_format($total,2);?></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <?php 
            if(isset($errorMsg) && count($errorMsg) > 0)
            {
                foreach($errorMsg as $error)
                {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            }
          ?>
          <form class="needs-validation" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" value="<?php echo (isset($fnameValue) && !empty($fnameValue)) ? $fnameValue:'' ?>" >
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" value="<?php echo (isset($lnameValue) && !empty($lnameValue)) ? $lnameValue:'' ?>" >
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php echo (isset($emailValue) && !empty($emailValue)) ? $emailValue:'' ?>">
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo (isset($addressValue) && !empty($addressValue)) ? $addressValue:'' ?>">
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite" value="<?php echo (isset($address2Value) && !empty($address2Value)) ? $address2Value:'' ?>">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="country" id="country" >
                  <option value="">Choose...</option>
                  <option value="United States" >United States</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" name="state" id="state" >
                  <option value="">Choose...</option>
                  <option value="California">California</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zipcode" placeholder="" value="<?php echo (isset($zipCodeValue) && !empty($zipCodeValue)) ? $zipCodeValue:'' ?>" >
              </div>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="" >
                <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
              </div>
            </div>
           
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="submit">Continue to checkout</button>
          </form>
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