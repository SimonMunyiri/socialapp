
 

<title>Comrades</title>

<style type="text/css">
	#login_container{
		width:500px;
		margin:auto;
	}
	*{
	background:black;
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
	}
	select{
		width:200px;
		height:30px;
		border:none;
		border-bottom:1px solid white;
	}
</style>
<center>
<div id="login_container">
	<br>
	<h1 style="font-family: Kristen ITC;">HOSTELS AROUND DEKUT</h1>
	<br>
	<p>Register you hostel to make students aware of available rooms!Please do not spam students!</p>
 <form action="saveHostel.php" enctype="multipart/form-data" method="POST">
 	<table id="names">

 		<tr>
 			<td><b>Name:</b></td>
 			<td><input type="text" name="hostel_name" required placeholder="Hostel Name" /></td>
 		</tr>
 		<tr>
 			<td><b>Location:</b></td>
 			<td><input type="text" name="location" required placeholder="Describe briefly." /></td>
 		</tr>
 		<tr>
 			<td><b>Cost:</b></td>
 			<td><input type="text" name="price" required placeholder="Per month cost" /></td>
 		</tr>
 		<tr>
 			<td></td>
 			<td><p id="toSchoolInfo">Next</p></td>
 		</tr>
 	</table>


  

 	<table id="schoolInfo">
        <tr><td><h4><u>LARD LORD DETAILS</u></h4></td></tr>
 		<tr>
 			<td><b>Name:</b></td>
 			<td><input type="text" name="lard_name" required placeholder="Full name as it appears in the ID" /></td>
 		</tr>
 		<tr>
 			<td><b>ID NO:</b></td>
 			<td><input type="text" name="lard_id" required placeholder="Enter a valid ID " /></td>
 		</tr>
 		<tr>
 			<td><b>Phone Number:</b></td>
 			<td><input type="number" name="lard_phone_num" required/></td>
 		</tr>
 		
 		<tr>
 			<td><button id="toNames" type="button">Previous</button></td>
 			<td><button id="toNation" type="button">Next</button></td>
 			
 		</tr>
 		
 	</table>


 	<table id="Nation">
        <tr><td><h4>CARETAKER DETAILS</h4></td></tr>
 		<tr>
 			<td><b>Phone Number:</b></td>
 			<td><input type="text" name="care_phone" required placeholder="Eg Kenyan" /></td>
 		</tr>
 		
 		<tr>
 			<td><b>ID NO:</b></td>
 			<td><input type="text" name="care_id" required placeholder="Enter a valid ID " /></td>
 		</tr>
 		<tr>
 			<td><b>Phone Number:</b></td>
 			<td><input type="number" name="care_phone_num" required/></td>
 		</tr>
 		<tr>
 			<td><button id="toLard" type="button">Previous</button></td>
 			<td><button id="toProfile" type="button">Next</button></td>
 			
 		</tr>
 		
 		
 	</table>

 	<table id="PROFILE">
        <tr><td><h4>You are almost done!!!</h4></td></tr>
 		
 		<tr>
 			<td><b>Profile Image:</b></td><td><input type="file" name="image"></td>
 		</tr>
 		<tr>
 			<td><button id="toCare" type="button">Previous</button></td>
 			<td><button name="save" type="submit">REGISTER HOSTEL</button></td>
 		</tr>
 		
 	</table>


 </form>

<br>
<p>
	<a href="">Help</a>|
	<a href="">About us</a>|
	<a href="">Terms</a>|
	<a href="">Join us</a>
</p>
</div>
</center></b></td>
		 	</tr>
		 </table>
		</form>
	</div>
</center>

<script type="text/javascript">
	document.getElementById("PROFILE").style.display="none";
	document.getElementById("schoolInfo").style.display="none";
	document.getElementById("Nation").style.display="none";
	document.getElementById("toSchoolInfo").addEventListener('click',function(){
         document.getElementById("schoolInfo").style.display="block";
         document.getElementById("names").style.display="none";
         document.getElementById("Nation").style.display="none";
         document.getElementById("PROFILE").style.display="none";
	});
	document.getElementById("toNames").addEventListener('click',function(){
         document.getElementById("schoolInfo").style.display="none";
         document.getElementById("names").style.display="block";
         document.getElementById("Nation").style.display="none";
         document.getElementById("PROFILE").style.display="none";
	});
	document.getElementById("toNation").addEventListener('click',function(){
         document.getElementById("schoolInfo").style.display="none";
         document.getElementById("names").style.display="none";
         document.getElementById("Nation").style.display="block";
         document.getElementById("PROFILE").style.display="none";
	});
	document.getElementById("toLard").addEventListener('click',function(){
         document.getElementById("schoolInfo").style.display="block";
         document.getElementById("names").style.display="none";
         document.getElementById("Nation").style.display="none";
         document.getElementById("PROFILE").style.display="none";
	});
	document.getElementById("toProfile").addEventListener('click',function(){
         document.getElementById("schoolInfo").style.display="none";
         document.getElementById("names").style.display="none";
         document.getElementById("Nation").style.display="none";
         document.getElementById("PROFILE").style.display="block";
	});
	document.getElementById("toCare").addEventListener('click',function(){
         document.getElementById("schoolInfo").style.display="none";
         document.getElementById("names").style.display="none";
         document.getElementById("Nation").style.display="block";
         document.getElementById("PROFILE").style.display="none";
	});

</script>