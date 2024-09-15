<?php 
$conn=mysqli_connect("localhost","root","","comrades");

 if(isset($_POST['view_hostel']))
    {
    	session_start();
    	$hostel_id=$_POST['hostel_id'];
    	$_SESSION['hostel_id']=$hostel_id;     
        header('location:myhostel.php');
    }
    
?>
<style type="text/css">
	#profilepic{
		background:white;
		padding:10px;
	}
	#personalInfo{
		border: 1px solid lightblue;
		
	
	}
	#personalInfo ul li{
		list-style: none;
		line-height: 40px;
		border-bottom:.5px solid gray;
	}
	a{
		text-decoration:none;
		color:blue;
	}
	.add{
		color:blue;
		font-size:14px;
		cursor:pointer;
	}
	#more_buttons button{
		border:none;
		background:blue;
		color:white;
		padding:3px;
	}
	#editing_info{
		padding:20px;
		background:white;
		border-radius:10px;
		position:absolute;
		margin-left:30%;
		margin-top:30%;
	}
</style>
<?php include "header.php";

    //add education info to database
    if(isset($_POST['save_course_school'])){
      $school=$_POST['school'];
      $course=$_POST['course'];
      $save=mysqli_query($conn,"UPDATE register SET School='$school',course='$course' WHERE id='$userId'");
      if(!$save){
        ?>
        <script type="text/javascript">
          alert("Failed to save info");
        </script>
        <?php
      }
    }
    //edit education info
    if(isset($_POST['edit_course_school'])){
      $school=$_POST['school'];
      $course=$_POST['course'];
      $save=mysqli_query($conn,"UPDATE register SET School='$school',course='$course' WHERE id='$userId'");
      if(!$save){
        ?>
        <script type="text/javascript">
          alert("Failed to save info");
        </script>
        <?php
      }
    }
    ?>
<body>

