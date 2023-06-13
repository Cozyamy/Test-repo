<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (empty($_SESSION['login']))
{
	header("location:../login.php");
}
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	if(isset($_POST['update']))
	{
		$name=$_POST['name'];
		$contactno=$_POST['contactno'];
		$query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Your info has been updated');</script>";
		}
	}


date_default_timezone_set('Africa/Lagos');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
echo "<script>alert('Password Changed Successfully !!');</script>";
}
else
{
	echo "<script>alert('Current Password not match !!');</script>";
}
}
}

if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Billing Address has been updated');</script>";
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Shipping Address has been updated');</script>";
		}
	}
include('header.php');
?>
	<main class="profileMain">
		<ul>
			<li>
				<button class="click">MY PROFILE</button>
				<div class="SectionName">
					<?php
					$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
					while($row=mysqli_fetch_array($query))
						{
							?>
					<form class="registerForm updateForm" role="form" method="post">
						<label>Full Name</label>
						<input type="text" value="<?php echo $row['name'];?>" id="name" name="name" required="required">
						<label>Email Address</label>
						<input id="exampleInputEmail1" value="<?php echo $row['email'];?>" readonly >
						<label>Phone Number</label>
						<input type="text" maxlength="11" id="contactno" name="contactno" required="required" value="<?php echo $row['contactno'];?>">
						<button type="submit" name="update">Update</button>
					</form>
					<?php } ?>
				</div>
			</li>
			<li>
				<button class="click">CHANGE PASSWORD</button>
				<div class="SectionName">
					<form class="registerForm updateForm" role="form" method="post" name="chngpwd" onSubmit="return valid();">
						<label>Current Password</label>
						<input type="password" id="cpass" name="cpass" required="required">
						<label>New Password</label>
						<input type="password" id="newpass" name="newpass">
						<label>Confirm Password</label>
						<input type="password" id="cnfpass" name="cnfpass" required="required">
						<button type="submit" name="submit">Change</button>
					</form>
				</div>
			</li>
			<li>
				<button class="click">BILLING ADDRESS</button>
				<div class="SectionName">
					<?php
					$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
					while($row=mysqli_fetch_array($query))
						{
							?>
					<form class="registerForm updateForm" role="form" method="post">
						<label>Billing Address</label>
						<textarea name="billingaddress" required="required"><?php echo $row['billingAddress'];?></textarea>
						<label>Billing State</label>
						<input type="text" id="bilingstate" name="bilingstate" value="<?php echo $row['billingState'];?>" required>
						<label>Billing City</label>
						<input type="text" id="billingcity" name="billingcity" required="required" value="<?php echo $row['billingCity'];?>">
						<label>Billing Pincode</label>
						<input type="text" id="billingpincode" name="billingpincode" required="required" value="<?php echo $row['billingPincode'];?>">
						<button type="submit" name="update">Update</button>
					</form>
					<?php } ?>
				</div>
			</li>
			<li>
				<button class="click">SHIPPING ADDRESS</button>
				<div class="SectionName">
					<?php
					$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
					while($row=mysqli_fetch_array($query))
						{
							?>
					<form class="registerForm updateForm" role="form" method="post">
						<label>Shipping Address</label>
						<textarea name="shippingaddress" required="required"><?php echo $row['shippingAddress'];?></textarea>
						<label>Shipping State</label>
						<input type="text" name="shippingstate" value="<?php echo $row['shippingState'];?>" required>
						<label>Shipping City</label>
						<input type="text" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shippingCity'];?>">
						<label>Shipping Pincode</label>
						<input type="text" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode'];?>">
						<button type="submit" name="shipupdate">Update</button>
					</form>
					<?php } ?> 
				</div>
			</li>
		</ul>
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
				<a href="../about.html" target="_blank">About</a>
				<a href="logout.php">Logout</a>
			</article>
			<article>
				<a href="dashboard.php#products">Beds</a>
				<a href="dashboard.php#products">Tables</a>
				<a href="dashboard.php#products">Shelves</a>
				<a href="dashboard.php#products">Chairs</a>
			</article>
		</section>
		<div>
			<img src="../images/ic_baseline-facebook.svg">
			<img src="../images/skill-icons_instagram.svg">
			<img src="../images/mdi_linkedin.svg">
		</div>
	</footer>

	<script type="text/javascript">
function valid()
{
if(document.chngpwd.cpass.value=="")
{
alert("Current Password Filed is Empty !!");
document.chngpwd.cpass.focus();
return false;
}
else if(document.chngpwd.newpass.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.newpass.focus();
return false;
}
else if(document.chngpwd.cnfpass.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cnfpass.focus();
return false;
}
else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>

</body>
</html>