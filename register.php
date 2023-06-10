<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
if($query)
{
	echo "<script>alert('You are successfully register');</script>";
}
else{
echo "<script>alert('Not register something went worng');</script>";
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

<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
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
<body class="registerBody">
	<main>
		<div class="registerHeader">
			<h1>CREATE YOUR ACCOUNT</h1>
			<p>Please enter your details to create your account</p>
		</div>
		<form class="registerForm" method="post" role="form" name="register" onSubmit="return valid();">
			<label>Full Name</label>
			<input type="text" placeholder="Enter your full name" name="fullname" required="required">
			<label>Email Address</label>
			<input placeholder="Enter your email address" type="email" id="email" onBlur="userAvailability()" name="emailid" required >
			<span id="user-availability-status1" style="font-size:12px;"></span>
			<label>Phone Number</label>
			<input type="text" name="contactno" maxlength="11" required placeholder="Enter your phone number">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter your password" required>
			<label>Confirm Password</label>
			<input type="password" name="confirmpassword" required placeholder="Confirm your password">
			<div>
				<button type="submit" name="submit" id="submit">Register</button>
				<p>Already have an Account?
					<a href="login.php">Login</a>
				</p>
			</div>
			<a class="backbtn" href="index.html">Back to Home</a>
		</form>
	</main>
</body>
</html>