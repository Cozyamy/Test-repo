<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and contactno='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="forgot.php";
mysqli_query($con,"update users set password='$password' WHERE email='$email' and contactno='$contact' ");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Password Changed Successfully";
exit();
}
else
{
$extra="forgot.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Contact no";
exit();
}
}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/svg" sizes="32x32" href="./images/LOGO.svg">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>SIKU FURNITURE HOME</title>
<script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
	</head>
    <body class="registerBody">
	<main>
		<div class="registerHeader">
			<h1>FORGOT PASSWORD</h1>
		</div>
		<form class="registerForm" name="register" method="post">
			<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>
			<label>Email Address</label>
			<input placeholder="Enter your email address" type="email" name="email" id="exampleInputEmail1" required>
			<label>Phone Number</label>
			<input type="text" name="contact" maxlength="11" id="contact" required placeholder="Enter your phone number">
			<label>Password</label>
			<input type="password" id="password" name="password" placeholder="Enter your password" required>
			<label>Confirm Password</label>
			<input type="password" id="confirmpassword" name="confirmpassword" required placeholder="Confirm your password">
			<div>
				<button type="submit" name="change">CHANGE</button>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html>