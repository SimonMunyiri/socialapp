<?php include "db_connect.php"; 
if(isset($_POST['login']))
{
	session_start();
	$phone=$_POST['phone'];
	$password=$_POST['password'];
	$passHash=md5($password);
    $_SESSION['phone']=$phone;
  	$check=mysqli_query($conn,"SELECT * FROM hostels WHERE PhoneNumber='$phone' AND HostelPassword='$passHash'");
	$checkNum=mysqli_num_rows($check);
	if($checkNum==1)
	{
		$sessionId=mysqli_fetch_assoc($check);
		$loggedInId=$sessionId['id'];
		$_SESSION['id']=$loggedInId;
		header('location:myhostel.php');
	}
	else{
		?>
		<script type="text/javascript">
			alert("Wrong username and password combination,please try again.");
		</script>
		<?php
	}
}
?>
<title>Comrades</title>

<style type="text/css">
	body{
	background:url(photos/default_photos/networking.jpeg);
	color:white;
}
form b{
	color: white;
}
	form input{
		width:200px;
		height:30px;
		border:none;
		border-bottom:1px solid white;
		color:white;
		background:transparent;
	}
	button{
		color:white;
		width:200px;
		height:30px;
		background:red;
		border-radius:5px;
		border:none;
	}
	p a{
		text-decoration: none;
		color:white;
	}
	#login_container{
		width:500px;
		margin:auto;
		background:black;
		opacity:.8;
		padding:10px 10px 30px 10px;
		border-radius:10px;
	}
</style>
<body>
<center>

<div id="login_container">
	<br>
	<h1 style="font-family: Kristen ITC;">HOSTELS</h1>
	<img src="photos/default_photos/dekut_logo.jpg" height="100" width="100" style="border-radius:50%;">
	<br>
	<p>log in!</p>
 <form action="hostelLogin.php" enctype="multipart/form-data" method="POST">
 	<table height="100">
 		<tr>
 			<td><b>Phone Number:</b></td>
 			<td><input type="text" name="phone" required placeholder="phone" /></td>
 		</tr>
 		<tr>
 			<td><b>Password:</b></td>
 			<td><input type="password" name="password" required placeholder="password" /></td>
 		</tr>
 		<tr>
 			<td></td>
 			<td><button name="login" type="submit">LOG IN</button></td>
 		</tr>
 	</table>
 </form>
 <p>
 	
<br>
 	<a href="businessRegister.php" title="Create an account to help you manage your business online">
		Create a free business account(Landlord's and caretakers portal)
	</a>

 </p>
<br>
<p>
	<a href="helpdesk.php">Help</a>|
	<a href="aboutus.php">About us</a>|
	<a href="">Terms</a>|
	<a href="">Join us</a>
</p>
</div>
</center>
</body>