<div id="body_center">

	<div id="profilepic">
		<center>
		<?php
				if($userProfileRow['profile_pic']=="")
				{
					?>
				 <img src="<?php echo $defaultProfilePhoto;?>" height="90" width="90" id="profilePicture">
				 <?php
				}
				else{
				?>
				<img src="<?php echo $profilePicture;?>" height="90" width="90" id="profilePicture">
				<?php 
			}
			?>
			<br>
			<span style="color:blue;font-weight:bold;"><?php echo $fname." ".$lname;?></span><br>
			
			<span style="font-size:15px;">
				<?php
                 if(($bio_data=="")&&($acc_type=='first'))
                 {
                   echo 'I am proud to be a DeKUT student(default). <span class="add fa fa-edit" id="chane_bio_data"></span>';
                 }
                 elseif(($bio_data=="")&&($acc_type=='Continuing'))
                 {
                 	echo 'I am proud to be a DeKUT student(default). <span class="add fa fa-edit" id="chane_bio_data"></span>';
                 }
                 elseif(($bio_data=="")&&($acc_type=='graduate'))
                 {
                 	echo 'I am proud to be a product of DeKUT. <span class="add fa fa-edit" id="chane_bio_data"></span>';
                 }
                 elseif (($bio_data=="")&&($acc_type=='other')) {
                 	echo 'I love DeKUT(default) <span class="add fa fa-edit" id="chane_bio_data"></span>';
                 }
                 else
                 {
                  ?>
                 	<span id="display_bio_data"> </span> <span class="add fa fa-edit" id="chane_bio_data"></span>
                  <?php
                 }
				?>
       
			</span>
			<br>

			<form action="myprofile.php" enctype="multipart/form-data" method="POST" id="bio_change">
				<input type="text" name="bio_data" style="border:none;width:300px;border-bottom:1px solid black;" placeholder="Edit bio data..."/>
				<button type="submit" name="saveBio" style="border:none;">SAVE</button>
			</form>
			<?php
               if(isset($_POST['saveBio'])){
               	$bio_data=$_POST['bio_data'];
               	if($bio_data==""){
               		echo '<span style="color:red;">Field can not be empty!</span>';
               	}
               	else{
               		$editBio=mysqli_query($conn,"UPDATE register SET bio_data='$bio_data' WHERE phone='$pname'");
               		if(!$editBio){
               			?>
               			<script type="text/javascript">
                     
                        alert("Failed to update bio info!Do not include Single quotes(')");
                      
               				
               			</script>
               			<?php
               		}
               		
               	}
               }
			?>
		</center>
		<hr>



		

	</div>
	<div id="personalInfo" style="transition:.4s;">
		<p style="color:white;cursor:pointer;background:lightblue;padding:12px;"><b>Personal information.</b></p>
    <div style="padding-left:10px;">
		<ul>
			
			<li>
				<span><b>Gender:</b></span><?php echo $gender; ?>
			</li>
			<li>
				<span><b>Nationality:</b></span><?php echo $nationality; ?>
			</li>
			<li>
				<?php 
                 if(($acc_type=='other'))
                 {
                    echo '<span><b>Activity:</b></span> DeKUT Business magnate(default). <span class="add" id="course">edit.</span>';
                 }
                 elseif(($acc_type=='graduate'))
                 {
                 	echo '<span><b>Education:</b></span> Graduated.';
                 }
                 elseif(($acc_type=='first')&&($School=="")&&($course==""))
                 {
                   echo '<span><b>Education:</b></span> First Year student. <span class="add" id="add_course_btn">Add your school and course</span>';
                 }
                 elseif(($acc_type=='first')&&($School!="")&&($course!=""))
                 {
                    echo '<span><b>Education:</b></span> First Year student taking '.$course.'(School of '.$School.'.). <span class="add" id="edit_course_btn">edit.</span>';
                 }
                 elseif(($acc_type=='Continuing')&&($School=="")&&($course==""))
                 {
                    echo '<span><b>Education:</b></span> Continuing student. <span class="add" id="add_course_btn">Add your school and course</span>';
                 }
                 elseif(($acc_type=='Continuing')&&($School!="")&&($course!=""))
                 {
                    echo '<span><b>Education:</b></span> Continuing student taking '.$course.'(School of '.$School.'.) <span class="add" id="edit_course_btn">edit.</span>';
                 }

                 ?>
                 <!-- form to add school and course -->
                 <form action="myprofile.php" method="POST" enctype="multipart/form-data" id="add_course">
                  <table>
                    <tr>
                      <td><label><b>School:</b></label></td>
                      <td><input type="text" name="school" placeholder="School" required style="border: none;border-bottom: 1px solid black;"></td>
                    </tr>
                    <tr>
                      <td><label><b>Course:</b></label></td>
                       <td><input type="text" name="course" placeholder="course" required style="border: none;border-bottom: 1px solid black;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><button type="submit" style="padding:5px;background:blue;color:white;" name="save_course_school"><span class="fa fa-save"></span> Save info</button></td>
                    </tr>
                  </table>
                   
                   
                 </form>
                 <!-- form to edit school and course -->
                  <form action="myprofile.php" method="POST" enctype="multipart/form-data" id="edit_course">
                  <table>
                    <tr>
                      <td><label><b>School:</b></label></td>
                      <td><input type="text" name="school"  value="<?php echo $School; ?>" required style="border: none;border-bottom: 1px solid black;"></td>
                    </tr>
                    <tr>
                       <td><label><b>Course:</b></label></td>
                       <td><input type="text" name="course"  value="<?php echo $course; ?>" required style="border: none;border-bottom: 1px solid black;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><button type="submit" style="padding:5px;background:blue;color:white;" name="edit_course_school"><span class="fa fa-save"></span>
                      Save info</button></td>
                    </tr>
                  </table>
                   
                   
                 </form>
				
			</li>
			<li>
				<span><b>Phone Number:</b></span><?php echo $pname; ?> <small>-only me.</small>
			</li>
     			
		</ul>
  </div>
		<p style="color:blue;cursor:pointer;background:lightgreen;padding:10px;"> <a href="editprofile.php"><span class="fa fa-edit"></span> Edit profile picture.</a> | <a href="editprofile.php"><span class="fa fa-camera"></span> Add profile photo.</a></p>
	</div>
   <br>
	<div id="photos" style="border:1px solid lightblue;">
		<p style="color:red;cursor:pointer;background:lightblue;padding:12px;"><b>My Photos.-<small style="color:gray;">Photos are visible to all</small></b></p>
    <div id="photos_display" style="padding:10px;">
      <?php 
      $fetchPhotos=mysqli_query($conn,"SELECT * FROM posts WHERE phone='$userId'");
      $fetchPhotosNum=mysqli_num_rows($fetchPhotos);
      if($fetchPhotosNum<=0)
      {
        echo '<center>No photos to show!<br></center>';
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
 <script type="text/javascript">
          $(document).ready(function(){
            //open and hide bio data
            $('#bio_change').hide();
            $('#chane_bio_data').click(function(){
               $('#bio_change').fadeToggle();
            });
            //display bio data
            setInterval(function(){
                $('#display_bio_data').load('bio_data.php');
               },500);
          });
          //hide and show education .............
          //hide all forms
          $('#add_course').hide();
          $('#edit_course').hide();
          //show  add education data form
           $('#add_course_btn').click(function(){
               $('#add_course').fadeToggle();
            });
           //show  edit education data form
           $('#edit_course_btn').click(function(){
               $('#edit_course').fadeToggle();
            });

        </script>
</body>