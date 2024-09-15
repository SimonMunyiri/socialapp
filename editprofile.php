<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>




	<style type="text/css">


		form input[type="text"],form select,form input[type="file"]
		{
			width:300px;
			height:28px;
		}


		#edit_info{
			border:1px solid lightblue;
			padding:0;
		}


		#body_center{
			padding-top:10px;
			padding-bottom: 10px;
		}


		#edit_info form{
			margin:15px;
		}
	</style>





</head>
<body>
<?php
if(isset($_POST['saveChanges']))
{
// declaring image variables
$file=$_FILES['image'];
$fileName=$_FILES['image']['name'];
$fileTmpName=$_FILES['image']['tmp_name'];
$fileSize=$_FILES['image']['size'];
$fileError=$_FILES['image']['error'];
$fileType=$_FILES['image']['type'];
$fileExt=explode('.',$fileName);
$fileActualExt=strtolower(end($fileExt));
$allowed=array('jpg','jpeg','png','jfif');#restrict images to be uploaded
// declaring other variables



if(in_array($fileActualExt,$allowed)){
    #check for errors
    if($fileError===0){
      	$fileNameNew=uniqid('',true).".".$fileActualExt;#change file name before upload
       
      	$insert=mysqli_query($conn,"UPDATE register SET profile_pic='$fileNameNew' WHERE phone='$pname'");#upload to database
      		if($insert)
      		{
      		   ?>
      		   <script type="text/javascript">alert("Profile photo updated successfully!");</script>
      		   <?php
      		   #move the profile image to the folder profilepics
      		   $fileDestination='photos/profile/'.$fileNameNew;
               move_uploaded_file($fileTmpName,$fileDestination);
      	    }
      	    else
      	    {
      		   ?>
      		   <script type="text/javascript">alert("Failed to update your profile picture");</script>
      		   <?php
      	    }

      	}
      }
  }
?>
<div id="body_center">

	<div id="edit_info">



		<p style="background:lightblue;padding:10px;font-weight:bold;font-size:18px;">
      <span class="fa fa-camera"></span> 
      PROFILE PHOTO.
    </p>



    <form action="editprofile.php" enctype="multipart/form-data" method="POST">
    	<table>

    		<tr>

    			<td>
            <b>Profile Picture:</b>
          </td>

    			<td>
            <input type="file" name="image">
          </td>

    		</tr>    		
        
    		<tr>
    			<td></td>

    			<td>
    				<button type="submit" name="saveChanges" style="background:blue;color:white;padding:5px;border:none;width:300px;height:33px;">
               SAVE PROFILE PHOTO
            </button>
    			</td>

    		</tr>


    		<tr>
    			<td></td>
    			<td>
            <a href="myprofile.php">
              View profile
            </a> 
            | 
            <a href="accomodation.php">
               Accomodation
            </a>
          </td>
    	  </tr>
    	</table>

      
    </form>




</div>
</div>
</body>
</html>