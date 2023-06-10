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
     include('header.php');
?>
<div class="row" style="margin: 40px;">
    <div class="col-md-12" style="text-align: center;">
        <h1>Thank you!</h1>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
    </div>
</div>
<?php include('footer.php');?>