<?php 
include "db_connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Hostel</title>

	<style type="text/css">
			body{
	background:url(photos/default_photos/networking.jpeg);
	color:white;
}
		#body_center{
			font-family:calibri;
			width:500px;
			margin:auto;
			padding:10px;
			border:1px solid gray;
			margin-top:5%;
			border-radius:10px;
			background:black;
		opacity:.8;
		}
		#body_center #inputext{
			width:350px;
			height:25px;
		}

		#button{
			width:100%;
			height:30px;
			background:blue;
			color:white;
			border:none;
			border-radius:2px;
		}

	</style>


</head>
<body>
   <div id="body_center">

   	<h1 style="font-family: Kristen ITC;text-align: center;">HOSTELS</h1>

   	<p>The importance of creating an account for your Hostel is to enable students to book rooms online ,access your services online.All you have to do is to create an account and wait for students to book rooms.</p>

   	<div id="create_account_form">
   		<form action="saveHostel.php" method="POST" enctype="multipart/form-data">
   			<table>
   				<tr>
   					<td>
   						<label><b>Username:</b></label>
   					</td>

   					<td>
   						<input type="text" id="inputext" name="username" placeholder="Input you name in full" />
   					</td>


   				</tr>

   				<tr>
   					<td>
   						<label><b>Id No:</b></label>
   					</td>

   					<td>
   						<input type="number" id="inputext" name="id_no" placeholder="Enter your National Id No" />
   					</td>


   				</tr>

   				<tr>
   					<td>
   						<label><b>Hostel Name:</b></label>
   					</td>

   					<td>
   						<input type="text" id="inputext" name="hostel_name" placeholder="Hostel name" />
   					</td>


   				</tr>

   				<tr>
   					<td>
   						<label><b>Phone Number:</b></label>
   					</td>

   					<td>
   						<input type="number" id="inputext" name="phone_number" placeholder="Phone Number" />
   					</td>


   				</tr>


   				<tr>
   					<td>
   						<label><b>Create password:</b></label>
   					</td>

   					<td>
   						<input type="password" id="inputext" name="hostel_password" placeholder="Create password" />
   					</td>


   				</tr>

   				<tr>
   					<td>
   						<label><b>Confirm password:</b></label>
   					</td>

   					<td>
   						<input type="password" id="inputext" name="hostel_confirm_password" placeholder="Confirm password" />
   					</td>


   				</tr>

   				<tr>
   					<td>
   						<input type="reset"  value="RESET" id="button" />
   					</td>

   					<td>
   						<input type="submit" name="saveHostel" id="button" value="SAVE DETAILS"/>
   					</td>


   				</tr>


   			</table>
   		</form>

   		<hr>
   		<center id="links"><a href="hostelLogin.php">Log into your Hostel</a></center>
   	</div>

   	<br>

   	<style type="text/css">
   		#links a{
   			color:white;
   		}
   	</style>
<p style="color:white;text-align: center;" id="links">
	<a href="helpdesk.php">Help</a>|
	<a href="aboutus.php">About us</a>|
	<a href="">Terms</a>|
	<a href="">Join us</a>
</p>


   </div>
</body>
</html>