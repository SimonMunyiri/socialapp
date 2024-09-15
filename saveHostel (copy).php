<?php
include "db_connect.php";
if(isset($_POST['saveHostel']))
{
	$username=$_POST['username'];
	$id_no=$_POST['id_no'];
	$hostel_name=$_POST['hostel_name'];
	$phone_number=$_POST['phone_number'];
	$hostel_password=$_POST['hostel_password'];
	$hostel_confirm_password=$_POST['hostel_confirm_password'];
	$passHarsh=md5($hostel_confirm_password);

	$checkAccount=mysqli_query($conn,"SELECT * FROM hostels WHERE HostelName='$hostel_name'");

	$checkAccountNum=mysqli_num_rows($checkAccount);

	if($username=="")
	{
		echo 'Username field empty!<a href="businessRegister.php">Please try again.</a>';
	}
	elseif($id_no=="")
	{
		echo 'Id Number field empty!<a href="businessRegister.php">Please try again.</a>';
	}
	elseif($hostel_name=="")
	{
		echo 'Hostel Name field empty!<a href="businessRegister.php">Please try again.</a>';
	}
	elseif($phone_number=="")
	{
		echo 'Phone Number field empty!<a href="businessRegister.php">Please try again.</a>';
	}
	elseif($hostel_confirm_password=="")
	{
		echo 'Password field empty!<a href="businessRegister.php">Please try again.</a>';
	}
	elseif($hostel_password!=$hostel_confirm_password)
	{
		echo 'Password do not match!<a href="businessRegister.php">Please try again.</a>';
	}
	elseif($checkAccountNum==1){
        echo 'Hostel name taken!<a href="businessRegister.php">Please try again.</a>';
	}
	else
	{
		$register=mysqli_query($conn,"INSERT INTO hostels(ownerName,NationalId,HostelName,PhoneNumber,HostelPassword)VALUES('$username','$id_no','$hostel_name','$phone_number','$passHarsh')");
		if($register)
		{
			echo "Account saved successfully!<a href='hostelLogin.php'>Click to log in.</a>";
		}
		else
		{
			echo "Sorry,We are unable to create an account for.Please try again later.<a href='businessRegister.php'> Click to register.</a>";
		}
	}


	
}

?>