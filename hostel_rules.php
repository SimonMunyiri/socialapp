<?php
include 'db_connect.php';

#this is the photo that is displayed when the student has not set a profile photo
session_start();
#Phone number of the logged in user is put into a session here
$phone=$_SESSION['phone'];
#id of the logged in user is put into a session here
$loggedInId=$_SESSION['id'];

#Do not allow a user to access this page without logging in
#incase the user types the url to this page,he/she should be redirected back to the log in page
if(!isset($loggedInId))
{
  #redirecting user to the login page
  header("location:hostelLogin.php");
}


if(isset($_POST['upload_rules'])){

 $file=$_FILES['rules'];
 $fileName=$_FILES['rules']['name'];
 $fileTmpName=$_FILES['rules']['tmp_name'];
 $fileSize=$_FILES['rules']['size'];
 $fileError=$_FILES['rules']['error'];
 $fileType=$_FILES['rules']['type'];

 $fileExt=explode('.',$fileName);
 $fileActualExt=strtolower(end($fileExt));
 $allowed=array('pdf');
 if($fileName==""){
 ?>
 
  <script>
    alert("Select an image");
  </script>
        
 <?php
  }
  else if(in_array($fileActualExt,$allowed)){
    if($fileError===0){
        $fileNameNew=uniqid('',true).".".$fileActualExt;
        
        $sql=mysqli_query($conn,"UPDATE hostels SET rules_pdf='$fileNameNew' WHERE id='$loggedInId'");
        ?>
        <script type="text/javascript">alert("Rules uploaded!!!");</script>
        <?php
        $fileDestination='hostel_rules/'.$fileNameNew;
        move_uploaded_file($fileTmpName,$fileDestination);
        }
        else{
           ?>
            <script type="text/javascript">alert("Sorry,we were unable to upload your pdf file.\nPlease try again later!!!");</script>
            <?php
            }   

           }
        }
?>
<!DOCTYPE html>
<html>
<head>

	<title>Upload Hostel rules.</title>
	<style type="text/css">
		body{
			background:#eee;
			margin:0;
			font-family:calibri;
      
		}
		#upload_rules_container{
			border:1px solid lightblue;
			
		}
		#actual_form{
			margin:10px;
		}
		#body_center{
			width:500px;
		    background:white;
		    margin:auto;		
		    padding:15px;
		    margin-top:5px;
		}
		#upload_btn{
			border:none;
			background:blue;
			color:white;
			padding:4px;
		}
	</style>
</head>
<body>
  <div id="body_center">
  	<div id="upload_rules_container">
  		<p style='background: lightblue;padding:8px;margin-top:0;'>Uploading Hostel Rules</p>
  		<div id="actual_form">
  			<p>Uploaded rules will be visible to students who book your hostels.</p>
  			<form action="hostel_rules.php" method="POST" enctype="multipart/form-data">
  				<input type="file" name="rules"/><br><br>
  			    <input type="submit" id="upload_btn" name="upload_rules" value="UPLOAD RULES"/>
  			</form>
  			
  		</div>
  	</div>
  </div>
</body>
</html>