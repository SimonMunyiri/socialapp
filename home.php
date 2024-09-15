<div id="showExtraLikes"></div>
<?php 


include "header.php";



 ?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		#body_content{
			width:500px;
		  margin:auto;
			padding:1px 20px;
		}
    #profile_container{
			background: white;
		}
   
   
	</style>
</head>
<body>

<div id="body_content">
   <div id="showExtra"></div>
	<div id="profile_container">
		<table id="profile">
		<tr>
			<td>
				<?php
				if($userProfileRow['profile_pic']=="")
				{
					?>
				 <a href="myprofile.php"><img src="<?php echo $defaultProfilePhoto;?>" height="50" width="50" id="profilePicture"></a>
				 <?php
				}
				else{
				?>
				<a href="myprofile.php"><img src="<?php echo $profilePicture;?>" height="50" width="50" id="profilePicture"></a>
				<?php 
			}
			?>
			</td>
			<td>
				<b id="profileName"><?php echo $fname." ".$lname;?></b>
			</td>
			<td>
				<p id="headings" style="cursor:pointer;"><?php echo $fname;?>,add a new post</p>
			</td>
		</tr>
	</table>
	</div>
	<br>

	<div id="add_new_post">
		<?php

  
  //<!-- =============php code to make a new post============= -->

  
         //$id="notofications" ;          
          if(isset($_POST['submitpost'])){
             $description=$_POST['description'];
             $file=$_FILES['image'];
             $fileName=$_FILES['image']['name'];
             $fileTmpName=$_FILES['image']['tmp_name'];
             $fileSize=$_FILES['image']['size'];
             $fileError=$_FILES['image']['error'];
             $fileType=$_FILES['image']['type'];

             $fileExt=explode('.',$fileName);
             $fileActualExt=strtolower(end($fileExt));
             $allowed=array('jpg','jpeg','png','jfif');
             if($fileName==""){
             ?>
 
              <script>alert("Select an image");</script>
        
             <?php
              }
             else if(in_array($fileActualExt,$allowed)){
                if($fileError===0){
                    $fileNameNew=uniqid('',true).".".$fileActualExt;
                    // =================
                    $getAccountId=mysqli_query($conn,"SELECT * FROM register WHERE phone='$pname'");
                    $getAccountIdRow=mysqli_fetch_assoc($getAccountId);
                    $accId=$getAccountIdRow['id'];
                     
                     

                    $sql=mysqli_query($conn,"INSERT INTO posts(phone,photo,description)VALUES('$accId','$fileNameNew','$description')");
                    //notify user of the posted photo
                    #NOTE:a photo is uploaded instead of post id...post id can not be fetched during uploading of a photo:)

                    $notification=mysqli_query($conn,"INSERT INTO notifications(post_id,notification_type,notification_receiver)VALUES('$fileNameNew','post','$userId')");
              

                          ?>
                    <script type="text/javascript">alert("Posted!!!");</script>
                         <?php
                       $fileDestination='photos/posts/'.$fileNameNew;
                       move_uploaded_file($fileTmpName,$fileDestination);
                      }
                      
                       else{
                        ?>
                           <script type="text/javascript">alert("Not posted!!!");</script>
                        <?php
                       }   

                    }
                }


 ?>
<style type="text/css">
*{
  padding:0;
  margin:0;
  font-family:calibri;
}
#container{
   border:1px solid lightblue;
   background:white
}
#body_center_content{
  margin:10px;
  padding:10px;
}


	
	
</style>

<div id="container">

<p style="background:lightblue;padding:10px;"><b>Creating a new post</b></p>
  <div id="body_center_content">
    
 <table width="300">
      
      <tr>
        <td colspan="2">
          <form action="home.php" method="POST" enctype="multipart/form-data">
            <textarea name="description" placeholder="Add a text here..." style="width:300px;height:100px;border-radius:10px;border:1px dotted purple;padding:10px;"></textarea>
           
        </td>
      </tr>
      <tr><td colspan="2"><label><span class="fa fa-photo"></span> Add a photo<input style="display:none;" type="file" name="image"></label></td></tr>
      <tr>
        <td colspan="2">
           <button type="submit" id="post" name="submitpost" style="width:300px;padding:10px;border:none;background:blue;color:white;">POST</button>
        </td>
      </tr>
      </form>
  </table> 
</div>
	</div>
</td></tr></table></div>

	<div id="posts_container">
     
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add_new_post").hide();
		$("#headings").click(function(){

			$("#add_new_post").fadeToggle();
		});
		//load posts without refreshing
    setInterval(function(){
      $('#posts_container').load('fetchPosts.php');
    },1000);

	});
</script>

</body>
</html>
