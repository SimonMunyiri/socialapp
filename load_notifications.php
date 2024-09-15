<?php
include 'connection.php';

#view the notification that you have selected
#the user should be redirected into a page that contains the details of the post
if(isset($_POST['getNotifications']))
{
	$notificationId=$_POST['notificationId'];
	$_SESSION['notificationId']=$notificationId;
	header("location:view_notifications.php");
}


$defaultProfilePhotoStudent='photos/default_photos/one.jpeg';
// get notifications from database
$newNotifications=mysqli_query($conn,"SELECT * FROM notifications WHERE notification_receiver!='$userId' ORDER BY id DESC");
$newNotificationsNum=mysqli_num_rows($newNotifications);

?>
<style type="text/css">
	#one_notification_display{
		padding:5px 10px 0 10px;
	}

</style>
<div id="nots">
	<?php
	while($newNotificationsRow=mysqli_fetch_assoc($newNotifications))
	{
		// notification id
		$notification_id=$newNotificationsRow['id'];
		// uploader id
		$uploader_id=$newNotificationsRow['notification_receiver'];
		//post id
		$post_id=$newNotificationsRow['post_id'];
		//notification type
		$type=$newNotificationsRow['notification_type'];
		#=======================================================
		// get the account of the uploader
		$uploader_account=mysqli_query($conn,"SELECT * FROM register WHERE id='$uploader_id'");
		$uploader_account_Row=mysqli_fetch_assoc($uploader_account);
		$studentsProfilePhoto='photos/profile/'.$uploader_account_Row['profile_pic'];
		
		if($type=='post'){
			?>
			<div id="one_notification_display" title="Click to view notification.">
			 <form action="load_notifications.php" method="POST" enctype="multipart/form-data">
                	<input type="text" name="notificationId" value="<?php echo $notification_id;?>" style="display:none;">
                	<button type="submit" name="getNotifications" style="background: transparent;border:none;">
                		<table>
		                    <tr>
			                    <td>
				                    <?php
				                    if($uploader_account_Row['profile_pic']=="")
				                    {
				                    	?>
				                     <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="40" width="40" id="profilePicture">
				                     <?php
				                    }
				                    else{
				                    ?>
				                   <img src="<?php echo $studentsProfilePhoto; ?>" height="40" width="40" id="profilePicture">
				                        <?php 
			                        }
			                        ?>
			                        </td>
			                        <td>
			                        	<b id="profileName"><?php echo $uploader_account_Row['FirstName']." ".$uploader_account_Row['LastName'];?></b>
			                        	<br>
			                        	
			                        </td>
			                        <td> added a new post.</td>
			                        <td>
			                        	<!-- show the posted photo -->
			                        	<?php
			                        	#get the uploaded photo from the database
			                        	$get_uploaded_photo=mysqli_query($conn,"SELECT * FROM posts WHERE photo='$post_id'");
			                        	$get_uploaded_photo_Row=mysqli_fetch_assoc($get_uploaded_photo);
			                        	$uploaded_photo='photos/posts/'.$get_uploaded_photo_Row['photo'];

			                        	?>
			                        	<img src="<?php echo $uploaded_photo; ?>" height="40" width="40">
			                        </td>
			                        
			                        
			                        
		                        </tr>
	                        </table> 

                	</button>
                	<p style="width:98%;margin:auto;padding:1px;background:#eee;"></p>  
                </form>

            </div>
          
			                        
			<?php
		}
		#==================================likes=============================================
		elseif ($type=='like') {
			?>
			<div id="one_notification_display" title="Click to view notification.">
			 <form action="load_notifications.php" method="POST" enctype="multipart/form-data">
                	<input type="text" name="notificationId" value="<?php echo $notification_id;?>" style="display:none;">
                	<button type="submit" name="getNotifications" style="background: transparent;border:none;">
                		<table>
		                    <tr>
			                    <td>
				                    <?php
				                    if($uploader_account_Row['profile_pic']=="")
				                    {
				                    	?>
				                     <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="40" width="40" id="profilePicture">
				                     <?php
				                    }
				                    else{
				                    ?>
				                   <img src="<?php echo $studentsProfilePhoto; ?>" height="40" width="40" id="profilePicture">
				                        <?php 
			                        }
			                        ?>
			                        </td>
			                        
			                        <td>
			                        	<b style="color:blue;">
			                        		<?php echo $uploader_account_Row['FirstName']." ".$uploader_account_Row['LastName'];?>
			                        	</b>
			                        </td>

			                        <td>
			                        	likes
			                        	<?php
			                        	
			                        	#get the uploaded photo from the database
			                        	$get_uploaded_photo=mysqli_query($conn,"SELECT * FROM posts WHERE id='$post_id'");
			                        	
			                        	$get_uploaded_photo_Row=mysqli_fetch_assoc($get_uploaded_photo);
			                        	$photo_id=$get_uploaded_photo_Row['phone'];
			                        	$acc=mysqli_query($conn,"SELECT * FROM register WHERE id='$photo_id'");
			                        	$accRow=mysqli_fetch_assoc($acc);
			                        	$user_id=$accRow['id'];
			                        	$newGender=$accRow['gender'];

			                        	

                                          	if($user_id==$uploader_id && $newGender=='male'){
			                        		   echo " a photo that he posted.";
                                                 
			                        	    }
			                        	    elseif($user_id==$uploader_id && $newGender=='male'){
			                        		   echo " a photo that she posted.";
			                        	    }
			                        	    elseif($user_id==$userId)
			                        	    {
			                        		  echo " your photo.";

			                        	    }
			                        	    else{
			                        		   echo "<b>".$accRow['FirstName']." ".$accRow['LastName']."</b>'s photo.";
			                        	    }
                                        

 	

			                        	?>
			                        </td>

			                        <td>
			                        	<!-- show the posted photo -->
			                        	<?php
			                        	#get the uploaded photo from the database
			                        	$get_uploaded_photo=mysqli_query($conn,"SELECT * FROM posts WHERE id='$post_id'");
			                        	$get_uploaded_photo_Row=mysqli_fetch_assoc($get_uploaded_photo);
			                        	$uploaded_photo='photos/posts/'.$get_uploaded_photo_Row['photo'];

			                        	?>
			                        	<img src="<?php echo $uploaded_photo; ?>" height="40" width="40">
			                        </td>
			                        
			                        
		                        </tr>
	                        </table> 

                	</button>
                	<p style="width:98%;margin:auto;padding:1px;background:#eee;"></p>  
                </form>

            </div>
          
			                        
			<?php
		
		}
		#=====================================comments================================================
        elseif ($type=='comment') {
			?>
			<div id="one_notification_display" title="Click to view notification.">
			 <form action="load_notifications.php" method="POST" enctype="multipart/form-data">
                	<input type="text" name="notificationId" value="<?php echo $notification_id;?>" style="display:none;">
                	<button type="submit" name="getNotifications" style="background: transparent;border:none;">
                		<table>
		                    <tr>
			                    <td>
				                    <?php
				                    if($uploader_account_Row['profile_pic']=="")
				                    {
				                    	?>
				                     <img src="<?php echo $defaultProfilePhotoStudent; ?>" height="40" width="40" id="profilePicture">
				                     <?php
				                    }
				                    else{
				                    ?>
				                   <img src="<?php echo $studentsProfilePhoto; ?>" height="40" width="40" id="profilePicture">
				                        <?php 
			                        }
			                        ?>
			                        </td>
			                        
			                        <td>
			                        	<b style="color:blue;">
			                        		<?php echo $uploader_account_Row['FirstName']." ".$uploader_account_Row['LastName'];?>
			                        	</b>
			                        </td>

			                        <td>
			                        	 
			                        	<?php
			                        	
			                        	#get the uploaded photo from the database
			                        	$get_uploaded_photo=mysqli_query($conn,"SELECT * FROM posts WHERE id='$post_id'");
			                        	
			                        	$get_uploaded_photo_Row=mysqli_fetch_assoc($get_uploaded_photo);
			                        	$photo_id=$get_uploaded_photo_Row['phone'];
			                        	$acc=mysqli_query($conn,"SELECT * FROM register WHERE id='$photo_id'");
			                        	$accRow=mysqli_fetch_assoc($acc);
			                        	$user_id=$accRow['id'];
			                        	$newGender=$accRow['gender'];
			                        	if($user_id==$uploader_id && $newGender=='male'){
			                        		echo "commented on his post.";
                                                 
			                        	}
			                        	elseif($user_id==$uploader_id && $newGender=='male'){
			                        		echo "commented on her post.";
			                        	}
			                        	elseif($user_id==$userId)
			                        	{
			                        		echo "commented on your photo.";

			                        	}
			                        	else{
			                        		echo "commented on <b>".$accRow['FirstName']." ".$accRow['LastName']."</b>'s photo.";
			                        	}
                                         

			                        	

			                        	?>
			                        </td>


			                         <td>
			                        	<!-- show the posted photo -->
			                        	<?php
			                        	#get the uploaded photo from the database
			                        	$get_uploaded_photo=mysqli_query($conn,"SELECT * FROM posts WHERE id='$post_id'");
			                        	$get_uploaded_photo_Row=mysqli_fetch_assoc($get_uploaded_photo);
			                        	$uploaded_photo='photos/posts/'.$get_uploaded_photo_Row['photo'];

			                        	?>
			                        	<img src="<?php echo $uploaded_photo; ?>" height="40" width="40">
			                        </td>
			                        
			                        
		                        </tr>
	                        </table> 

                	</button>
                	<p style="width:98%;margin:auto;padding:1px;background:#eee;"></p>  
                </form>

            </div>
          
			                        
			<?php
		
		}
	}
	?>
</div>