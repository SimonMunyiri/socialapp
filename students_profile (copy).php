<?php
include 'header.php';
$student_id=$_SESSION['StudentID'];
$studentProfile=mysqli_query($conn,"SELECT * FROM register WHERE id='$student_id'");
$studentProfileRow=mysqli_fetch_assoc($studentProfile);
$fnameStudent=$studentProfileRow['FirstName'];
$lnameStudent=$studentProfileRow['LastName'];
// $admStudent=$studentProfileRow['admNo'];
// $universityStudent=$studentProfileRow['University'];
// $RelationshipStudent=$studentProfileRow['Relationship'];
$genderStudent=$studentProfileRow['gender'];
// $dateOfBirthStudent=$studentProfileRow['dateOfBirth'];
$nationalityStudent=$studentProfileRow['nationality'];
// $HomeTownStudent=$studentProfileRow['HomeTown'];
$SchoolStudent=$studentProfileRow['School'];
// $RelationshipStudent=$studentProfileRow['Relationship'];
$courseStudent=$studentProfileRow['course'];
// $HighSchoolStudent=$studentProfileRow['HighSchool'];
// $TalentStudent=$studentProfileRow['Talent'];
// $hobbyStudent=$studentProfileRow['hobby'];
$bio_dataStudent=$studentProfileRow['bio_data'];
// $interestsStudent=$studentProfileRow['interests'];
$profilePictureStudent='photos/profile/'.$studentProfileRow['profile_pic'];
$userIdStudent=$studentProfileRow['id'];
$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
$acc_typeStudent=$studentProfileRow['acc_type'];
// $crushStudent=$studentProfileRow['crush'];


//open messaging page
if(isset($_POST['message']))
{
	$student_id=$_SESSION['StudentID'];
	header('location:inbox.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#students_info,#photos{
			border:1px solid lightblue;
		}
		#students_info ul{
			margin:10px;
		}
		#students_info ul li{
		list-style: none;
		line-height: 40px;
		border-bottom:.5px solid gray;
	}
	</style>
</head>
<body>
<div id="body_center">
	<div id="profileCont">
		<div id="profile_container">
	        <center>
				<?php
				if($studentProfileRow['profile_pic']=="")
				{
					?>
				 <img src="<?php echo $defaultProfilePhotoStudent;?>" height="90" width="90" id="profilePicture">
				 <?php
				}
				else{
				?>
				<img src="<?php echo $profilePictureStudent;?>" height="90" width="90" id="profilePicture">
				<?php 
			    }
			    ?>
			    <br>
			    <b id="profileName"><?php echo $fnameStudent." ".$lnameStudent;?></b>

			    <span style="font-size:15px;">
				    <?php
                     if(($bio_dataStudent==""))
                     {
                       echo '<br><small>I am proud to be a DeKUT student(default).</small>';
                     }
                     else{
                     	echo '<br><small>'.$bio_dataStudent.'.</small>';
                     }
                     
				?>
			</span>
		    </center>
	    </div>
	    <hr>
	    <div id="students_info">
	    	<p style="background:lightblue;padding:8px;"><?php echo $fnameStudent;?>'s info</p>
	    	<ul>
			
			<li>
				<span><b>Gender:</b></span><?php echo $genderStudent; ?>
			</li>
			<li>
				<span><b>Nationality:</b></span><?php echo $nationalityStudent; ?>
			</li>
			
				<?php 
                 if(($SchoolStudent!="")&&($courseStudent!=""))
                 {
                   ?>
                   <li><?php echo '<b>School:</b> '.$SchoolStudent;?>.</li>
                   <li><?php echo '<b>Course:</b> '.$courseStudent;?>.</li>
                   <?php
                 }
                 

                 ?>
				
		
              <li>
              	<form action="students_profile.php" enctype="multipart/form-data" method="POST">
              	  <button id="message" type="submit" name="message" style="width:95%;margin:auto;padding:8px;background:blue;color:white;border:none;">MESSAGE <?php echo strtoupper($fnameStudent);?></button>
              	</form>
              	</li>
			</li>
			
		</ul>

	    </div>
	    <div id="photos">
		<p style="cursor:pointer;background:lightblue;padding:8px;"><b><?php echo $fnameStudent;?>'s photos<small style="color:gray;"></small></b></p>
		 <div id="photos_display" style="padding:10px;">
      <?php 
      $fetchPhotos=mysqli_query($conn,"SELECT * FROM posts WHERE phone='$userIdStudent'");
      $fetchPhotosNum=mysqli_num_rows($fetchPhotos);
      if($fetchPhotosNum<=0)
      {
        echo 'No photos';
      }
      else
      {
        while($fetchPhotosRow=mysqli_fetch_assoc($fetchPhotos))
        {
          $photo='photos/posts/'.$fetchPhotosRow['photo'];
          ?>
          <a href="<?php echo $photo; ?>"><img title="About photo:<?php echo $fetchPhotosRow['description'];?>" src="<?php echo $photo; ?>" height="100"></a>
          <?php

        }
      }
    
        
      ?>
    </div>
	</div>
	</div>
</div>
</body>
</html>
