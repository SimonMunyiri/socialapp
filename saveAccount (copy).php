<?php include "db_connect.php"; 
if(isset($_POST['save']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	
	$nationality=$_POST['nationality'];
	//$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$password=$_POST['password'];
	$hashed_pass=md5($password);
	$acc_type=$_POST['acc_type'];
   
   //check phone
	$phoneAv=mysqli_query($conn,"SELECT * FROM register WHERE phone='$phone'");
	$phoneAvNum=mysqli_num_rows($phoneAv);
	if($phoneAvNum>0)
	{
      echo '<center><br><br>Phone number exists.<a href="index.php">Click to log in</a> or <a href="#">Reset password</a> or <a href="register.php">click to register.</center>';
	}
	elseif($phoneAvNum==0){
		// save data to database
        //$saveData=mysqli_query($conn,"INSERT INTO(FirstName,LastName,phone,School,course,admNo,nationality,gender,password)VALUES('$fname','$lname','$phone','$school','$course','$admn','$nationality','$gender','$password')");
	    $saveData=mysqli_query($conn,"INSERT INTO register(FirstName,LastName,phone,nationality,gender,password,acc_type)VALUES('$fname','$lname','$phone','$nationality','$gender','$hashed_pass','$acc_type')");
	    if($saveData)
	    {
	    	echo '<center><br><br>Account created successfully,<a href="index.php">click to log in</a></center>';
	    }
	    else
	    {
	    	echo '<center><br><br>Sorry,We are unable to create an account for you,<a href="register.php">click to create a new account</a></center>';
	    }
	}
	
}
?>
