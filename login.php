<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="dashboard/dashboard.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
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
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body class="registerBody loginBody">
	<main>
		<div class="registerHeader">
			<h1>Welcome Back</h1>
			<p>Please enter your login details</p>
		</div>
		<span style="color:red;" >
			<?php
				echo htmlentities($_SESSION['errmsg']);
			?>
			<?php
				echo htmlentities($_SESSION['errmsg']="");
			?>
		</span>
		<form method="post" class="registerForm">
			<label>Email Address</label>
			<input type="text" name="email" placeholder="Enter your email address">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter your password">
			<div>
				<button type="submit" name="login">Login</button>
				<p>Don't have an Account?
					<a href="register.php">Register</a>
				</p>
				<a style="text-align: center;" href="forgot.php">Forgot password</a>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html><?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="dashboard/dashboard.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
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
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body class="registerBody loginBody">
	<main>
		<div class="registerHeader">
			<h1>Welcome Back</h1>
			<p>Please enter your login details</p>
		</div>
		<span style="color:red;" >
			<?php
				echo htmlentities($_SESSION['errmsg']);
			?>
			<?php
				echo htmlentities($_SESSION['errmsg']="");
			?>
		</span>
		<form method="post" class="registerForm">
			<label>Email Address</label>
			<input type="text" name="email" placeholder="Enter your email address">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter your password">
			<div>
				<button type="submit" name="login">Login</button>
				<p>Don't have an Account?
					<a href="register.php">Register</a>
				</p>
				<a style="text-align: center;" href="forgot.php">Forgot password</a>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html><?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="dashboard/dashboard.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
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
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body class="registerBody loginBody">
	<main>
		<div class="registerHeader">
			<h1>Welcome Back</h1>
			<p>Please enter your login details</p>
		</div>
		<span style="color:red;" >
			<?php
				echo htmlentities($_SESSION['errmsg']);
			?>
			<?php
				echo htmlentities($_SESSION['errmsg']="");
			?>
		</span>
		<form method="post" class="registerForm">
			<label>Email Address</label>
			<input type="text" name="email" placeholder="Enter your email address">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter your password">
			<div>
				<button type="submit" name="login">Login</button>
				<p>Don't have an Account?
					<a href="register.php">Register</a>
				</p>
				<a style="text-align: center;" href="forgot.php">Forgot password</a>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html><?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="dashboard/dashboard.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
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
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body class="registerBody loginBody">
	<main>
		<div class="registerHeader">
			<h1>Welcome Back</h1>
			<p>Please enter your login details</p>
		</div>
		<span style="color:red;" >
			<?php
				echo htmlentities($_SESSION['errmsg']);
			?>
			<?php
				echo htmlentities($_SESSION['errmsg']="");
			?>
		</span>
		<form method="post" class="registerForm">
			<label>Email Address</label>
			<input type="text" name="email" placeholder="Enter your email address">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter your password">
			<div>
				<button type="submit" name="login">Login</button>
				<p>Don't have an Account?
					<a href="register.php">Register</a>
				</p>
				<a style="text-align: center;" href="forgot.php">Forgot password</a>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html><?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="dashboard/dashboard.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
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
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body class="registerBody loginBody">
	<main>
		<div class="registerHeader">
			<h1>Welcome Back</h1>
			<p>Please enter your login details</p>
		</div>
		<span style="color:red;" >
			<?php
				echo htmlentities($_SESSION['errmsg']);
			?>
			<?php
				echo htmlentities($_SESSION['errmsg']="");
			?>
		</span>
		<form method="post" class="registerForm">
			<label>Email Address</label>
			<input type="text" name="email" placeholder="Enter your email address">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter your password">
			<div>
				<button type="submit" name="login">Login</button>
				<p>Don't have an Account?
					<a href="register.php">Register</a>
				</p>
				<a style="text-align: center;" href="forgot.php">Forgot password</a>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html>